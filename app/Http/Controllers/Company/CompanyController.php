<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Company\CompanyRequest;
use App\Modules\Models\Branch\Branch;
use App\Modules\Models\Company\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    protected $company, $branch;

    function __construct(Company $company, Branch $branch)
    {
        $this->company = $company;
        $this->branch = $branch;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $companies = $this->company->all();
        return view('company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('company.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyRequest $request)
    {
        //
        $company = $this->company->create($request->data());
        Toastr()->success('Company Created Successfully','Success');
        return redirect()->route('company.index');
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
        $company = $this->company->where('id',$id)->first();
        return view('company.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyRequest $request, $id)
    {
        //
        $company = $this->company->where('id',$id);
        if($company->update($request->data())) {
            Toastr()->success('Company Updated Successfully','Success');
            return redirect()->route('company.index');
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
        $company = $this->company->where('id',$id);
        $company->delete();
        Toastr()->success('Company Deleted Successfully','Success');
        return redirect()->route('company.index');
    }

    public function storeBranches(Request $request) {
        try{
        
            $commissions = new Branch();
            $commissions['company_id'] = $request->company_id;
            $commissions['name'] = $request->name;
            $commissions['address'] = $request->address;
            $commissions['vat'] = $request->vat;
            $commissions->save();
            Toastr()->success('Branches Added Successfully','Success');
            return redirect()->route('company.index');
        } catch(Exception $e) {
            return null;
        }
    }

    // Get Branches Detail
    public function getBranches(Request $request) {
        if($data = $this->branch->where('company_id', $request->company_id)->get())
        {
            return response()->json([
                'data' => $data,
                'status' => true,
                'message' => "Branches Generated Successfully."
            ]);
        }
    }
}
