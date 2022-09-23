<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\VendorRequest;
use App\Modules\Models\Vendor\VendorClass;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    protected $vendor;

    function __construct(VendorClass $vendor)
    {
        $this->vendor = $vendor;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $vendors = $this->vendor->all();
        return view('vendor.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('vendor.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VendorRequest $request)
    {
        //
        $vendor = $this->vendor->create($request->data());
        Toastr()->success('Vendor Created Successfully','Success');
        return redirect()->route('vendors.index');
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
        $vendor = $this->vendor->where('id',$id)->first();
        return view('vendor.edit', compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VendorRequest $request, $id)
    {
        //
        $vendor = $this->vendor->where('id',$id);
        if($vendor->update($request->data())) {
            Toastr()->success('Vendor Updated Successfully','Success');
            return redirect()->route('vendors.index');
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
        $vendor = $this->vendor->where('id',$id);
        $vendor->delete();
        Toastr()->success('Vendor Deleted Successfully','Success');
        return redirect()->route('vendors.index');
    }
}
