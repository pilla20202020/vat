@extends('layouts.admin.admin')

@section('page-specific-styles')
    <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/TableTools.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/lightbox.css') }}"/>
@endsection

@section('title', 'Billing Advice List')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="d-flex">
                <header class="text-capitalize pt-1">Billing Advice List</header>
                <div class="tools ml-auto">
                    <a class="btn btn-primary ink-reaction" href="{{ route('billingadvice.create') }}">
                        <i class="md md-add"></i>
                        Generate a Billing Advice
                    </a>
                </div>
            </div>
            <div class="card mt-2 p-4">
                <div class="table-responsive">
                    <table id="example" class="table table-hover display">
                        <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Job Order Invoice</th>
                            <th>Billing Advice Date</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @each('transaction.billing_advice.partials.table', $billingadvices, 'billingadvice')
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>


    {{-- Is Status Modal --}}
    <div class="modal fade statusacceptmodal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-self-center mt-0 text-center" id="exampleModalLabel">Approve Billing Advice</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('billingadvice.updatestatus')}}" method="GET" class="form form-validate floating-label">
                        @csrf
                        <input type="hidden" class="billing_id_status" value="" name="billing_id" id="">
                        <input type="hidden" value="accepted" name="is_accepted" id="">
                        <div class="row justify-content-center">
                            <div class="col-md-12 mt-2">
                                <label class="control-label">Remarks </label>
                                <input type="text" name="remarks" class="form-control" required>
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

    <div class="modal fade statusrejectmodal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title align-self-center mt-0 text-center" id="exampleModalLabel">Reject Billing Advice</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('billingadvice.updatestatus')}}" method="GET" class="form form-validate floating-label">
                        @csrf
                        <input type="hidden" class="billing_id_status" value="" name="billing_id" id="">
                        <input type="hidden" value="rejected" name="is_accepted" id="">
                        <div class="row justify-content-center">
                            <div class="col-md-12 mt-2">
                                <label class="control-label">Remarks </label>
                                <input type="text" name="remarks" class="form-control" required>
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
@endsection
@section('page-specific-scripts')
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/lightbox.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#example').DataTable();
        });

        $(document).on('click', '.btn-approve', function() {
            var billing_id = $(this).data('billing_id');
            $(".billing_id_status").val(billing_id);
            $('.statusacceptmodal').modal('show');
        })


        $(document).on('click', '.btn-reject', function() {
            var billing_id = $(this).data('billing_id');
            $(".billing_id_status").val(billing_id);
            $('.statusrejectmodal').modal('show');
        })

    </script>


@endsection


