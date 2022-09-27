@extends('layouts.admin.admin')

@section('page-specific-styles')
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/TableTools.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/lightbox.css') }}"/>
@endsection

@section('title', 'Company List')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="d-flex">
                <header class="text-capitalize pt-1">Company List</header>
                <div class="tools ml-auto">
                    <a class="btn btn-primary ink-reaction" href="{{ route('company.create') }}">
                        <i class="md md-add"></i>
                        Add company
                    </a>
                </div>
            </div>
            <div class="card mt-2 p-4">
                <div class="table-responsive">
                    <table id="example" class="table table-hover display">
                        <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>VAT</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @each('company.partials.table', $companies, 'company')
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    {{-- Add Branches --}}
    <div class="modal fade bs-example-modal-center add_branches" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-self-center mt-0 text-center" id="exampleModalLabel">Change Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('company.store_branches')}}" method="POST" class="form form-validate floating-label">
                        @csrf
                        <input type="hidden" class="company_id" value="" name="company_id" id="">
                        <div class="row justify-content-center">
                            <div class="col-md-12 mt-2">
                                <label class="control-label">Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>

                            <div class="col-md-12 mt-2">
                                <label class="control-label">Address</label>
                                <input type="text" name="address" class="form-control">
                            </div>

                            <div class="col-md-12 mt-2">
                                <label class="control-label">VAT</label>
                                <input type="text" name="vat" class="form-control">
                            </div>
                        </div>

                        <hr>
                        <div class="row mt-2 justify-content-center">
                            <div class="form-group">
                                <div>
                                    <input type="submit" name="pageSubmit" class="btn btn-danger waves-effect waves-light" value="Submit">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    {{-- View Payment Modal --}}
    <div class="modal fade viewbranchesmodal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-self-center mt-0 text-center" id="exampleModalLabel">View Branches</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>S.No.</th>
                                <th>Name</th>
                                <th>VAT</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody id="branches">

                        </tbody>
                    </table>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection
@section('page-specific-scripts')
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/lightbox.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#example').DataTable();
        });

        $(document).on('click','.addbranch',function (e) {
            let company_id = $(this).data('company_id');
            $(".company_id").val(company_id);
            $('.add_branches').modal('show');
        });


        $(document).on('click','.viewbranch',function (e) {
            let company_id = $(this).data('company_id');
            $.ajax({
                type: 'get',
                url: '{{route('company.getbranches')}}',
                data: {
                    company_id: company_id,
                },
                success:function(response){
                if(typeof(response) != 'object'){
                    response = JSON.parse(response)
                }
                var tbody_html = "";
                if(response.status){
                    $.each(response.data, function(key, branch){
                        key = key+1;
                        tbody_html += "<tr>";
                        tbody_html += "<td>"+key+"</td>";
                        tbody_html += "<td>"+branch.name+"</td>";
                        tbody_html += "<td>"+branch.vat+"</td>";
                        tbody_html += "<td>"+branch.address+"</td>";
                        tbody_html += "</tr>";
                    });
                    $('#branches').html(tbody_html);
                    $('.viewbranchesmodal').modal('show');
                }
            }

            })
        });


    </script>


@endsection


