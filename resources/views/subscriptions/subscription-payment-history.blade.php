@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Subscription Payment History</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Subscription</li>
                        <li class="breadcrumb-item active">Subscription details</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="card-title">Subscriptions</h3>
                                </div>
                                <div class="col-md-6 text-end">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Renew/Pay Subscription
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Plan</th>
                                        <th>Customer</th>
                                        <th>Subscription Due Date</th>
                                        <th>Subscription Duration</th>
                                        <th>Payment Status</th>
                                        <th>Payment Gateway</th>
                                        <th>Payment Type</th>
                                        <th>Payment Reference</th>
                                        <th>Payment Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($history as $history)
                                    <tr>
                                        <td>{{$history->productplan->plan->name}}</td>
                                        <td>{{$history->customer->name}}</td>
                                        <td>{{$history->next_due_date_payment}}</td>
                                        <td>{{$history->subscription_duration}}</td>
                                        <td>@if((int)$history->payment_status===1) <span class="text-success">Paid</span> @else <span class="text-danger">Unpaid</span> @endif</td>
                                        <td>{{$history->payment_gateway}}</td>
                                        <td>{{$history->payment_type}}</td>
                                        <td>{{$history->payment_reference}}</td>
                                        <td>{{$history->created_at}}</td>
                                    </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Plan</th>
                                        <th>Customer</th>
                                        <th>Next Due Date</th>
                                        <th>Subscription Duration</th>
                                        <th>Payment Status</th>
                                        <th>Payment Gateway</th>
                                        <th>Payment Type</th>
                                        <th>Payment Reference</th>
                                        <th>Payment Date</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>


                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Recurrent Subscription Payment</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="{{ route('subscriptions.history.store', ['id'=> $subscription->id]) }}">
                                        <div class="modal-body">

                                            @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            @endif

                                            @csrf()
                                            <div class="form-group">
                                                <label>Payment Option</label>
                                                <select name="payment_option" class="form-control select2  @error('payment_option') is-invalid @enderror" style="width: 100%" value="{{ old('payment_option') }}" autocomplete="payment_option" autofocus>
                                                    <option>--choose--</option>
                                                    <option value="pos">POS</option>
                                                    <option value="terminal">Terminal</option>
                                                </select>
                                                @error('payment_option')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Pay</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@push('scripts')
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script>
    $(function() {
        $("#example1")
            .DataTable({
                responsive: true,
                lengthChange: false,
                autoWidth: false,
                buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
            })
            .buttons()
            .container()
            .appendTo("#example1_wrapper .col-md-6:eq(0)");
        $("#example2").DataTable({
            paging: true,
            lengthChange: false,
            searching: false,
            ordering: true,
            info: true,
            autoWidth: false,
            responsive: true,
        });
    });
</script>
@endpush
@endsection