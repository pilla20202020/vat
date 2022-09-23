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
                            {{-- <div class="form-group">
                                <input type="text" name="name" class="form-control" required
                                       value="{{ old('name', isset($product->name) ? $product->name : '') }}"/>
                                <span id="textarea1-error" class="text-danger">{{ $errors->first('name') }}</span>
                                <label for="Name">Name</label>
                            </div> --}}

                            <div class="form-group ">
                                <label for="name" class="col-form-label pt-0">Product Name</label>
                                <div class="">
                                    <input class="form-control" type="text" required name="name" value="{{ old('name', isset($product->name) ? $product->name : '') }}" placeholder="Enter Product Name">
                                </div>
                            </div>

                        </div>

                        <div class="col-sm-12">
                            <div class="form-group ">
                                <label for="name" class="col-form-label pt-0">Select Product Category</label>
                                <div class="">
                                    <select data-placeholder="Select Product Category"
                                        class="select2 tail-select form-control " id=""
                                        name="productcategory_id" required>
                                        <option value="" selected disabled >Select Product Category</option>
                                        @foreach ($productcategories as $productcategory)
                                            <option value="{{ $productcategory->id }}" @if(old('productcategory_id') == $productcategory->id) selected @endif @if(isset($productcategory) && ($productcategory->productcategory_id == $productcategory->id)) selected @endif>{{ ucfirst($productcategory->name) }}</option>
                                        @endforeach
                                    </select>
                                    @error('productcategory_id')
                                        <span class="text-danger">{{ $errors->first('productcategory_id') }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>

                    <hr>
                    <div class="row mt-2 justify-content-center">
                        <div class="form-group">
                            <div>
                                <a class="btn btn-light waves-effect ml-1" href="{{ route('product-category.index') }}">
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
