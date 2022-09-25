<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Modules\Models\Product\Product;
use App\Modules\Models\ProductCategory\ProductCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $product, $productcategory;

    function __construct(Product $product, ProductCategory $productcategory)
    {
        $this->product = $product;
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
        $products = $this->product->all();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $productcategories = $this->productcategory->all();
        return view('product.create', compact('productcategories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        //
        $product = $this->product->create($request->data());
        Toastr()->success('Product Created Successfully','Success');
        return redirect()->route('product.index');
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
        $product = $this->product->where('id',$id)->first();
        $productcategories = $this->productcategory->all();
        return view('product.edit', compact('product','productcategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        //

        $product = $this->product->where('id',$id);
        if($product->update($request->data())) {
            Toastr()->success('Product Updated Successfully','Success');
            return redirect()->route('product.index');
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
        $product = $this->product->where('id',$id);
        $product->delete();
        Toastr()->success('Product Deleted Successfully','Success');
        return redirect()->route('product.index');
    }
}
