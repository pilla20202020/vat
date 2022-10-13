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
                                                    <option value="direct"> Direct Purchase Order</option>
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
