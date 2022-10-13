<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Modules\Models\Product\Product;
use App\Modules\Models\Purchase\Purchase;
use App\Modules\Models\Service\Service;
use App\Modules\Models\Vendor\VendorClass;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    protected $vendor, $product, $service, $purchase;

    function __construct(VendorClass $vendor, Product $product, Service $service, Purchase $purchase)
    {
        $this->vendor = $vendor;
        $this->product = $product;
        $this->service = $service;
        $this->purchase = $purchase;
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
