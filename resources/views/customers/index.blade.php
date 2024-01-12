@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{$page_title}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">{{$page_title}}</li>
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
                            <h3 class="card-title">Customer</h3>
                        </div>

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Whatsapp Number</th>
                                        <th>Screen</th>
                                        <th>Application</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($customers as $customer)
                                    <tr>
                                        <td>{{$customer->name}}</td>
                                        <td>{{$customer->username}}</td>
                                        <td>{{$customer->whatsapp}}</td>
                                        <td>{{$customer->screen}}</td>
                                        <td>{{$customer->get_application->name}}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>

                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="{{route('customers.show', ['id'=>$customer->id])}}">View Customer</a>
                                                    <a class="dropdown-item" href="{{route('customers.edit', ['id'=>$customer->id])}}">Edit Customer</a>
                                                    <a class="dropdown-item text-warning alert-button" href="#" data-bs-toggle="modal" data-bs-target="#alertModal" data-item-id="{{$customer->id}}" data-item-name="{{$customer->name}}">Alert Customer</a>
                                                    <a class="dropdown-item" href="{{route('customers.subscriptions', ['id'=>$customer->id])}}">Subscriptions</a>
                                                    <a class="dropdown-item text-danger" href="{{route('customers.destroy', ['id'=>$customer->id])}}" onclick="return confirm('Are you sure you want to delete this customer?')">Delete</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Whatsapp Number</th>
                                        <th>Screen</th>
                                        <th>Application</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<!-- Modal for Editing Item -->
<div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel modalItemName">Alert </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('messaging.alert.customer') }}" enctype="multipart/form-data">
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
                    <input name="customer_id" id="modalItemId" value="{{ old('id') }}" type="hidden">


                    <div class="form-group">
                        <label for="">Select Template</label>
                        <select name="message" class="form-control select2  @error('message') is-invalid @enderror" style="width: 100%" autocomplete="message" autofocus>
                            <option value="">--select Message--</option>
                            @foreach($message_templates as $msgTag)
                            <option value="{{$msgTag->id}}">{{$msgTag->title}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="container mt-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="toggleSwitch2">
                            <label class="form-check-label" for="toggleSwitch">Compose new message</label>
                        </div>

                        <div class="togglevcard mt-3 d-none" id="toggleSection2">
                            <div class="form-group">
                                <label>Message Title</label>
                                <input name="title" id="editItemTitle" class="form-control select2  @error('title') is-invalid @enderror" style="width: 100%" value="{{ old('title') }}" autocomplete="title" autofocus>

                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <div class="container-fluid mb-2">
                                    <div class="row">
                                        <div class="col-6">

                                            <label>Message</label>
                                        </div>
                                        <div class="col-6">
                                            <select name="tag" id="tagSelect2" class="form-control select2  @error('tag') is-invalid @enderror" style="width: 100%" autocomplete="tag" autofocus>
                                                <option value="">--select tag--</option>
                                                @foreach($message_tag as $msgTag)
                                                <option>{{$msgTag->tag}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <textarea name="content" id="editItemContent contentTextarea2" class="form-control select2  @error('content') is-invalid @enderror" style="width: 100%" autocomplete="content" autofocus rows="10">{{ old('content') }}</textarea>

                                @error('content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Alert</button>
                </div>
            </form>
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
        var toggleSwitch = document.getElementById('toggleSwitch2');
        var toggleSection = document.getElementById('toggleSection2');

        toggleSwitch.addEventListener('change', function() {
            toggleSection.classList.toggle('d-none');
        });
    });


    document.addEventListener('DOMContentLoaded', function() {
        var viewButtons = document.querySelectorAll('.alert-button');

        viewButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var id = button.getAttribute('data-item-id');
                var name = button.getAttribute('data-item-name');

                document.getElementById('modalItemId').value = id;
                document.getElementById('editModalLabel modalItemName').innerText = `Alert ${name}`;
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        var tagSelect = document.getElementById('tagSelect2');
        var contentTextarea = document.getElementById('editItemContent contentTextarea2');

        tagSelect.addEventListener('change', function() {
            var selectedTag = tagSelect.value;
            var cursorPos = contentTextarea.selectionStart;
            var content = contentTextarea.value;

            var newContent = content.slice(0, cursorPos) + selectedTag + content.slice(cursorPos);

            contentTextarea.value = newContent;
        });
    });
</script>
@endpush
@endsection