@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Update Customer</h1>
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
                    <div class="col-12">
                        <section class="content">
                            <div class="container-fluid">

                                <a href="{{ URL::previous() }}">
                                    <button class="btn btn-sm"><i class="fa fa-arrow-left fa-1x"></i></button>
                                </a>
                                <div class="card card-default mt-2">
                                    <div class="card-header">
                                        <h3 class="card-title">Fill the form to create a customer</h3>
                                        <div class="card-tools">
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

                                        <form method="POST" action="{{ route('plan.update', ['id'=>$plan->id]) }}">
                                            @csrf()
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <input name="name" class="form-control select2  @error('name') is-invalid @enderror" style="width: 100%" value="{{ old('name')?? $plan->name }}" autocomplete="name" autofocus>

                                                        @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Value</label>
                                                        <input name="value" class="form-control select2  @error('value') is-invalid @enderror" style="width: 100%" value="{{ old('value')?? $plan->value }}" autocomplete="value" autofocus>

                                                        @error('value')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>


                                                    <div class="form-group">
                                                        <button class="btn btn-primary btn-md">Update</button>
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
    </section>
</div>
@endsection