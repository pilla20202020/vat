<?php

namespace App\Http\Controllers\BillingAdvice;

use App\Http\Controllers\Controller;
use App\Modules\Models\BillingAdvice\BillingAdvice;
use App\Modules\Models\BillingAdviceDetail\BillingAdviceDetail;
use App\Modules\Models\Customer\Customer;
use App\Modules\Models\JobOrder\JobOrder;
use App\Modules\Models\JobOrderDetail\JobOrderDetail;
use App\Modules\Models\Product\Product;
use App\Modules\Models\Service\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BillingAdviceController extends Controller
{
    protected $customer, $product, $service, $joborder, $billingadvice, $billingadvicedetail;

    function __construct(Customer $customer, Product $product, Service $service, JobOrder $joborder, BillingAdvice $billingadvice, BillingAdviceDetail $billingadvicedetail)
    {
        $this->customer = $customer;
        $this->product = $product;
        $this->service = $service;
        $this->joborder = $joborder;
        $this->billingadvice = $billingadvice;
        $this->billingadvicedetail = $billingadvicedetail;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $billingadvices = $this->billingadvice->get();
        return view('transaction.billing_advice.index',compact('billingadvices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $joborders = $this->joborder->where('is_billingadvice',null)->get();
        return view('transaction.billing_advice.create',compact('joborders'));

    }


    public function getJobOrder(Request $request) {
        $joborders = $this->joborder->get();
        $joborder = $this->joborder->where('id',$request->joborder_id)->first();
        $customers = $this->customer->get();
        $products = $this->product->get();
        $services = $this->service->get();
        return view('transaction.billing_advice.view_joborder_detail',compact('joborders','joborder','customers','products','services'));
        
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
            $joborder = DB::transaction(function () use ($data) {
                $billingData = [
                    'joborder_id' => $data['joborder_id'],
                    'billing_advice_date' => $data['billing_advice_date'],
                ];
                $createBillingData = $this->billingadvice->create($billingData);
                $joborder = $this->joborder->where('id',$data['joborder_id']);
                $jobOrderData = [
                    'is_billingadvice' => 1,
                ];
                $joborder->update($jobOrderData);
                $p = 0;
                foreach($data['product_id'] as $content) {
                    $orderDetails = new BillingAdviceDetail();
                    $orderDetails['billingadvice_id'] = $createBillingData->id;
                    $orderDetails['product_id'] = $content;
                    $orderDetails['description'] = $data['description'][$p];
                    $orderDetails['type'] = $data['type'][$p];
                    $orderDetails['price'] = $data['price'][$p];
                    $orderDetails->save();
                    $p = $p + 1;
                }
            });
            Toastr()->success('Billing Advice Created Successfully','Success');
            return redirect()->route('billingadvice.index');
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
        $billingadvice = $this->billingadvice->where('id',$id);
        $joborderdetail = $billingadvice->first();
        $joborder = $this->joborder->where('id',$joborderdetail->joborder_id);
        $jobOrderData = [
            'is_billingadvice' => null,
        ];
        $joborder->update($jobOrderData);
        $billingadvice->delete();
        Toastr()->success('Billing Advices Deleted Successfully','Success');
        return redirect()->route('billingadvice.index');
    }

    public function print($id) {
        $billingadvice = $this->billingadvice->where('id',$id)->first();
        $total_amount = $billingadvice->joborder->orderDetails->sum('price');
        return view('transaction.billing_advice.print',compact('billingadvice','total_amount'));

    }

    public function updateStatus(Request $request) {
        $billingadvice = $this->billingadvice->where('id',$request->billing_id);
        $billingdata = [
            'is_accepted' => $request->is_accepted,
            'remarks' => $request->remarks,
        ];
        if($billingadvice->update($billingdata)) {
            Toastr()->success('Billing Advice Status Updated Successfully','Success');
            return redirect()->route('billingadvice.index');
        }
    }
    
}
