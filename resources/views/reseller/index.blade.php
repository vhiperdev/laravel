@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Reseller</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Reseller</li>
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
                                    <h3 class="card-title">Reseller</h3>
                                </div>
                                <div class="col-md-6 text-end">
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="border-bottom">
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Whatsapp Number</th>
                                            <th>Expiry Date</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($resellers as $resell)
                                        <tr class="border-0">
                                            <td>{{$resell->user->name}}</td>
                                            <td>{{$resell->user->username}}</td>
                                            <td>{{$resell->user->whatsapp}}</td>
                                            <td>{{$resell->user->expiry_date}}</td>
                                            <td>{{$resell->role->name}}</td>
                                            <td>
                                                <a href="{{route('reseller.show', ['id'=>$resell->user->id])}}" title="View details"><button class="btn btn-info btn-sm"><i class="fa fa-eye"></i></button></a>
                                                <a href="{{route('reseller.edit', ['id'=>$resell->user->id])}}" title="Edit details"> <button class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></button></a>
                                                <a href="{{route('reseller.destroy', ['id'=>$resell->user->id])}}" title="Delete reseller" onclick="return confirm('Are you sure you want to delete this customer?')"><button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button></a>
                                                <a href="{{route('reseller.customers', ['id'=>$resell->user->id])}}" title="Reseller Customer"><button class="btn btn-dark btn-sm"><i class="fa fa-users"></i></button></a>
                                                <button title="Alert Reseller" class="btn btn-secondary btn-sm alert-button" data-bs-toggle="modal" data-bs-target="#alertModal" data-item-id="{{$resell->user->id}}" data-item-name="{{$resell->name}}"><i class="fa fa-comment"></i></button>
                                                <a title="Reseller Subscription" href="{{route('reseller.subscriptions', ['id'=>$resell->user->id])}}"><button class="btn btn-primary btn-sm"><i class="fa fa-briefcase"></i></button></a>

                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                    <tfoot>
                                        <tr class="border-top-0">
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Whatsapp Number</th>
                                            <th>Expiry Date</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <!-- Modal for Editing Item -->
    <div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel modalItemName">Alert </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('messaging.alert.reseller') }}" enctype="multipart/form-data">
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
                        <input name="reseller_id" id="modalItemId" value="{{ old('id') }}" type="hidden">


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

    const selectElement = document.getElementById('product_plan_id');

    async function fetchPlans() {
        var inputElement = document.getElementById("product");

        var inputValue = inputElement.value;

        await fetch(`/api/productplan/getplan/${inputValue}`)
            .then(response => {
                // Check if the request was successful (status code 200)
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                // Parse the response as JSON  
                return response.json();
            })
            .then(data => {
                // Handle the parsed data
                console.log("inputValue", data);

                selectElement.innerHTML = '';

                // Add a default option
                const defaultOption = document.createElement('option');
                defaultOption.text = 'Select an option';
                selectElement.add(defaultOption);

                // Populate options from the fetched data
                data.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.id;
                    option.text = item.plan.name;
                    selectElement.add(option);
                });

            })
            .catch(error => {
                // Handle errors
                console.error('Error during fetch operation:', error);
            });

    }



    document.addEventListener('DOMContentLoaded', function() {
        var toggleSwitch = document.getElementById('toggleSwitch2');
        var toggleSection = document.getElementById('toggleSection2');

        toggleSwitch.addEventListener('change', function() {
            toggleSection.classList.toggle('d-none');
        });
    });



    document.addEventListener('DOMContentLoaded', function() {
        var viewButtons = document.querySelectorAll('.alert-button');
        var modalItemId = document.getElementById('modalItemId')
        var modalItemName = document.getElementById('editModalLabel modalItemName')

        viewButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var id = button.getAttribute('data-item-id');
                var name = button.getAttribute('data-item-name');
                console.log({
                    id,
                    name
                })
                modalItemId.value = id;
                modalItemName.innerText = `Alert ${name}`;
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