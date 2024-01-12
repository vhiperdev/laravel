@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{$reseller->name}}</h1>
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
                                        <div class='customer_details_name'>Reseller Name:</div>
                                        <div class='customer_details_value'>
                                            {{$reseller->name}}
                                        </div>
                                    </div>
                                    <div class='profile-item'>
                                        <div class='customer_details_name'>User Name:</div>
                                        <div class='customer_details_value'>

                                            {{$reseller->username}}

                                        </div>
                                    </div>
                                    <div class='profile-item'>
                                        <div class='customer_details_name'>Whatsapp Number:</div>
                                        <div class='customer_details_value'>
                                            {{$reseller->whatsapp}}

                                        </div>
                                    </div>
                                    <div class='profile-item'>
                                        <div class='customer_details_name'>Application:</div>
                                        <div class='customer_details_value'>
                                            {{$reseller->application}}
                                        </div>
                                    </div><br />
                                    <div class='profile-item'>
                                        <div class='customer_details_name'>Key:</div>
                                        <div class='customer_details_value'>
                                            {{$reseller->key}}
                                        </div>
                                    </div><br />
                                    <div class='profile-item'>
                                        <div class='customer_details_name'>Screen:</div>
                                        <div class='customer_details_value'>
                                            {{$reseller->screen}}
                                        </div>
                                    </div><br />
                                    <div class='profile-item'>
                                        <div class='customer_details_name'>Mac:</div>
                                        <div class='customer_details_value'>
                                            {{$reseller->mac}}
                                        </div>
                                    </div><br />
                                    <div class='profile-item'>
                                        <div class='customer_details_name'>Server/provider:</div>
                                        <div class='customer_details_value'>
                                            {{$reseller->user->get_server->name??null}}
                                        </div>
                                    </div><br />
                                    <div class='profile-item'>
                                        <div class='customer_details_name'>Application:</div>
                                        <div class='customer_details_value'>
                                            {{$reseller->user->get_application->name??null}}
                                        </div>
                                    </div><br />
                                    <div class='profile-item'>
                                        <div class='customer_details_name'>Device:</div>
                                        <div class='customer_details_value'>
                                            {{$reseller->user->get_device->name??null}}
                                        </div>
                                    </div><br />
                                    <div class='profile-item'>
                                        <div class='customer_details_name'>Role:</div>
                                        <div class='customer_details_value'>
                                            Reseller
                                        </div>
                                    </div>
                                    <br />
                                    <div class='profile-item'>
                                        <div class='customer_details_name'>Created At:</div>
                                        <div class='customer_details_value'>
                                            {{$reseller->created_at}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4  mt-3">
                    <h3>Message alerts</h3>

                    @foreach($reseller->get_alert_history as $alert)

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

                    @if(count($reseller->get_alert_history)==0)
                    <span class="text-danger">No alert found</span>
                    @endif

                </div>
            </div>
        </div>
    </section>
</div>@endsection