@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile Settings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Profile Settings</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">

                            <form method="POST" action="{{ route('profile') }}" enctype="multipart/form-data">
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
                                        <input name="name" id="editItemName" class="form-control select2  @error('name') is-invalid @enderror" style="width: 100%" value="{{ old('name')??$profile->name }}" autocomplete="name" autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Email</label>
                                        <input name="email" id="email" class="form-control select2  @error('email') is-invalid @enderror" style="width: 100%" value="{{ $profile->email }}" autocomplete="email" autofocus disabled>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>



                                    <div class="form-group">
                                        <label>{{__('messages.whatsapp_menu')}}</label>
                                        <input name="whatsapp" id="whatsapp" class="form-control select2  @error('whatsapp') is-invalid @enderror" style="width: 100%" value="{{ old('whatsapp') }}" autocomplete="whatsapp" autofocus disabled>

                                        @error('whatsapp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label>Old Password</label>
                                        <input name="old_password" type="password" id="old_password" class="form-control select2  @error('old_password') is-invalid @enderror" style="width: 100%" value="{{ old('old_password') }}" autocomplete="old_password" autofocus>

                                        @error('old_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label>New Password</label>
                                        <input name="new_password" type="password" id="new_password" class="form-control select2  @error('new_password') is-invalid @enderror" style="width: 100%" value="{{ old('new_password') }}" autocomplete="new_password" autofocus>

                                        @error('new_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Comfirm Password</label>
                                        <input name="confirm_password" type="password" id="confirm_password" class="form-control select2  @error('confirm_password') is-invalid @enderror" style="width: 100%" value="{{ old('confirm_password') }}" autocomplete="confirm_password" autofocus>

                                        @error('confirm_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>


                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


</div>
@endsection