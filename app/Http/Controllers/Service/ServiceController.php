<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Http\Requests\Service\ServiceRequest;
use App\Modules\Models\Service\Service;
use App\Modules\Models\ServiceCategory\ServiceCategory;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    protected $service, $servicecategory;

    function __construct(Service $service, ServiceCategory $servicecategory)
    {
        $this->service = $service;
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
        $services = $this->service->all();
        return view('service.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $servicecategories = $this->servicecategory->all();
        return view('service.create', compact('servicecategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {
        //
        $service = $this->service->create($request->data());
        Toastr()->success('Service Created Successfully','Success');
        return redirect()->route('service.index');
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
        $service = $this->service->where('id',$id)->first();
        $servicecategories = $this->servicecategory->all();
        return view('service.edit', compact('service','servicecategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceRequest $request, $id)
    {
        //
        $service = $this->service->where('id',$id);
        if($service->update($request->data())) {
            Toastr()->success('Service Updated Successfully','Success');
            return redirect()->route('service.index');
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
        $service = $this->service->where('id',$id);
        $service->delete();
        Toastr()->success('Service Deleted Successfully','Success');
        return redirect()->route('service.index');
    }
}
