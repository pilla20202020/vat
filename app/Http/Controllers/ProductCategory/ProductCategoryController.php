<?php

namespace App\Http\Controllers\ProductCategory;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCategory\ProductCategoryRequest;
use App\Modules\Models\ProductCategory\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    protected $productcategory;

    function __construct(ProductCategory $productcategory)
    {
        $this->productcategory = $productcategory;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $productcategories = $this->productcategory->all();
        return view('productcategory.index', compact('productcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('productcategory.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCategoryRequest $request)
    {
        //
        $productcategory = $this->productcategory->create($request->data());
        Toastr()->success('Product Category Created Successfully','Success');
        return redirect()->route('product-category.index');
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
        $productcategory = $this->productcategory->where('id',$id)->first();
        return view('productcategory.edit', compact('productcategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductCategoryRequest $request, $id)
    {
        //
        $productcategory = $this->productcategory->where('id',$id);
        if($productcategory->update($request->data())) {
            Toastr()->success('Product Category Updated Successfully','Success');
            return redirect()->route('product-category.index');
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
        $productcategory = $this->productcategory->where('id',$id);
        $productcategory->delete();
        Toastr()->success('Product Category Deleted Successfully','Success');
        return redirect()->route('product-category.index');
    }
}
