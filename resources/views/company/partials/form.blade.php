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
                    <header class="ml-3 mt-2">{!! $header !!}</header>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-12">

                            <div class="form-group ">
                                <label for="name" class="col-form-label pt-0">Company Name</label>
                                <div class="">
                                    <input class="form-control" type="text" required name="name" value="{{ old('name', isset($company->name) ? $company->name : '') }}" placeholder="Enter company Name">
                                </div>
                            </div>

                        </div>


                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label for="email" class="col-form-label pt-0">Email</label>
                                <div class="">
                                    <input class="form-control" type="text" required name="email" value="{{ old('email', isset($company->email) ? $company->email : '') }}" placeholder="Enter Company Email">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label for="address" class="col-form-label pt-0">Address</label>
                                <div class="">
                                    <input class="form-control" type="text" required name="address" value="{{ old('address', isset($company->address) ? $company->address : '') }}" placeholder="Enter Company Address">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label for="vat" class="col-form-label pt-0">VAT NO.</label>
                                <div class="">
                                    <input class="form-control" type="number" required name="vat" value="{{ old('vat', isset($company->vat) ? $company->vat : '') }}" placeholder="Enter Company VAT NO.">
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label for="notification" class="col-form-label pt-0">Notification</label>
                                <div class="">
                                    <input class="form-control" type="number" required name="notification" value="{{ old('notification', isset($company->notification) ? $company->notification : '') }}" placeholder="Enter Notification">
                                </div>
                            </div>
                        </div>

                        
                    </div>

                    <hr>
                    <div class="row mt-2 justify-content-center">
                        <div class="form-group">
                            <div>
                                <a class="btn btn-light waves-effect ml-1" href="{{ route('company.index') }}">
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
    </script>
@endsection
