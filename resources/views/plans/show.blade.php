@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{$plan->name}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">All Plan</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <a href="{{ URL::previous() }}">
                <button class="btn btn-sm"><i class="fa fa-arrow-left fa-1x"></i></button>
            </a>
            <div class="row">
                <div class="col-12">
                    <div class="card mt-3 mb-5 border-0">
                        <div class="card-body">
                            <div class="row mt-4">
                                <div class="col-md-5 text-start">
                                    <div class='profile-item'>
                                        <div class='customer_details_name'>Plan Name</div>
                                        <div class='customer_details_value'>
                                            {{$plan->name}}
                                        </div>
                                    </div>
                                    <div class='profile-item'>
                                        <div class='customer_details_name'>Value</div>
                                        <div class='customer_details_value'>
                                            {{$plan->value}}
                                        </div>
                                    </div><br />
                                    <div class='profile-item'>
                                        <div class='customer_details_name'>Created At</div>
                                        <div class='customer_details_value'>
                                            {{$plan->created_at}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>@endsection