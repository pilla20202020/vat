@extends('layouts.admin.admin')

@section('title', 'Generate a Billing Advice')

@section('page-specific-styles')
    <link href="{{ asset('css/dropify.min.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet"
          href="{{ asset('resources/css/theme-default/libs/bootstrap-tagsinput/bootstrap-tagsinput.css?1424887862')}}"/>
@endsection

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{ route('receivebill.getreceivebill') }}" method="GET"
                enctype="multipart/form-data">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="card">
                            <div class="card-underline">
                                <div class="card-head">
                                    <header class="ml-3 mt-2">Create Receive Bill</header>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group ">
                                                <label for="name" class="col-form-label pt-0">Select
                                                    Purchase Order (Invoice)</label>
                                                <select class="select2 mb-3 select2-multiple select_job_order"
                                                    style="width: 100%" data-placeholder="Choose Purchase Order"
                                                    name="purchaseorder_id">
                                                    <option value="" disabled selected> Select Purchase Order</option>
                                                    @foreach ($purchases as $purchase)
                                                        <option value="{{ $purchase->id }}">{{ $purchase->invoice }}
                                                        </option>
                                                    @endforeach
                                                    <option value="direct" selected> Direct Purchase Order</option>
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

            <form class="form form-validate floating-label" action="{{ route('receivebill.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
            
                <div class="row">
                    <div class="col-sm-9">
                        <div class="card">
                            <div class="card-underline">
                                <div class="card-head">
                                    <header class="ml-3 mt-2">Create Received Bill</header>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-11">
                                            <div class="form-group ">
                                                <label for="name" class="col-form-label pt-0">Select
                                                    Vendors</label>
                                                <select class="select2 mb-3 select2-multiple vendor_class" style="width: 100%"
                                                    data-placeholder="Choose" name="vendor_id">
                                                    @foreach ($vendors as $vendor)
                                                        <option value="{{ $vendor->name }}" >{{ $vendor->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-1 mt-4">
                                            <a class="btn btn-primary btn-rounded btn-addbutton"><i class="fa fa-plus"></i></a>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group ">
                                                <label for="invoice" class="col-form-label pt-0">Invoice Number</label>
                                                <div class="">
                                                    <input class="form-control" type="text" required name="invoice"
                                                        value="{{ old('invoice') }}"
                                                        placeholder="Enter Invoice Number">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group ">
                                                <label for="invoice" class="col-form-label pt-0">Date</label>
                                                <div class="">
                                                    <input class="form-control" type="date" required name="date"
                                                        value="{{ old('date') }}"
                                                        placeholder="Enter Date">
                                                </div>
                                            </div>

                                        </div>
                
                                        

                                        <div class="col-sm-12 mt-2">
                                            <div class="form-group ">
                                                <label for="remarks" class="col-form-label pt-0">Remarks</label>
                                                <div class="">
                                                    <textarea name="remarks" id="" cols="100" rows="5"></textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <hr>
                                    <h5>Select Items To Purchase</h5>
                                    <div id="additernary_edu">
                                        
                                        <div class="form-group row d-flex align-items-end">
                                            <div class="col-sm-3">
                                                <label for="name" class="col-form-label pt-0">Select Item</label>
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


                                            <div class="col-sm-2">
                                                <label class="control-label">Quantity</label>
                                                <input type="text" name="quantity[]" class="form-control" required>
                                            </div>

                                            <div class="col-md-2">
                                                <label class="control-label">Amount Type</label>
                                                <select class="form-control amount_type"
                                                    style="width: 100%" data-placeholder="Choose Amount Type "
                                                    name="taxable_type[]" required>
                                                    <option value="" disabled selected> Select Amount Type</option>
                                                    <option value="taxable" data-amount_type="taxable" > Taxable Amount</option>
                                                    <option value="non_taxable" data-amount_type="non_taxable"> Non-Taxable Amount</option>
                                                </select>
                                            </div>

                                            <div class="col-sm-2">
                                                <label class="control-label">Price</label>
                                                <input type="number" name="price[]" class="form-control price" required>
                                            </div>

                                            

                                            <div class="col-md-1" style="">
                                                <button id="additemrowedu" type="button" class="btn btn-sm btn-primary mr-1"
                                                    value="Add Row">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        
                                        
                                        
                                        <input type="hidden" id="tempedu" value="0" name="temp">
                                    </div>
                                    <div class="row mt-3 mb-4">
                                        <div class="offset-md-9 pl-5">
                                            <input type="button" name="pageSubmit"
                                                        class="bt btn-danger btn-sm btn-calculate" value="Calculate">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="offset-md-5">
                                            <h6 class="p-0">Total</h6>
                                        </div>
                                        <div class="col-md-3">
                                            Non-Taxable Total : <input name="non_taxable_total" class="non_taxable_total" readonly>
                                        </div>

                                        <div class="col-md-3">
                                            Taxable Total : <input name="taxable_total" class="taxable_total" readonly>
                                        </div>
                                    </div>

                                    <div class="row mt-3 ml-1">
                                        <div class="offset-md-5">
                                            <h6 class="p-0">VAT</h6>
                                        </div>
                                        <div class="col-md-3">
                                            <input name="vat" class="vat" value="{{setting('vat')}}" readonly>
                                        </div>                                        
                                    </div>

                                    <div class="row mt-4 ml-1">
                                        <div class="offset-md-5">
                                            <h6 class="p-0">Grand Total:</h6>
                                        </div>
                                        <div class="col-md-3">
                                            <input name="grand_total" class="grand_total" readonly>
                                        </div>

                                        
                                    </div>
                                    <hr>
                                    <div class="row mt-2 justify-content-center">
                                        <div class="form-group">
                                            <div>
                                                <a class="btn btn-light waves-effect ml-1" href="{{ route('purchase.index') }}">
                                                    <i class="md md-arrow-back"></i>
                                                    Back
                                                </a>
                                                <input type="submit" name="pageSubmit" class="btn btn-danger waves-effect waves-light btn-submit" value="Submit">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- Vendor Add  --}}
                    <div class="modal fade" id="addVendor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Vendors</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group ">
                                                <label for="name" class="col-form-label pt-0">Vendor Name</label>
                                                <div class="">
                                                    <input class="form-control store_vendorname" type="text" value="" placeholder="Enter Vendor Name">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="form-group ">
                                                <label for="name" class="col-form-label pt-0">Vendor Email</label>
                                                <div class="">
                                                    <input class="form-control store_vendoremail" type="email" value="" placeholder="Enter Vendor Email">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-sm-12">
                                            <div class="form-group ">
                                                <label for="name" class="col-form-label pt-0">Phone</label>
                                                <div class="">
                                                    <input class="form-control store_vendorphone" type="number" value="" placeholder="Enter Vendor Phone">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary btn-vendorstore" data-dismiss="modal">Add Vendor</button>
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

        $(document).on("click", ".btn-calculate", function() {
            var taxable_sum = 0;
            var non_taxable_sum = 0;
            var amount_type = $(this).parent().prev().find('.amount_type').val();

            $(".taxable_price").each(function(){
                taxable_sum += +$(this).val();
            });
            $(".taxable_total").val(taxable_sum);
            

            $(".non_taxable_price").each(function(){
                non_taxable_sum += +$(this).val();
            });
            $(".non_taxable_total").val(non_taxable_sum);

            var non_taxable_total = $('.non_taxable_total').val();
            var taxable_total = $('.taxable_total').val();
            var vat = $('.vat').val();
            var vat_amount = (vat * taxable_total ) / 100;
            var vat_taxable_total = parseInt(vat_amount) + parseInt(taxable_total);
            var grand_total = parseInt(non_taxable_total )+ parseInt(vat_taxable_total);
            $(".grand_total").val(grand_total);
        });

        $(document).on("click", ".btn-submit", function() {
            var taxable_sum = 0;
            var non_taxable_sum = 0;
            var amount_type = $(this).parent().prev().find('.amount_type').val();

            $(".taxable_price").each(function(){
                taxable_sum += +$(this).val();
            });
            $(".taxable_total").val(taxable_sum);
            

            $(".non_taxable_price").each(function(){
                non_taxable_sum += +$(this).val();
            });
            $(".non_taxable_total").val(non_taxable_sum);

            var non_taxable_total = $('.non_taxable_total').val();
            var taxable_total = $('.taxable_total').val();
            var vat = $('.vat').val();
            var vat_amount = (vat * taxable_total ) / 100;
            var vat_taxable_total = parseInt(vat_amount) + parseInt(taxable_total);
            var grand_total = parseInt(non_taxable_total )+ parseInt(vat_taxable_total);
            $(".grand_total").val(grand_total);
        });

        $(document).on('change','.amount_type',function(e){
            var amount_type = $(this).find(':selected').data('amount_type');
            if(amount_type == "taxable") {
                $(this).parent().next().find('.price').addClass("taxable_price");
                $(this).parent().next().find('.price').removeClass("non_taxable_price");
            } else {
                $(this).parent().next().find('.price').addClass("non_taxable_price");
                $(this).parent().next().find('.price').removeClass("taxable_price");

            }

        });

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
        

        


        $(document).on('click', '.btn-addbutton', function(e) {
            e.preventDefault();
            $('#addVendor').modal('show');
        })

        $('.btn-vendorstore').click(function(e){
            e.preventDefault();
            var vendor_name = $('.store_vendorname').val();
            var vendor_email = $('.store_vendoremail').val();
            var vendor_phone = $('.store_vendorphone').val();
            $.ajax({

                url: "{{route('vendors.vendorStore')}}",
                type: "post",
                data: {
                    _token: $("meta[name='csrf-token']").attr('content'),
                    name: vendor_name,
                    email: vendor_email,
                    phone: vendor_phone,
                },
                success:function(response){
                    if(typeof(response) != "object"){
                        response = JSON.parse(response);
                    }
                    var body = "";
                    if(response.data){
                        $.each(response.data, function(key, names){
                            console.log(names);
                            body += "<option value='"+names.id+"'>"+names.name+"</option>";
                        });
                        $('.vendor_class').html(body);
                    }
                }
            })

        })
        
        var append = 1;
        $(document).on('click', '#additemrowedu', function() {
            var b = parseFloat($("#tempedu").val());
            b = b + 1;
            $("#tempedu").val(b);
            var temp = $("#tempedu").val();
            var tst = `<div class="form-group row d-flex align-items-end appended-row-edu">
                <div class="col-sm-3">
                    <label for="name" class="col-form-label pt-0">Select Item</label>
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


                <div class="col-sm-2">
                    <label class="control-label">Quantity</label>
                    <input type="text" name="quantity[]" class="form-control" required>
                </div>

                <div class="col-md-2">
                    <label class="control-label">Amount Type</label>
                    <select class="form-control amount_type"
                        style="width: 100%" data-placeholder="Choose Amount Type "
                        name="taxable_type[]" required>
                        <option value="" disabled selected> Select Amount Type</option>
                        <option value="taxable" data-amount_type="taxable"> Taxable Amount</option>
                        <option value="non_taxable" data-amount_type="non_taxable"> Non-Taxable Amount</option>
                    </select>
                </div>

                <div class="col-sm-2">
                    <label class="control-label">Price</label>
                    <input type="number" name="price[]" class="form-control price" required>
                </div>

                


                <div class="col-md-1" style="margin-top: 45px;">
                    <button class="removeitemrowedu btn btn-sm btn-danger mr-1" type="button" ><i class="far fa-trash-alt"></i></button>
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
