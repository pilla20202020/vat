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
                    <div class="row mt-5">
                        <div class="col-lg-6 text-center">
                            <h6>Invoice: {{$billingadvice->joborder->invoice}}</h6>
                        </div>

                        <div class="col-lg-6 text-center">
                            <h6>Billing Advice Date: {{$billingadvice->billing_advice_date}}</h6>
                        </div>
                    </div>

                    <div class="row mt-2 p-4">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Components</th>
                                <th scope="col">Type</th>
                                <th scope="col">Description</th>
                                <th scope="col">Amount</th>
                              </tr>
                            </thead>
                            <tbody>
                                @if(isset($billingadvice->joborder->orderDetails) && $billingadvice->joborder->orderDetails->isEmpty() == false)
                                    @foreach ($billingadvice->joborder->orderDetails as $key => $detail)
                                        <tr>
                                            <th scope="row">{{++$key}}</th>
                                            <td>
                                                @if($detail->type == "product")  {{$detail->product($detail->product_id)->name}} @else {{$detail->service($detail->product_id)->name}} @endif
                                            </td>
                                            <td>{{ucfirst($detail->type)}}</td>
                                            <td>{{ucfirst($detail->description)}}</td>
                                            <td>{{$detail->price}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                <tr class="bg-dark text-light">
                                    <th colspan="3" class="border-0"></th>
                                    <td class="border-0 font-size-14"><b>Total</b></td>
                                    <td class="border-0 font-size-14"><b>Rs. {{$total_amount}}</b></td>
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


