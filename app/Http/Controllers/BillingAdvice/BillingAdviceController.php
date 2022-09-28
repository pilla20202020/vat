<?php

namespace App\Http\Controllers\BillingAdvice;

use App\Http\Controllers\Controller;
use App\Modules\Models\BillingAdvice\BillingAdvice;
use App\Modules\Models\Customer\Customer;
use App\Modules\Models\JobOrder\JobOrder;
use App\Modules\Models\JobOrderDetail\JobOrderDetail;
use App\Modules\Models\Product\Product;
use App\Modules\Models\Service\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BillingAdviceController extends Controller
{
    protected $customer, $product, $service, $joborder, $billingadvice;

    function __construct(Customer $customer, Product $product, Service $service, JobOrder $joborder, BillingAdvice $billingadvice)
    {
        $this->customer = $customer;
        $this->product = $product;
        $this->service = $service;
        $this->joborder = $joborder;
        $this->billingadvice = $billingadvice;
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
        $joborders = $this->joborder->get();
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
        dd($request->all());
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
    }

    
}
