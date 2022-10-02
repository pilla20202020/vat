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
                        <div class="col-lg-6 ">
                            <h6>Billed To: {{$draftbill->bill_to}}</h6>
                            <h6>Invoice: {{$draftbill->billingadvice->joborder->invoice}}</h6>
                        </div>

                        <div class="col-lg-6 text-right">
                            <h6>Address: {{$draftbill->address}}</h6>
                            <h6>Draft Bill Date: {{$draftbill->draft_bill_date}}</h6>
                        </div>
                    </div>

                    <h4 class="text-center mt-5"> Bill Details</h4>
                    <div class="row mt-1 p-4 text-center">
                        <table class="table">
                            <thead>
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Components</th>
                                <th scope="col">Description</th>
                                <th scope="col">Billed For</th>
                                <th scope="col">Taxable Type</th>
                                <th scope="col">Amount</th>
                              </tr>
                            </thead>
                            <tbody>
                                @if(isset($draftbill->draftDetails) && $draftbill->draftDetails->isEmpty() == false)
                                    @foreach ($draftbill->draftDetails as $key => $detail)
                                        <tr>
                                            <th scope="row">{{++$key}}</th>
                                            <td>
                                                {{ucfirst($detail->component)}}
                                            </td>
                                            <td>{{ucfirst($detail->description)}}</td>
                                            <td>{{ucfirst($detail->billed_for)}}</td>
                                            <td>{{ucfirst($detail->taxable_type)}}</td>
                                            <td>{{$detail->price}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                <tr class="bg-dark text-light">
                                    <th colspan="4" class="border-0"></th>
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


