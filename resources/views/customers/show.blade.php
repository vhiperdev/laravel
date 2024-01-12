@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{$customer->name}}</h1>
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
            <a href="{{ URL::previous() }}">
                <button class="btn btn-sm"><i class="fa fa-arrow-left fa-1x"></i></button>
            </a>
            <div class="row">
                <div class="col-12 col-md-8">
                    <div class="card mt-3 mb-5 border-0">
                        <div class="card-body">
                            <div class="row mt-4">
                                <div class="col-md-5 text-start">
                                    <div class='profile-item'>
                                        <div class='customer_details_name'>Customer Name</div>
                                        <div class='customer_details_value'>
                                            {{$customer->name}}
                                        </div>
                                    </div>
                                    <div class='profile-item'>
                                        <div class='customer_details_name'>User Name:</div>
                                        <div class='customer_details_value'>

                                            {{$customer->username}}

                                        </div>
                                    </div>
                                    <div class='profile-item'>
                                        <div class='customer_details_name'>Whatsapp Number</div>
                                        <div class='customer_details_value'>
                                            {{$customer->whatsapp}}

                                        </div>
                                    </div>
                                    <div class='profile-item'>
                                        <div class='customer_details_name'>Application</div>
                                        <div class='customer_details_value'>
                                            {{$customer->application}}
                                        </div>
                                    </div><br />
                                    <div class='profile-item'>
                                        <div class='customer_details_name'>Key</div>
                                        <div class='customer_details_value'>
                                            {{$customer->key}}
                                        </div>
                                    </div><br />
                                    <div class='profile-item'>
                                        <div class='customer_details_name'>Screen</div>
                                        <div class='customer_details_value'>
                                            {{$customer->screen}}
                                        </div>
                                    </div><br />
                                    <div class='profile-item'>
                                        <div class='customer_details_name'>Mac</div>
                                        <div class='customer_details_value'>
                                            {{$customer->mac}}
                                        </div>
                                    </div><br />
                                    <div class='profile-item'>
                                        <div class='customer_details_name'>Server/provider</div>
                                        <div class='customer_details_value'>
                                            {{$customer->get_server->name}}
                                        </div>
                                    </div><br />
                                    <div class='profile-item'>
                                        <div class='customer_details_name'>Application</div>
                                        <div class='customer_details_value'>
                                            {{$customer->get_application->name}}
                                        </div>
                                    </div><br />
                                    <div class='profile-item'>
                                        <div class='customer_details_name'>Device</div>
                                        <div class='customer_details_value'>
                                            {{$customer->get_device->name}}
                                        </div>
                                    </div>
                                    <br />
                                    <div class='profile-item'>
                                        <div class='customer_details_name'>Created At</div>
                                        <div class='customer_details_value'>
                                            {{$customer->created_at}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4  mt-3">
                    <h3>Message alerts</h3>

                    @foreach($customer->get_alert_history as $alert)

                    <div class="card shadow-none">
                        <div class="card-header bg-white fs-6">
                            {{$alert->created_at}}
                        </div>
                        <div class="card-body bg-white">
                            {{$alert->message_content}}

                        </div>
                        <div class="card-footer bg-white">
                            @if($alert->delivery_status)
                            <span class="text-success">Delivered</span>
                            @else
                            <span class="text-danger">Not delivered</span>
                            @endif
                        </div>
                    </div>
                    @endforeach

                    @if(count($customer->get_alert_history)==0)
                    <span class="text-danger">No alert found</span>
                    @endif
                </div>
            </div>
        </div>
    </section>
</div>@endsection