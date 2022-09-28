<?php

namespace App\Http\Controllers\JobOrder;

use App\Http\Controllers\Controller;
use App\Modules\Models\BillingAdvice\BillingAdvice;
use App\Modules\Models\Customer\Customer;
use App\Modules\Models\JobOrder\JobOrder;
use App\Modules\Models\JobOrderDetail\JobOrderDetail;
use App\Modules\Models\Product\Product;
use App\Modules\Models\Service\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobOrderController extends Controller
{
    protected $customer, $product, $service, $joborder;

    function __construct(Customer $customer, Product $product, Service $service, JobOrder $joborder)
    {
        $this->customer = $customer;
        $this->product = $product;
        $this->service = $service;
        $this->joborder = $joborder;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $joborders = $this->joborder->get();
        return view('transaction.joborder.index',compact('joborders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $customers = $this->customer->get();
        $products = $this->product->get();
        $services = $this->service->get();
        return view('transaction.joborder.create',compact('customers','products','services'));
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
            $order = $request->all();
            $joborder = DB::transaction(function () use ($order) {
                $orderData = [
                    'customer_id' => $order['customer_id'],
                    'invoice' => $order['invoice'],
                    'order_date' => $order['order_date'],
                ];
                $crateJobOrder = $this->joborder->create($orderData);
                $p = 0;
                foreach($order['product_id'] as $content) {
                    $orderDetails = new JobOrderDetail();
                    $orderDetails['joborder_id'] = $crateJobOrder->id;
                    $orderDetails['product_id'] = $content;
                    $orderDetails['description'] = $order['description'][$p];
                    $orderDetails['type'] = $order['type'][$p];
                    $orderDetails['price'] = $order['price'][$p];
                    $orderDetails->save();
                    $p = $p + 1;
                }
            });
            Toastr()->success('Job Order Created Successfully','Success');
            return redirect()->route('joborder.index');
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
        $joborder = $this->joborder->where('id',$id)->first();
        $customers = $this->customer->get();
        $products = $this->product->get();
        $services = $this->service->get();
        return view('transaction.joborder.edit', compact('joborder','customers','products','services'));
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
            $order = $request->all();
            $joborders = DB::transaction(function () use ($order, $id) {
                $joborder = $this->joborder->where('id',$id);
                $orderData = [
                    'customer_id' => $order['customer_id'],
                    'invoice' => $order['invoice'],
                    'order_date' => $order['order_date'],
                ];

                $joborder->update($orderData);
                $joborderchecklist = $joborder->first();
                // documentSamplePath Language


                if (!empty($order['product_id'])) {
                    foreach ($order['product_id'] as  $key => $value) {
                        if($value != null) {
                            $files = [
                                'joborder_id' => $joborderchecklist->id,
                                'product_id' => $order['product_id'][$key],
                                'type' => $order['type'][$key],
                                'description' => $order['description'][$key],
                                'price' => $order['price'][$key],
                            ];

                            if(!empty($order['detail_id'][$key])){
                                $existingQuli = JobOrderDetail::find($order['detail_id'][$key]);
                                if($existingQuli){
                                    $existingQuli->update($files);
                                }
                            }else{
                                JobOrderDetail::create($files);
                            }
                        }

                    }
                }

            });

            Toastr()->success('Job Order Updated Successfully','Success');
            return redirect()->route('joborder.index');
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

        $joborder = $this->joborder->where('id',$id);
        $joborder->delete();
        Toastr()->success('Job Order Deleted Successfully','Success');
        return redirect()->route('joborder.index');
    }
}
