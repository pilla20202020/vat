<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\SellerRequest;
use App\Modules\Models\Seller\Seller;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    protected $seller;

    function __construct(Seller $seller)
    {
        $this->seller = $seller;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $sellers = $this->seller->all();
        return view('seller.index', compact('sellers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('seller.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SellerRequest $request)
    {
        //
        $seller = $this->seller->create($request->data());
        Toastr()->success('Seller Created Successfully','Success');
        return redirect()->route('seller.index');
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
        $seller = $this->seller->where('id',$id)->first();
        return view('seller.edit', compact('seller'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SellerRequest $request, $id)
    {
        //

        $seller = $this->seller->where('id',$id);
        if($seller->update($request->data())) {
            Toastr()->success('Seller Updated Successfully','Success');
            return redirect()->route('seller.index');
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
    }
}
