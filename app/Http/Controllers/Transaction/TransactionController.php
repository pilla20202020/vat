<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use App\Modules\Models\Customer\Customer;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    //
    protected $customer, $service;

    function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function jobOrder() {
        $customers = $this->customer->get();
        return view('transaction.jobOrder',compact('customers'));
    }

    public function storeJobOrder(Request $request) {
        dd($request->all());
    }


}
