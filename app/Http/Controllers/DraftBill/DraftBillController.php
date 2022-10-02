<?php

namespace App\Http\Controllers\DraftBill;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Models\BillingAdvice\BillingAdvice;
use App\Modules\Models\BillingAdviceDetail\BillingAdviceDetail;
use App\Modules\Models\Customer\Customer;
use App\Modules\Models\DraftBill\DraftBill;
use App\Modules\Models\DraftBillDetail\DraftBillDetail;
use App\Modules\Models\JobOrder\JobOrder;
use App\Modules\Models\JobOrderDetail\JobOrderDetail;
use App\Modules\Models\Product\Product;
use App\Modules\Models\Service\Service;
use Illuminate\Support\Facades\DB;

class DraftBillController extends Controller
{
    protected $customer, $product, $service, $joborder, $billingadvice, $billingadvicedetail, $draftbill;

    function __construct(Customer $customer, Product $product, Service $service, JobOrder $joborder, BillingAdvice $billingadvice, BillingAdviceDetail $billingadvicedetail, DraftBill $draftbill)
    {
        $this->customer = $customer;
        $this->product = $product;
        $this->service = $service;
        $this->joborder = $joborder;
        $this->billingadvice = $billingadvice;
        $this->billingadvicedetail = $billingadvicedetail;
        $this->draftbill = $draftbill;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $draftbills = $this->draftbill->get();
        return view('transaction.draft_bill.index',compact('draftbills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $billingadvices = $this->billingadvice->where('is_accepted','accepted')->where('is_draftbill',null)->get();
        return view('transaction.draft_bill.create',compact('billingadvices'));
    }

    public function getBillingAdvice(Request $request) {
        $billingadvices = $this->billingadvice->where('is_accepted','accepted')->get();
        $billingadvice = $this->billingadvice->where('id',$request->billingadvice_id)->first();
        foreach ($billingadvice->joborder->orderDetails as $key => $detail) {
            if($detail->type == "service")  {
                $products[] = $detail->service($detail->product_id);
            } else {
                $products[] = $detail->product($detail->product_id);
            }
            
              
        }
        return view('transaction.draft_bill.view_billingadvice_detail',compact('billingadvices','billingadvice','products'));
        
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
            // if(isset($request->billed_for)) {
            //     $result = collect($data['billed_for']);
            //     $data['billed_for'] = $result->implode(',');
            // }
            $draftorder = DB::transaction(function () use ($data) {
                $draftbilldata = [
                    'billingadvice_id' => $data['billingadvice_id'],
                    'bill_to' => $data['bill_to'],
                    'address' => $data['address'],
                    'draft_bill_date' => $data['draft_bill_date']
                ];
                $createdraftbill = $this->draftbill->create($draftbilldata);
                $billingadvice = $this->billingadvice->where('id',$data['billingadvice_id']);
                $billingadviceData = [
                    'is_draftbill' => 1,
                ];
                $billingadvice->update($billingadviceData);
                $p = 0;
                foreach($data['component'] as $content) {   
                    $orderDetails = new DraftBillDetail();
                    $orderDetails['draftbill_id'] = $createdraftbill->id;
                    $orderDetails['component'] = $content;
                    $orderDetails['description'] = $data['description'][$p];
                    $orderDetails['taxable_type'] = $data['taxable_type'][$p];
                    $orderDetails['price'] = $data['price'][$p];
                    if(isset($data['billed_for'.$p.''])) {
                        $result = collect($data['billed_for'.$p.'']);
                        $orderDetails['billed_for'] = $result->implode(',');
                    }
                    $orderDetails->save();
                    $p = $p + 1;
                }
            });
            Toastr()->success('Draft Bill Generated Successfully','Success');
            return redirect()->route('draftbill.index');
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
    }

    public function print($id) {
        $draftbill = $this->draftbill->where('id',$id)->first();
        $total_amount = $draftbill->draftDetails->sum('price');
        return view('transaction.draft_bill.print',compact('draftbill','total_amount'));

    }

    public function updateStatus(Request $request) {
        $draftbill = $this->draftbill->where('id',$request->draftbill_id);
        $draftbilldata = [
            'is_accepted' => $request->is_accepted,
            'remarks' => $request->remarks,
        ];
        if($draftbill->update($draftbilldata)) {
            Toastr()->success('Draft Bill Status Updated Successfully','Success');
            return redirect()->route('draftbill.index');
        }
    }
}
