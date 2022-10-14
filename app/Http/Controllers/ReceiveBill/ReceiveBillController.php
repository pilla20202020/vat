<?php

namespace App\Http\Controllers\ReceiveBill;

use App\Http\Controllers\Controller;
use App\Modules\Models\Product\Product;
use App\Modules\Models\Purchase\Purchase;
use App\Modules\Models\PurchaseDetails\PurchaseDetails;
use App\Modules\Models\ReceiveBill\ReceiveBill;
use App\Modules\Models\ReceiveBillDetail\ReceiveBillDetail;
use App\Modules\Models\Service\Service;
use App\Modules\Models\Vendor\VendorClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReceiveBillController extends Controller
{
    protected $vendor, $product, $service, $purchase, $purchasedetail, $receivebill;

    function __construct(VendorClass $vendor, Product $product, Service $service, Purchase $purchase, PurchaseDetails $purchasedetail, ReceiveBill $receivebill)
    {
        $this->vendor = $vendor;
        $this->product = $product;
        $this->service = $service;
        $this->purchase = $purchase;
        $this->purchasedetail = $purchasedetail;
        $this->receivebill = $receivebill;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $receivebills = $this->receivebill->get();
        return view('transaction.receive_bill.index',compact('receivebills'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $purchases = $this->purchase->where('is_receivedbill',null)->get();
        return view('transaction.receive_bill.create',compact('purchases'));

    }

    public function getReceiveBill(Request $request) {

        if($request->purchaseorder_id == "direct") {
            $purchases = $this->purchase->where('is_receivedbill',null)->get();
            $vendors = $this->vendor->get();
            $products = $this->product->get();
            $services = $this->service->get();
            return view('transaction.receive_bill.direct_purchase_order',compact('vendors','products','services','purchases'));
        } else {
            $purchases = $this->purchase->where('is_receivedbill',null)->get();
            $vendors = $this->vendor->get();
            $products = $this->product->get();
            $services = $this->service->get();
            $purchase = $this->purchase->where('id', $request->purchaseorder_id)->first();
            return view('transaction.receive_bill.from_purchase_order',compact('vendors','products','services','purchases','purchase'));
        }
        
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
            $vendor = $this->vendor->where('name', $data['vendor_id'])->first();
            $receivebill = DB::transaction(function () use ($data, $vendor) {
                $receivebillData = [
                    'vendor_id' => $vendor->id,
                    'purchaseorder_id' => $data['purchaseorder_id'] ?? null,
                    'invoice' => $data['invoice'],
                    'date' => $data['date'],
                    'remarks' => $data['remarks'],
                    'non_taxable_total' => $data['non_taxable_total'],
                    'taxable_total' => $data['taxable_total'],
                    'grand_total' => $data['grand_total'],
                ];
                $createReceiveBill = $this->receivebill->create($receivebillData);
                if(isset($data['purchaseorder_id'])) {
                    $purchase = $this->purchase->where('id', $data['purchaseorder_id']);
                    $purchaseData = [
                        'is_receivedbill' => 1,
                    ];
                    $purchase->update($purchaseData);
                }
                $p = 0;
                foreach($data['product_id'] as $content) {
                    $orderDetails = new ReceiveBillDetail();
                    $orderDetails['receivebill_id'] = $createReceiveBill->id;
                    $orderDetails['product_id'] = $content;
                    $orderDetails['quantity'] = $data['quantity'][$p];
                    $orderDetails['type'] = $data['type'][$p];
                    $orderDetails['taxable_type'] = $data['taxable_type'][$p];
                    $orderDetails['price'] = $data['price'][$p];
                    $orderDetails->save();
                    $p = $p + 1;
                }
            });
            Toastr()->success('Received Bill Created Successfully','Success');
            return redirect()->route('receivebill.index');
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
        $receivebill = $this->receivebill->where('id',$id);
        $receivebilldetail = $receivebill->first();
        if($receivebilldetail->purchaseorder_id != null) {
            $purchaseorder = $this->purchase->where('id',$receivebilldetail->purchaseorder_id);
            $purchaseorderData = [
                'is_receivedbill' => null,
            ];
            $purchaseorder->update($purchaseorderData);
        }
        $receivebill->delete();
        Toastr()->success('Received Bill Deleted Successfully','Success');
        return redirect()->route('receivebill.index');
    }

    public function print($id) {
        $receivebill = $this->receivebill->where('id',$id)->first();
        return view('transaction.receive_bill.print',compact('receivebill'));

    }
}
