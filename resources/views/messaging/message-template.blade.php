@extends('layouts.app')

@section('content')
<div class="content-wrapper">

    <section class="content pt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="card-title">Message Template</h3>
                        </div>
                        <div class="col-md-6 text-end">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Create New
                            </button>
                        </div>

                        <div class="row mt-4">
                            @foreach($message_templates as $msg_template)
                            <div class="col-md-3">
                                <div class="card border-1 shadow-sm">
                                    <div class="card-body">
                                        {{$msg_template->title}}
                                    </div>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col-md">
                                                <button class="btn btn-sm btn-warning edit-button" data-bs-toggle="modal" data-bs-target="#editModal" data-item-id="{{$msg_template->id}}" data-item-title="{{$msg_template->title}}" data-item-content="{{$msg_template->content}}" data-item-vcard_name="{{$msg_template->vcard_name}}" data-item-vcard_number="{{$msg_template->vcard_number}}" data-item-image_attachment_url="{{$msg_template->image_attachment_url}}" data-item-video_attachment_url="{{$msg_template->video_attachment_url}}" data-item-audio_attachment_url="{{$msg_template->audio_attachment_url}}">
                                                    <i class="fa fa-edit"></i> Edit
                                                </button>
                                                <a href="{{route('messaging.template.destroy', ['id'=>$msg_template->id])}}" onclick="return confirm('Are you sure you want to delete this template?')">
                                                    <button class="btn btn-sm btn-danger">
                                                        <i class="fa fa-trash"></i> Delete
                                                    </button>
                                                </a>
                                                <button class="btn btn-sm btn-info view-button" data-bs-toggle="modal" data-bs-target="#viewModal" data-item-title="{{$msg_template->title}}" data-item-content="{{$msg_template->content}}" data-item-vcard_name="{{$msg_template->vcard_name}}" data-item-vcard_number="{{$msg_template->vcard_number}}" data-item-image_attachment_url="{{$msg_template->image_attachment_url}}" data-item-video_attachment_url="{{$msg_template->video_attachment_url}}" data-item-audio_attachment_url="{{$msg_template->audio_attachment_url}}">
                                                    <i class="fa fa-eye"></i> View
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endforeach
                        </div>


                        <!-- Modal for Editing Item -->
                        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit Message</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <form method="POST" action="{{ route('messaging.template.update') }}" enctype="multipart/form-data">
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
                                            <input name="id" id="editItemId" value="{{ old('title') }}" type="hidden">

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
                                                                <option>--select tag--</option>
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

                                            <div class="container mt-4">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="toggleSwitch2">
                                                    <label class="form-check-label" for="toggleSwitch">Add VCard</label>
                                                </div>

                                                <div class="togglevcard mt-3 d-none" id="toggleSection2">
                                                    <div class="form-group">
                                                        <label>Vcard Name</label>
                                                        <input name="vcard_name" id="editItemVcardName" class="form-control select2" style="width: 100%" value="{{ old('vcard_name') }}" autocomplete="vcard_name" autofocus>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Vcard Number</label>
                                                        <input name="vcard_number" id="editItemVcardNumber" class="form-control select2" style="width: 100%" value="{{ old('vcard_number') }}" autocomplete="vcard_number" autofocus>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="container mt-4">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="toggleMediaSwitch2">
                                                    <label class="form-check-label" for="toggleSwitch">Attach media</label>
                                                </div>

                                                <div class="togglevcard mt-3 d-none" id="toggleMediaSection2">
                                                    <div class="form-group">
                                                        <label>Attach Image</label>
                                                        <input name="image_attachment_url" type="file" class="form-control select2" style="width: 100%" value="{{ old('image_attachment_url') }}" autocomplete="image_attachment_url" autofocus>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Attach Video</label>
                                                        <input name="video_attachment_url" type="file" class="form-control select2" style="width: 100%" value="{{ old('video_attachment_url') }}" autocomplete="video_attachment_url" autofocus>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Attach Audio</label>
                                                        <input name="audio_attachment_url" type="file" class="form-control select2" style="width: 100%" value="{{ old('audio_attachment_url') }}" autocomplete="audio_attachment_url" autofocus>
                                                    </div>
                                                </div>
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

                        <!-- Modal for Viewing Item -->
                        <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="viewModalLabel">Message Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Place the content you want to display in the modal here -->
                                        <b class="text-dark">Title:</b>
                                        <div class="text-secondary mb-4" id="modalItemTitle"></div>
                                        <b class="text-dark">Content:</b>
                                        <div class="text-secondary mb-4 border p-2" id="modalItemContent"></div>
                                        <b class="text-dark">VCard name:</b>
                                        <div class="text-secondary mb-4" id="modalItemVcard_name"></div>
                                        <b class="text-dark">Vcard number:</b>
                                        <div class="text-secondary mb-4" id="modalItemVcard_number"></div>
                                        <b class="text-dark">Image attachment:</b>
                                        <div class="text-secondary mb-4" id="modalItemImage_attachment_url"></div>
                                        <b class="text-dark">Video attachement:</b>
                                        <div class="text-secondary mb-4" id="modalItemVideo_attachment_url"></div>
                                        <b class="text-dark">Audio Attachement:</b>
                                        <div class="text-secondary mb-4" id="modalItemAudio_attachment_url"></div>
                                        <!-- Add other details as needed -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- create new Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Create New Message</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="{{ route('messaging.template.store') }}" enctype="multipart/form-data">
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
                                                <label>Message Title</label>
                                                <input name="title" class="form-control select2  @error('title') is-invalid @enderror" style="width: 100%" value="{{ old('title') }}" autocomplete="title" autofocus>

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
                                                            <select name="tag" id="tagSelect" class="form-control select2  @error('tag') is-invalid @enderror" style="width: 100%" autocomplete="tag" autofocus>
                                                                <option>--select tag--</option>
                                                                @foreach($message_tag as $msgTag)
                                                                <option>{{$msgTag->tag}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <textarea name="content" id="contentTextarea" class="form-control select2  @error('content') is-invalid @enderror" style="width: 100%" autocomplete="content" autofocus rows="10">{{ old('content') }}</textarea>

                                                @error('content')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="container mt-4">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="toggleSwitch">
                                                    <label class="form-check-label" for="toggleSwitch">Add VCard</label>
                                                </div>

                                                <div class="togglevcard mt-3 d-none" id="toggleSection">
                                                    <div class="form-group">
                                                        <label>Vcard Name</label>
                                                        <input name="vcard_name" class="form-control select2" style="width: 100%" value="{{ old('vcard_name') }}" autocomplete="vcard_name" autofocus>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Vcard Number</label>
                                                        <input name="vcard_number" class="form-control select2" style="width: 100%" value="{{ old('vcard_number') }}" autocomplete="vcard_number" autofocus>
                                                    </div>
                                                </div>
                                            </div>




                                            <div class="container mt-4">
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="toggleMediaSwitch">
                                                    <label class="form-check-label" for="toggleSwitch">Attach media</label>
                                                </div>

                                                <div class="togglevcard mt-3 d-none" id="toggleMediaSection">
                                                    <div class="form-group">
                                                        <label>Attach Image</label>
                                                        <input name="image_attachment_url" type="file" class="form-control select2" style="width: 100%" value="{{ old('image_attachment_url') }}" autocomplete="image_attachment_url" autofocus>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Attach Video</label>
                                                        <input name="video_attachment_url" type="file" class="form-control select2" style="width: 100%" value="{{ old('video_attachment_url') }}" autocomplete="video_attachment_url" autofocus>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Attach Audio</label>
                                                        <input name="audio_attachment_url" type="file" class="form-control select2" style="width: 100%" value="{{ old('audio_attachment_url') }}" autocomplete="audio_attachment_url" autofocus>
                                                    </div>
                                                </div>
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
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var editButtons = document.querySelectorAll('.edit-button');
        var editModalTitleInput = document.getElementById('editItemTitle');
        var editModalIdInput = document.getElementById('editItemId');
        var editModalContentInput = document.getElementById('editItemContent contentTextarea2');
        var editModalVcardNameInput = document.getElementById('editItemVcardName');
        var editModalVcardNumberInput = document.getElementById('editItemVcardNumber');
        var editModalImageAttachmentUrlInput = document.getElementById('editItemImageAttachmentUrl');
        var editModalVideoAttachmentUrlInput = document.getElementById('editItemVideoAttachmentUrl');
        var editModalAudioAttachmentUrlInput = document.getElementById('editItemAudioAttachmentUrl');

        editButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var title = button.getAttribute('data-item-title');
                var id = button.getAttribute('data-item-id');
                var content = button.getAttribute('data-item-content');
                var vcard_name = button.getAttribute('data-item-vcard_name');
                var vcard_number = button.getAttribute('data-item-vcard_number');
                var image_attachment_url = button.getAttribute('data-item-image_attachment_url');
                var video_attachment_url = button.getAttribute('data-item-video_attachment_url');
                var audio_attachment_url = button.getAttribute('data-item-audio_attachment_url');

                editModalTitleInput.value = title;
                editModalIdInput.value = id;
                editModalContentInput.value = content;
                editModalVcardNameInput.value = vcard_name;
                editModalVcardNumberInput.value = vcard_number;
                editModalImageAttachmentUrlInput.value = image_attachment_url;
                editModalVideoAttachmentUrlInput.value = video_attachment_url;
                editModalAudioAttachmentUrlInput.value = audio_attachment_url;
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        var viewButtons = document.querySelectorAll('.view-button');

        viewButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var title = button.getAttribute('data-item-title');
                var content = button.getAttribute('data-item-content');
                var vcard_name = button.getAttribute('data-item-vcard_name');
                var vcard_number = button.getAttribute('data-item-vcard_number');
                var image_attachment_url = button.getAttribute('data-item-image_attachment_url');
                var video_attachment_url = button.getAttribute('data-item-video_attachment_url');
                var audio_attachment_url = button.getAttribute('data-item-audio_attachment_url');

                document.getElementById('modalItemTitle').innerText = title;
                document.getElementById('modalItemContent').innerText = content;
                document.getElementById('modalItemVcard_name').innerText = vcard_name;
                document.getElementById('modalItemVcard_number').innerText = vcard_number;
                document.getElementById('modalItemImage_attachment_url').innerText = image_attachment_url;
                document.getElementById('modalItemVideo_attachment_url').innerText = video_attachment_url;
                document.getElementById('modalItemAudio_attachment_url').innerText = audio_attachment_url;
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        var toggleSwitch = document.getElementById('toggleSwitch');
        var toggleSection = document.getElementById('toggleSection');

        toggleSwitch.addEventListener('change', function() {
            toggleSection.classList.toggle('d-none');
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        var toggleSwitch = document.getElementById('toggleMediaSwitch');
        var toggleSection = document.getElementById('toggleMediaSection');

        toggleSwitch.addEventListener('change', function() {
            toggleSection.classList.toggle('d-none');
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
        var toggleSwitch = document.getElementById('toggleMediaSwitch2');
        var toggleSection = document.getElementById('toggleMediaSection2');

        toggleSwitch.addEventListener('change', function() {
            toggleSection.classList.toggle('d-none');
        });
    });


    document.addEventListener('DOMContentLoaded', function() {
        var tagSelect = document.getElementById('tagSelect');
        var contentTextarea = document.getElementById('contentTextarea');

        tagSelect.addEventListener('change', function() {
            var selectedTag = tagSelect.value;
            var cursorPos = contentTextarea.selectionStart;
            var content = contentTextarea.value;

            var newContent = content.slice(0, cursorPos) + selectedTag + content.slice(cursorPos);

            contentTextarea.value = newContent;
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