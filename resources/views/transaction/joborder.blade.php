@extends('layouts.admin.admin')

@section('title', 'Create a Job Order')

@section('page-specific-styles')
    <link href="{{ asset('css/dropify.min.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet"
        href="{{ asset('resources/css/theme-default/libs/bootstrap-tagsinput/bootstrap-tagsinput.css?1424887862') }}" />
@endsection

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{ route('transaction.storejoborder') }}" method="POST"
                enctype="multipart/form-data">

                @csrf
                <div class="row">
                    <div class="col-sm-9">
                        <div class="card">
                            <div class="card-underline">
                                <div class="card-head">
                                    <header class="ml-3 mt-2">Create Job Order</header>
                                </div>
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group ">
                                                <label for="name" class="col-form-label pt-0">Select Customer/Client</label>
                                                <select class="select2 mb-3 select2-multiple" style="width: 100%" data-placeholder="Choose" name="customer_id">
                                                    <optgroup label="Customer">
                                                        @foreach ($customers as $customer)
                                                            <option value="{{$customer->id}}">{{$customer->name}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                    
                                                </select> 
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group ">
                                                <label for="invoice" class="col-form-label pt-0">Invoice Number</label>
                                                <div class="">
                                                    <input class="form-control" type="text" required name="invoice"
                                                        value="{{ old('invoice', isset($joborder->invoice) ? $joborder->invoice : '') }}"
                                                        placeholder="Enter Invoice Number">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group ">
                                                <label for="invoice" class="col-form-label pt-0">Date</label>
                                                <div class="">
                                                    <input class="form-control" type="date" required name="order_date"
                                                        value="{{ old('order_date', isset($joborder->order_date) ? $joborder->order_date : '') }}"
                                                        placeholder="Enter Order Date">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <hr>
                                    <h5>Select Product/Service</h5>

                                    <hr>
                                    <div class="row mt-2 justify-content-center">
                                        <div class="form-group">
                                            <div>
                                                
                                                <input type="submit" name="pageSubmit"
                                                    class="btn btn-danger waves-effect waves-light" value="Submit">
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
    <script src="{{ asset('resources/js/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/dropify.min.js') }}"></script>
    <script src="{{ asset('resources/js/libs/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('resources/js/libs/jquery-validation/dist/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('resources/js/libs/jquery-validation/dist/additional-methods.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.dropify').dropify();
        });

        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
@endsection
