@extends('layouts.admin.admin')
@section('title', 'Generate Invoice')

@section('page-specific-styles')
    <link href="{{ asset('css/dropify.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/css/bootstrap-toggle.min.css') }}" rel="stylesheet">
@endsection

@section('content')


    <div class="row">
        <div class="col-md-12 col-lg-10 mx-auto">
            <div class="card">
                <div class="col-md-12 pt-3">
                    <div class="float-right d-print-none">
                        <a href="javascript:window.print()" class="btn btn-info"><i class="fa fa-print"></i></a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="row justify-content-center">
                        <div class="col-lg-12 text-center">
                            <div class="justify-content-center">
                                <img src="{{setting('image')}}" alt="" class="img-fluid" width="200">
                            </div>
                        </div>
                    </div>
                    <h2 class="text-center mt-5">Received Bill</h2>
                    <div class="row mt-5">
                        <div class="col-lg-6 ">
                            <h6>Invoice: {{$receivebill->invoice}}</h6>
                        </div>

                        <div class="col-lg-6 text-right">
                            <h6>Date: {{$receivebill->date}}</h6>
                        </div>
                    </div>

                    <div class="row mt-2 p-4">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Components</th>
                                <th scope="col">Type</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Taxable Type</th>
                                <th scope="col">Amount</th>
                              </tr>
                            </thead>
                            <tbody>
                                @if(isset($receivebill->receiveDetails) && $receivebill->receiveDetails->isEmpty() == false)
                                    @foreach ($receivebill->receiveDetails as $key => $detail)
                                    
                                        <tr>
                                            <th scope="row">{{++$key}}</th>
                                            <td>
                                                @if($detail->type == "product")  {{$detail->product($detail->product_id)->name}} @else {{$detail->service($detail->product_id)->name}} @endif
                                            </td>
                                            <td>{{ucfirst($detail->type)}}</td>
                                            <td>{{ucfirst($detail->quantity)}}</td>
                                            <td>{{ucfirst($detail->taxable_type)}}</td>
                                            <td>{{$detail->price}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                <tr class="">
                                    <th colspan="4" class="border-0"></th>
                                    <td class="border-0 font-size-14"><b>Taxable Amount</b></td>
                                    <td class="border-0 font-size-14"><b>Rs. {{$receivebill->taxable_total}}</b></td>
                                </tr>

                                <tr class="">
                                    <th colspan="4" class="border-0"></th>
                                    <td class="border-0 font-size-14"><b>Non-Taxable Amount</b></td>
                                    <td class="border-0 font-size-14"><b>Rs. {{$receivebill->non_taxable_total}}</b></td>
                                </tr>
                                <tr class="bg-dark text-light">
                                    <th colspan="4" class="border-0"></th>
                                    <td class="border-0 font-size-14"><b>Grand Total</b></td>
                                    <td class="border-0 font-size-14"><b>Rs. {{$receivebill->grand_total}}</b></td>
                                </tr>
                              
                              
                            </tbody>
                        </table>

                    </div>
                    
                    <hr>
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-12 ml-auto align-self-center">
                            <div class="text-center text-muted"><small>Thank you very much for doing business with us. Thanks !</small></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


