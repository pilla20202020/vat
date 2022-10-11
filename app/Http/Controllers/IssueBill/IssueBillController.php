<?php

namespace App\Http\Controllers\IssueBill;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Models\BillingAdvice\BillingAdvice;
use App\Modules\Models\BillingAdviceDetail\BillingAdviceDetail;
use App\Modules\Models\Customer\Customer;
use App\Modules\Models\DraftBill\DraftBill;
use App\Modules\Models\DraftBillDetail\DraftBillDetail;
use App\Modules\Models\IssueBill\IssueBill;
use App\Modules\Models\IssueBillDetail\IssueBillDetail;
use App\Modules\Models\JobOrder\JobOrder;
use App\Modules\Models\JobOrderDetail\JobOrderDetail;
use App\Modules\Models\Product\Product;
use App\Modules\Models\Service\Service;
use Illuminate\Support\Facades\DB;

class IssueBillController extends Controller
{
    protected $customer, $product, $service, $joborder, $billingadvice, $billingadvicedetail, $draftbill, $issuebill;

    function __construct(Customer $customer, Product $product, Service $service, JobOrder $joborder, BillingAdvice $billingadvice, BillingAdviceDetail $billingadvicedetail, DraftBill $draftbill, IssueBill $issuebill)
    {
        $this->customer = $customer;
        $this->product = $product;
        $this->service = $service;
        $this->joborder = $joborder;
        $this->billingadvice = $billingadvice;
        $this->billingadvicedetail = $billingadvicedetail;
        $this->draftbill = $draftbill;
        $this->issuebill = $issuebill;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $issuebills = $this->issuebill->get();
        return view('transaction.issue_bill.index',compact('issuebills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $draftbills = $this->draftbill->where('is_accepted','accepted')->where('is_issuebill',null)->get();
        return view('transaction.issue_bill.create',compact('draftbills'));
    }


    public function getDraftBill(Request $request) {
        $draftbills = $this->draftbill->where('is_accepted','accepted')->where('is_issuebill',null)->get();
        $draftbill = $this->draftbill->where('id',$request->draftbill_id)->first();
        foreach ($draftbill->billingadvice->joborder->orderDetails as $key => $detail) {
            if($detail->type == "service")  {
                $products[] = $detail->service($detail->product_id);
            } else {
                $products[] = $detail->product($detail->product_id);
            }
            
              
        }
        return view('transaction.issue_bill.view_draftbill_detail',compact('draftbills','draftbill','products'));
        
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
                $issuebilldata = [
                    'draftbill_id' => $data['draftbill_id'],
                    'bill_to' => $data['bill_to'],
                    'address' => $data['address'],
                    'issue_bill_date' => $data['issue_bill_date']
                ];
                $createissuebill = $this->issuebill->create($issuebilldata);
                $draftbill = $this->draftbill->where('id',$data['draftbill_id']);
                $draftbilldata = [
                    'is_issuebill' => 1,
                ];
                $draftbill->update($draftbilldata);
                $p = 0;
                foreach($data['component'] as $content) {   
                    $orderDetails = new IssueBillDetail();
                    $orderDetails['issuebill_id'] = $createissuebill->id;
                    $orderDetails['component'] = $content;
                    $orderDetails['description'] = $data['description'][$p];
                    $orderDetails['taxable_type'] = $data['taxable_type'][$p];
                    $orderDetails['price'] = $data['price'][$p];
                    $orderDetails['billed_for'] = $data['billed_for'][$p];
                    $orderDetails->save();
                    $p = $p + 1;
                }
            });
            Toastr()->success('Bill Issued Successfully','Success');
            return redirect()->route('issuebill.index');
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
        $issuebill = $this->issuebill->where('id',$id);
        $draftbilldetail = $issuebill->first();
        $draftbill = $this->draftbill->where('id',$draftbilldetail->draftbill_id);
        $draftbillData = [
            'is_issuebill' => null,
        ];
        $draftbill->update($draftbillData);
        $issuebill->delete();
        Toastr()->success('Issue Bill Deleted Successfully','Success');
        return redirect()->route('issuebill.index');
    }

    public function print($id) {
        $issuebill = $this->issuebill->where('id',$id)->first();
        $updateissuebill = $this->issuebill->where('id',$id);
        $issuebilldata = [
            'is_printed' => 1,
        ];
        $updateissuebill->update($issuebilldata);
        $total_amount = $issuebill->issueDetails->sum('price');
        return view('transaction.issue_bill.print',compact('issuebill','total_amount'));

    }

    public function updateStatus(Request $request) {
        $issuebill = $this->issuebill->where('id',$request->issuebill_id);
        $issuebilldata = [
            'is_accepted' => $request->is_accepted,
            'remarks' => $request->remarks,
        ];
        if($issuebill->update($issuebilldata)) {
            Toastr()->success('Issue Bill Status Updated Successfully','Success');
            return redirect()->route('issuebill.index');
        }
    }
}
