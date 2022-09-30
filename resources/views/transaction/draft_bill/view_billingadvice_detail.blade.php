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
            <form class="form form-validate floating-label" action="{{ route('draftbill.getbillingadvice') }}" method="GET"
                enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="card">
                            <div class="card-underline">
                                <div class="card-head">
                                    <header class="ml-3 mt-2">Create Draft Bill</header>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group ">
                                                <label for="name" class="col-form-label pt-0">Billing For (Job Order Invoice)</label>
                                                <select class="select2 mb-3 select2-multiple select_job_order"
                                                    style="width: 100%" data-placeholder="Choose Billing For"
                                                    name="billingadvice_id">
                                                    <option value="" disabled selected> Select Billing For</option>
                                                    @foreach ($billingadvices as $data)
                                                        <option value="{{ $data->id }}" @if(isset($billingadvice) && ($billingadvice->id == $data->id)) selected @endif>{{ $data->joborder->invoice }}
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <form class="form form-validate floating-label" action="{{ route('draftbill.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-9">
                        <div class="card">
                            <div class="card-underline">
                                <div class="card-body">
                                    <input type="hidden" name="billingadvice_id" value="{{$billingadvice->id}}">
                                    <h5>View Product/Service</h5>
                                    <div class="form-group row d-flex align-items-end">
                                        <div class="col-sm-6">
                                            <label for="invoice" class="col-form-label pt-0">Billing To</label>
                                            <div class="">
                                                <input class="form-control" type="text" required name="bill_to"
                                                    value="{{$billingadvice->joborder->customer->name}}"
                                                    placeholder="Bill To" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row d-flex align-items-end">
                                        <div class="col-sm-6">
                                            <label for="address" class="col-form-label pt-0">Address</label>
                                            <div class="">
                                                <input class="form-control" type="text" required name="address"
                                                    value=""
                                                    placeholder="Address">
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <label for="draft_bill_date" class="col-form-label pt-0">Draft Bill Date</label>
                                            <div class="">
                                                <input class="form-control" type="date" required name="draft_bill_date"
                                                    value="{{$billingadvice->billing_advice_date}}"
                                                    placeholder="Enter Draft Bill Date" required>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <h5 class="pt-5">Bill Details</h5>
                                    <div id="additernary_edu">
                                        <div class="form-group row d-flex align-items-end">
                                            <div class="col-sm-3">
                                                <label class="control-label">Components</label>
                                                <input type="text"  name="component[]" value="" class="form-control change_status_commission">
                                            </div>

                                            <div class="col-sm-3">
                                                <label class="control-label">Description</label>
                                                <input type="text" name="description[]" class="form-control" required>
                                            </div>

                                            <div class="col-sm-3">
                                                <label for="name" class="col-form-label pt-0">Billed For</label>
                                                <select class="select2 mb-3 select2-multiple select_product" multiple style="width: 100%"
                                                    data-placeholder="Billed For" name="billed_for0[]">    
                                                    @foreach ($products as $product)
                                                        <option data-type="product" value="{{ $product->name }}">{{ $product->name }}
                                                        </option>
                                                    @endforeach
                                                </select>            
                                            </div>
                                        
                
                                            <div class="col-sm-2">
                                                <label class="control-label">Amount</label>
                                                <input type="number" name="price[]" class="form-control" required value="{{$billingadvice->joborder->orderDetails->sum('price')}}">
                                            </div>

                                            <div class="col-md-1" style="">
                                                <input id="additemrowedu" type="button" class="btn btn-sm btn-primary mr-1"
                                                    value="Add Row">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-2 justify-content-center">
                                        <div class="form-group">
                                            <div>
                                                <a class="btn btn-light waves-effect ml-1" href="{{ route('draftbill.index') }}">
                                                    <i class="md md-arrow-back"></i>
                                                    Back
                                                </a>
                                                <input type="submit" name="pageSubmit" class="btn btn-danger waves-effect waves-light" value="Generate Billing Advice">
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


        var append = 1;
        $(document).on('click', '#additemrowedu', function() {
            var b = parseFloat($("#tempedu").val());
            b = b + 1;
            $("#tempedu").val(b);
            var temp = $("#tempedu").val();
            var tst = `<div class="form-group row d-flex align-items-end appended-row-edu">
                <div class="col-sm-3">
                    <label class="control-label">Components</label>
                    <input type="text"  name="component[]" value="" class="form-control change_status_commission">
                </div>

                <div class="col-sm-3">
                    <label class="control-label">Description</label>
                    <input type="text" name="description[]" class="form-control" required>
                </div>

                <div class="col-sm-3">
                    <label for="name" class="col-form-label pt-0">Billed For</label>
                    <select class="select2 mb-3 select2-multiple select_product" multiple style="width: 100%"
                        data-placeholder="Billed For" name="billed_for`+append+`[]" id="product_id`+append+`">    
                        @foreach ($products as $product)
                            <option data-type="product" value="{{ $product->name }}">{{ $product->name }}
                            </option>
                        @endforeach
                    </select>            
                </div>
            

                <div class="col-sm-2">
                    <label class="control-label">Amount</label>
                    <input type="number" name="price[]" class="form-control" required value="">
                </div>


                <div class="col-md-1" style="margin-top: 45px;">
                    <input class="removeitemrowedu btn btn-sm btn-danger mr-1" type="button" value="Remove row">
                </div>

            </div>`
            $('#additernary_edu').append(tst);
            $('#product_id'+append).select2();
            append++;
            selectRefresh();
        });

        $(document).on('click', '.removeitemrowedu', function() {
            $(this).closest('.appended-row-edu').remove();
        })

        function remove_product(o) {
            var p = o.parentNode.parentNode;
            p.parentNode.removeChild(p);
        }

        function remove_productforedit(o) {
            var p = o.parentNode.parentNode;
            p.parentNode.removeChild(p);
        }
        
    </script>
@endsection
