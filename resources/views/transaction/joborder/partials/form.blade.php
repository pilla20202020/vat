@section('page-specific-styles')
    <link href="{{ asset('css/dropify.min.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet"
          href="{{ asset('resources/css/theme-default/libs/bootstrap-tagsinput/bootstrap-tagsinput.css?1424887862')}}"/>
@endsection
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
                                <label for="name" class="col-form-label pt-0">Select
                                    Customer/Client</label>
                                <select class="select2 mb-3 select2-multiple" style="width: 100%"
                                    data-placeholder="Choose" name="customer_id">
                                    <optgroup label="Customer">
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}" @if(isset($joborder) && ($joborder->customer_id == $customer->id)) selected @endif>{{ $customer->name }}
                                            </option>
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
                    <div id="additernary_edu">
                        @if(isset($joborder->orderDetails) && $joborder->orderDetails->isEmpty() == false)
                            @foreach ($joborder->orderDetails as $key => $detail)
                                <input type="hidden" class="form-control" name="detail_id[{{ $key }}]" value={{ $detail->id }}>
                                <div class="form-group row d-flex align-items-end">.
                                    <div class="col-sm-3">
                                        <label for="name" class="col-form-label pt-0">Select Product/Services</label>
                                        <select class="select2 mb-3 select_product" style="width: 100%"
                                            data-placeholder="Choose" name="product_id[]">
                                            <optgroup label="Product">
                                                @foreach ($products as $product)
                                                    <option data-type="product" value="{{ $product->id }}" @if($detail->type == "product" && $detail->product_id == $product->id) selected @endif>{{ $product->name }}
                                                    </option>
                                                @endforeach
                                            </optgroup>

                                            <optgroup label="Services">
                                                @foreach ($services as $service)
                                                    <option data-type="service" value="{{ $service->id }}" @if($detail->type == "service" && $detail->product_id == $service->id) selected @endif>{{ $service->name }}
                                                    </option>
                                                @endforeach
                                            </optgroup>

                                        </select>

                                    </div>

                                    <div class="col-sm-2">
                                        <label class="control-label">Type</label>
                                        <input type="text" readonly name="type[]" value="{{$detail->type}}" class="form-control change_status_commission">
                                    </div>


                                    <div class="col-sm-3">
                                        <label class="control-label">Description</label>
                                        <input type="text" name="description[]" value="{{$detail->description}}" class="form-control" required>
                                    </div>

                                    <div class="col-sm-2">
                                        <label class="control-label">Amount</label>
                                        <input type="number" name="price[]" value="{{$detail->price}}" class="form-control" required>
                                    </div>

                                    {{-- <div class="col-md-1" style="margin-top: 45px;">
                                        <a href="{{route('checkin.bill_delete',$bill->id)}}" class="btn btn-sm btn-danger mr-1" type="submit" value="">Remove row</a>
                                    </div> --}}
                                </div>
                            @endforeach
                            <hr>
                        @else 
                        <div class="form-group row d-flex align-items-end">
                            <div class="col-sm-3">
                                <label for="name" class="col-form-label pt-0">Select Product/Services</label>
                                <select class="select2 mb-3 select2-multiple select_product" style="width: 100%"
                                    data-placeholder="Choose Product" name="product_id[]">
                                    <option value="" disabled selected> Select Product</option>
                                    <optgroup label="Product">
                                        @foreach ($products as $product)
                                            <option data-type="product" value="{{ $product->id }}">{{ $product->name }}
                                            </option>
                                        @endforeach
                                    </optgroup>

                                    <optgroup label="Services">
                                        @foreach ($services as $service)
                                            <option data-type="service" value="{{ $service->id }}">{{ $service->name }}
                                            </option>
                                        @endforeach
                                    </optgroup>

                                </select>

                            </div>

                            <div class="col-sm-2">
                                <label class="control-label">Type</label>
                                <input type="text" readonly name="type[]" value="" class="form-control change_status_commission">
                            </div>


                            <div class="col-sm-3">
                                <label class="control-label">Description</label>
                                <input type="text" name="description[]" class="form-control" required>
                            </div>

                            <div class="col-sm-2">
                                <label class="control-label">Amount</label>
                                <input type="number" name="price[]" class="form-control" required>
                            </div>
                        </div>
                        @endif
                        

                        <div class="col-md-1" style="">
                            <input id="additemrowedu" type="button" class="btn btn-sm btn-primary mr-1"
                                value="Add Row">
                        </div>
                        <input type="hidden" id="tempedu" value="0" name="temp">
                    </div>
                    <hr>
                    <div class="row mt-2 justify-content-center">
                        <div class="form-group">
                            <div>
                                <a class="btn btn-light waves-effect ml-1" href="{{ route('joborder.index') }}">
                                    <i class="md md-arrow-back"></i>
                                    Back
                                </a>
                                <input type="submit" name="pageSubmit" class="btn btn-danger waves-effect waves-light" value="Submit">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>


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

        $(document).on('change','.select_product',function(e){
            e.preventDefault();
            var product_type = $(this).find(':selected').data('type');
            $(this).parent().next().find('.change_status_commission').val(product_type);
            
        });
        

        var append = 1;
        $(document).on('click', '#additemrowedu', function() {
            var b = parseFloat($("#tempedu").val());
            b = b + 1;
            $("#tempedu").val(b);
            var temp = $("#tempedu").val();
            var tst = `<div class="form-group row d-flex align-items-end appended-row-edu">
                <div class="col-sm-3">
                    <label for="name" class="col-form-label pt-0">Select Product/Services</label>
                    <select class="select2 mb-3 select2-multiple select_product" style="width: 100%"
                        data-placeholder="Choose Product" name="product_id[]" id="product_id`+append+`">
                        <option value="" disabled selected> Select Product</option>
                        <optgroup label="Product">
                            @foreach ($products as $product)
                                <option data-type="product" value="{{ $product->id }}">{{ $product->name }}
                                </option>
                            @endforeach
                        </optgroup>

                        <optgroup label="Services">
                            @foreach ($services as $service)
                                <option data-type="service" value="{{ $service->id }}">{{ $service->name }}
                                </option>
                            @endforeach
                        </optgroup>

                    </select>

                </div>

                <div class="col-sm-2">
                    <label class="control-label">Type</label>
                    <input type="text" readonly name="type[]" value="" class="form-control change_status_commission">
                </div>

                

                <div class="col-sm-3">
                    <label class="control-label">Description</label>
                    <input type="text" name="description[]" class="form-control" required>
                </div>

                <div class="col-sm-2">
                    <label class="control-label">Amount</label>
                    <input type="number" name="price[]" class="form-control" required>
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
