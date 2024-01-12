@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container my-4">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="card-title">Referal Platform</h3>
                </div>
                <div class="col-md-6 text-end">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Create New
                    </button>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                @foreach($customer_referals as $customerRef)
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="card border-1 shadow-sm">
                        <div class="card-body">
                            <div class="fs-5 fw-bolder">{{$customerRef->name}}</div>
                            <div class="fs-6 fw-lighter">Cost Per User: {{$settings->currencyDetails->symbol}}{{$customerRef->cost_per_customer}}</div>
                            <div class="fs-6 fw-lighter"> Amount Earned: {{$settings->currencyDetails->symbol}}{{$customerRef->amount_earned}}</div>
                            <div class="fs-6 fw-lighter">Date added: {{$customerRef->created_at}}</div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md">
                                    <button class="btn btn-sm btn-warning edit-button" data-bs-toggle="modal" data-bs-target="#editModal" data-item-id="{{$customerRef->id}}" data-item-name="{{$customerRef->name}}" data-item-cost_per_customer="{{$customerRef->cost_per_customer}}" data-item-amount_earned="{{$customerRef->amount_earned}}">
                                        <i class="fa fa-edit"></i> Edit
                                    </button>
                                    <a href="{{route('customer_referal.destroy', ['id'=>$customerRef->id])}}" onclick="return confirm('Are you sure you want to delete this item?')">
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- create new Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create New Referal Platform</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('customer_referal.store') }}" enctype="multipart/form-data">
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
                            <label>Name</label>
                            <input name="name" class="form-control select2  @error('name') is-invalid @enderror" style="width: 100%" value="{{ old('name') }}" autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Cost Per Referal</label>
                            <input name="cost_per_customer" class="form-control select2  @error('cost_per_customer') is-invalid @enderror" style="width: 100%" value="{{ old('cost_per_customer') }}" autocomplete="cost_per_customer" autofocus>

                            @error('cost_per_customer')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Amount Earned</label>
                            <input name="amount_earned" class="form-control select2  @error('amount_earned') is-invalid @enderror" style="width: 100%" value="{{ old('amount_earned') }}" autocomplete="amount_earned" autofocus>

                            @error('amount_earned')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Application</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" action="{{ route('customer_referal.update') }}" enctype="multipart/form-data">
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
                        <input name="id" id="editItemId" value="{{ old('id') }}" type="hidden">

                        <div class="form-group">
                            <label>Application Name</label>
                            <input name="name" id="editItemName" class="form-control select2  @error('name') is-invalid @enderror" style="width: 100%" value="{{ old('name') }}" autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Cost Per Referal</label>
                            <input name="cost_per_customer" id="costPerCustomer" class="form-control select2  @error('cost_per_customer') is-invalid @enderror" style="width: 100%" value="{{ old('cost_per_customer') }}" autocomplete="cost_per_customer" autofocus>

                            @error('cost_per_customer')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Amount Earned</label>
                            <input name="amount_earned" id="amountEarned" class="form-control select2  @error('amount_earned') is-invalid @enderror" style="width: 100%" value="{{ old('amount_earned') }}" autocomplete="amount_earned" autofocus>

                            @error('amount_earned')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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


    document.addEventListener('DOMContentLoaded', function() {
        var editButtons = document.querySelectorAll('.edit-button');
        var editModalNameInput = document.getElementById('editItemName');
        var editModalIdInput = document.getElementById('editItemId');
        var costPerCustomer = document.getElementById('costPerCustomer');
        var amountEarned = document.getElementById('amountEarned');

        editButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                editModalNameInput.value = button.getAttribute('data-item-name');
                editModalIdInput.value = button.getAttribute('data-item-id');
                costPerCustomer.value = button.getAttribute('data-item-cost_per_customer');
                amountEarned.value = button.getAttribute('data-item-amount_earned');

            });
        });
    });
</script>
@endpush
@endsection