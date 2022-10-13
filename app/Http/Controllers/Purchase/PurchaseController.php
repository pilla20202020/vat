<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Modules\Models\Product\Product;
use App\Modules\Models\Purchase\Purchase;
use App\Modules\Models\PurchaseDetails\PurchaseDetails;
use App\Modules\Models\Service\Service;
use App\Modules\Models\Vendor\VendorClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    protected $vendor, $product, $service, $purchase, $purchasedetail;

    function __construct(VendorClass $vendor, Product $product, Service $service, Purchase $purchase, PurchaseDetails $purchasedetail)
    {
        $this->vendor = $vendor;
        $this->product = $product;
        $this->service = $service;
        $this->purchase = $purchase;
        $this->purchasedetail = $purchasedetail;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $purchases = $this->purchase->get();
        return view('transaction.purchase.index',compact('purchases'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $vendors = $this->vendor->get();
        $products = $this->product->get();
        $services = $this->service->get();
        return view('transaction.purchase.create',compact('vendors','products','services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try{
            $data = $request->all();
            $purchaseorder = DB::transaction(function () use ($data) {
                $purchaseData = [
                    'vendor_id' => $data['vendor_id'],
                    'invoice' => $data['invoice'],
                    'order_date' => $data['order_date'],
                    'urgency' => $data['urgency'],
                    'remarks' => $data['remarks'],
                ];
                $createPurchaseOrder = $this->purchase->create($purchaseData);
                $p = 0;
                foreach($data['product_id'] as $content) {
                    $orderDetails = new PurchaseDetails();
                    $orderDetails['purchaseorder_id'] = $createPurchaseOrder->id;
                    $orderDetails['product_id'] = $content;
                    $orderDetails['quantity'] = $data['quantity'][$p];
                    $orderDetails['type'] = $data['type'][$p];
                    $orderDetails['price'] = $data['price'][$p];
                    $orderDetails->save();
                    $p = $p + 1;
                }
            });
            Toastr()->success('Purchase Order Created Successfully','Success');
            return redirect()->route('purchase.index');
        } catch(Exception $e) {
            return null;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $purchase = $this->purchase->where('id',$id)->first();
        $vendors = $this->vendor->get();
        $products = $this->product->get();
        $services = $this->service->get();
        return view('transaction.purchase.edit', compact('purchase','vendors','products','services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        try {
            $data = $request->all();
            $purchases = DB::transaction(function () use ($data, $id) {
                $purchase = $this->purchase->where('id',$id);
                $purchaseData = [
                    'vendor_id' => $data['vendor_id'],
                    'invoice' => $data['invoice'],
                    'order_date' => $data['order_date'],
                    'urgency' => $data['urgency'],
                    'remarks' => $data['remarks'],
                ];

                $purchase->update($purchaseData);
                $purchasechecklist = $purchase->first();
                // documentSamplePath Language


                if (!empty($data['product_id'])) {
                    foreach ($data['product_id'] as  $key => $value) {
                        if($value != null) {
                            $files = [
                                'purchaseorder_id' => $purchasechecklist->id,
                                'product_id' => $data['product_id'][$key],
                                'type' => $data['type'][$key],
                                'quantity' => $data['quantity'][$key],
                                'price' => $data['price'][$key],
                            ];

                            if(!empty($data['detail_id'][$key])){
                                $existingQuli = PurchaseDetails::find($data['detail_id'][$key]);
                                if($existingQuli){
                                    $existingQuli->update($files);
                                }
                            }else{
                                PurchaseDetails::create($files);
                            }
                        }

                    }
                }

            });

            Toastr()->success('Purchase Order Updated Successfully','Success');
            return redirect()->route('purchase.index');
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $purchase = $this->purchase->where('id',$id);
        $purchase->delete();
        Toastr()->success('Purchase Order Deleted Successfully','Success');
        return redirect()->route('purchase.index');
    }

    public function deletePurchaseOrderDetails($id) {
        $purchasedetail = $this->purchasedetail->where('id',$id);
        if($purchasedetail->delete()) {
            Toastr()->success('Purchase detail deleted successfully','Success');
            return redirect()->back();
        }
        else {
            Toastr()->success('Purchase detail be deleted at the moment','Error');
            return redirect()->back();
        }
    }
}
