<?php

namespace App\Http\Controllers\ServiceCategory;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServiceCategory\ServiceCategoryRequest;
use App\Modules\Models\ServiceCategory\ServiceCategory;
use Illuminate\Http\Request;

class ServiceCategoryController extends Controller
{
    protected $servicecategory;

    function __construct(ServiceCategory $servicecategory)
    {
        $this->servicecategory = $servicecategory;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $servicecategories = $this->servicecategory->all();
        return view('servicecategory.index', compact('servicecategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('servicecategory.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceCategoryRequest $request)
    {
        //
        $servicecategory = $this->servicecategory->create($request->data());
        Toastr()->success('Service Category Created Successfully','Success');
        return redirect()->route('service-category.index');
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
        $servicecategory = $this->servicecategory->where('id',$id)->first();
        return view('servicecategory.edit', compact('servicecategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceCategoryRequest $request, $id)
    {
        //
        $servicecategory = $this->servicecategory->where('id',$id);
        if($servicecategory->update($request->data())) {
            Toastr()->success('Service Category Updated Successfully','Success');
            return redirect()->route('service-category.index');
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
        $servicecategory = $this->servicecategory->where('id',$id);
        $servicecategory->delete();
        Toastr()->success('Service Category Deleted Successfully','Success');
        return redirect()->route('service-category.index');
    }
}
