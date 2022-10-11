@extends('layouts.admin.admin')

@section('title', 'Generate Draft Bill')

@section('page-specific-styles')
    <link href="{{ asset('css/dropify.min.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet"
          href="{{ asset('resources/css/theme-default/libs/bootstrap-tagsinput/bootstrap-tagsinput.css?1424887862')}}"/>
@endsection

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{ route('issuebill.getdraftbill') }}" method="GET"
                enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-underline">
                                <div class="card-head">
                                    <header class="ml-3 mt-2">Create Issue Bill</header>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group ">
                                                <label for="name" class="col-form-label pt-0">Select
                                                    Job Order (Invoice)</label>
                                                <select class="select2 mb-3 select2-multiple select_job_order"
                                                    style="width: 100%" data-placeholder="Choose Job Order"
                                                    name="draftbill_id">
                                                    <option value="" disabled selected> Select Job Order</option>
                                                    @foreach ($draftbills as $data)
                                                        <option value="{{ $data->id }}" @if(isset($draftbill) && ($draftbill->id == $data->id)) selected @endif>{{ $data->billingadvice->joborder->invoice }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mt-4">
                                            <div class="form-group">
                                                <div>
                                                    <input type="submit" name="pageSubmit"
                                                        class="btn btn-danger waves-effect waves-light" value="Submit">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <h5>Select Product/Service</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>

            <form class="form form-validate floating-label" action="{{ route('issuebill.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-underline">
                                <div class="card-body">
                                    <input type="hidden" name="draftbill_id" value="{{$draftbill->id}}">
                                    <h5>View Product/Service</h5>
                                    <div class="form-group row d-flex align-items-end">
                                        <div class="col-sm-6">
                                            <label for="invoice" class="col-form-label pt-0">Billing To</label>
                                            <div class="">
                                                <input class="form-control" type="text" required name="bill_to"
                                                    value="{{$draftbill->billingadvice->joborder->customer->name}}"
                                                    placeholder="Bill To" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row d-flex align-items-end">
                                        <div class="col-sm-6">
                                            <label for="address" class="col-form-label pt-0">Address</label>
                                            <div class="">
                                                <input class="form-control" type="text" required name="address"
                                                    value="{{$draftbill->address}}"
                                                    placeholder="Address">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="issue_bill_date" class="col-form-label pt-0">Draft Bill Date</label>
                                            <div class="">
                                                <input class="form-control" type="date" required name="issue_bill_date"
                                                    value="{{$draftbill->billingadvice->billing_advice_date}}"
                                                    placeholder="Enter Draft Bill Date" required>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <h5 class="pt-5">Bill Details</h5>
                                    <div id="additernary_edu">
                                        @if(isset($draftbill->draftDetails) && $draftbill->draftDetails->isEmpty() == false)
                                            @foreach ($draftbill->draftDetails as $key => $detail)
                                                <div class="form-group row d-flex align-items-end">
                                                    <div class="col-sm-2">
                                                        <label class="control-label">Components</label>
                                                        <input type="text"  name="component[]" value="{{ucfirst($detail->component)}}" class="form-control change_status_commission" required>
                                                    </div>
                                                    
                                                    <div class="col-sm-2">
                                                        <label class="control-label">Description</label>
                                                        <input type="text" name="description[]" value="{{ucfirst($detail->description)}}" class="form-control" required>
                                                    </div>


                                                    <div class="col-sm-3">
                                                        <label for="name" class="col-form-label pt-0">Billed For</label>
                                                        <input type="text" name="billed_for[]" value="{{ucfirst($detail->billed_for)}}" class="form-control" required>           
                                                    </div>

                                                    <div class="col-md-2">
                                                        <label class="control-label">Amount Type</label>
                                                        <input type="text" name="taxable_type[]" value="{{ucfirst($detail->taxable_type)}}" class="form-control" required>           
                                                        
                                                    </div>

                                                    <div class="col-sm-2">
                                                        <label class="control-label">Amount</label>
                                                        <input type="number" name="price[]" class="form-control" required value="{{$detail->price}}">
                                                    </div>
                                                
                                                </div>
                                            @endforeach
                                        @endif
                                    
                                    </div>

                                    <div class="row mt-2 justify-content-center">
                                        <div class="form-group">
                                            <div>
                                                <a class="btn btn-light waves-effect ml-1" href="{{ route('issuebill.index') }}">
                                                    <i class="md md-arrow-back"></i>
                                                    Back
                                                </a>
                                                <input type="submit" name="pageSubmit" class="btn btn-danger waves-effect waves-light" value="Issue Bill">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </section>
@endsection

@section('page-specific-scripts')
    <script src="{{asset('resources/js/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/dropify.min.js') }}"></script>
    <script src="{{ asset('resources/js/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js')}}"></script>
    <script src="{{ asset('resources/js/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('resources/js/libs/jquery-validation/dist/additional-methods.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.dropify').dropify();
        });

        $(document).ready(function() {
            $('.select2').select2();
        });
        
    </script>
@endsection
