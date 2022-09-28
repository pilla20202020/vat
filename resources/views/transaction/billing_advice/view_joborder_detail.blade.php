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
            <form class="form form-validate floating-label" action="{{ route('billingadvice.store') }}" method="POST"
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
                                        <div class="col-sm-6">
                                            <div class="form-group ">
                                                <label for="name" class="col-form-label pt-0">Select
                                                    Job Order</label>
                                                <select class="select2 mb-3 select2-multiple select_job_order"
                                                    style="width: 100%" data-placeholder="Choose Job Order"
                                                    name="joborder_id">
                                                    <option value="" disabled selected> Select Job Order</option>
                                                    @foreach ($joborders as $data)
                                                        <option value="{{ $data->id }}" @if(isset($joborder) && ($joborder->id == $data->id)) selected @endif>{{ $data->invoice }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <h5>View Product/Service</h5>
                                    @if(isset($joborder->orderDetails) && $joborder->orderDetails->isEmpty() == false)
                                        @foreach ($joborder->orderDetails as $key => $detail)
                                            <div class="form-group row d-flex align-items-end">.
                                                <div class="col-sm-3">
                                                    <label for="name" class="col-form-label pt-0">Components</label>
                                                    <input type="text" readonly name="product_id[]" value="@if($detail->type == "product")  {{$detail->product($detail->product_id)->name}} @else {{$detail->service($detail->product_id)->name}} @endif" class="form-control change_status_commission">
                                                    

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
                                    @endif

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
