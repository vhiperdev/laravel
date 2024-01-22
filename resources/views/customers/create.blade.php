@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Customer</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">All customers</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card-body">
                        <section class="content">
                            <div class="container-fluid">
                                <div class="card card-default">
                                    <div class="card-header">
                                        <h3 class="card-title">Fill the form to create a customer</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                Bulk upload <i class="fa fa-upload"></i>
                                            </button>
                                            <a href="{{asset('customer_template.csv')}}" download="customer_template.csv">
                                                <button type="button" class="btn btn-info">
                                                    Download bulk template <i class="fa fa-download"></i>
                                                </button>
                                            </a>
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="card-body">

                                        @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif

                                        <form method="POST" action="{{ route('customers.store') }}">
                                            @csrf()
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <input name="name" class="form-control select2  @error('name') is-invalid @enderror" style="width: 100%" value="{{ old('name') }}" autocomplete="name" autofocus required>

                                                        @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Username</label>
                                                        <input name="username" class="form-control select2  @error('username') is-invalid @enderror" style="width: 100%" value="{{ old('username') }}" autocomplete="username" autofocus required>

                                                        @error('username')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Screen</label>
                                                        <input name="screen" class="form-control select2  @error('screen') is-invalid @enderror" style="width: 100%" value="{{ old('screen') }}" autocomplete="screen" autofocus>

                                                        @error('screen')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Whatsapp Number</label>
                                                        <input name="whatsapp" type="tel" class="form-control select2  @error('whatsapp') is-invalid @enderror" style="width: 100%" value="{{ old('whatsapp') }}" autocomplete="whatsapp" placeholder="+2344325677785" autofocus required>

                                                        @error('whatsapp')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>


                                                    <div class="form-group">
                                                        <label>Device</label>
                                                        <select name="device_id" class="form-control select2 @error('device_id') is-invalid @enderror" style="width: 100%" autocomplete="device_id" autofocus>
                                                            <option value="" selected>--choose--</option>
                                                            @foreach($device as $dev)
                                                            <option value="{{ $dev->id }}" @if(old('device_id')==$dev->id) selected @endif>
                                                                {{ $dev->name }}
                                                            </option>
                                                            @endforeach
                                                        </select>

                                                        @error('device_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Password</label>
                                                        <input name="password" class="form-control select2  @error('password') is-invalid @enderror" style="width: 100%" value="{{ old('password') }}" autocomplete="password" autofocus required>

                                                        @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group d-none d-md-block">
                                                        <button class="btn btn-primary btn-md">Create</button>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">



                                                    <div class="form-group">
                                                        <label>Server/Provider</label>

                                                        <select name="server" class="form-control select2 @error('server') is-invalid @enderror" style="width: 100%" autocomplete="server" autofocus>
                                                            <option value="" selected>--choose--</option>
                                                            @foreach($server as $serve)
                                                            <option value="{{ $serve->id }}" @if(old('server')==$serve->id) selected @endif>
                                                                {{ $serve->name }}
                                                            </option>
                                                            @endforeach
                                                        </select>

                                                        @error('server')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Application</label>


                                                        <select name="application_id" class="form-control select2 @error('application_id') is-invalid @enderror" style="width: 100%" autocomplete="application_id" autofocus>
                                                            <option value="" selected>--choose--</option>
                                                            @foreach($application as $app)
                                                            <option value="{{ $app->id }}" @if(old('application_id')==$app->id) selected @endif>
                                                                {{ $app->name }}
                                                            </option>
                                                            @endforeach
                                                        </select>

                                                        @error('application_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Mac</label>
                                                        <input name="mac" class="form-control select2  @error('mac') is-invalid @enderror" style="width: 100%" value="{{ old('mac') }}" autocomplete="mac" autofocus>

                                                        @error('mac')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Key</label>
                                                        <input name="key" class="form-control select2  @error('key') is-invalid @enderror" style="width: 100%" value="{{ old('key') }}" autocomplete="key" autofocus>

                                                        @error('key')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>


                                                    <div class="form-group d-md-none">
                                                        <button class="btn btn-primary btn-md">Create</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </form>

                                    </div>
                                </div>

                            </div>
                        </section>
                    </div>
                </div>
            </div>
    </section>


    >
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bulk upload customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('customer.bulkupload') }}" enctype="multipart/form-data">
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
                            <label>Upload .csv file</label>
                            <input name="customer_file" type="file" accept=".csv" class="form-control select2  @error('customer_file') is-invalid @enderror" style="width: 100%" autofocus>

                            @error('customer_file')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection