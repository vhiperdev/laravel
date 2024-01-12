@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container my-4">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="card-title">Billing</h3>
                </div>
                <div class="col-md-6 text-end">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Create New Bill
                    </button>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                @foreach($billings as $bill)
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="card border-1 shadow-sm">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-10">
                                    <div class="fs-6">{{$bill->title}} </div>
                                    <div style="font-size:.7rem">@if($bill->automatic_sending===1) Automatic @else Manual @endif</div>
                                </div>
                                <div class="col-2">
                                    <div class="form-check form-switch">
                                        <input name="thursday_billing" value="1" class="form-check-input" type="checkbox" title="automatic sending" id="thursdayBilling" onchange="automaticSending({{ $bill['id'] }}, {{$bill['automatic_sending']}})" @if($bill->automatic_sending) checked @endif>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-2">
                            <div class="row">
                                <div class="col-6">
                                    <a href="{{route('billing.history', ['id'=> $bill->id])}}" class="text-dark"> <span class="bg-dark me-1 rounded" style="padding:3.7px 3.7px; width:20px; font-size: 7px"><i class="fa fa-terminal"></i></span>{{$bill->customer_received_count}}</a>
                                </div>
                                <div class="col-6 text-end">
                                    <svg class="me-1" xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path d="M498.1 5.6c10.1 7 15.4 19.1 13.5 31.2l-64 416c-1.5 9.7-7.4 18.2-16 23s-18.9 5.4-28 1.6L284 427.7l-68.5 74.1c-8.9 9.7-22.9 12.9-35.2 8.1S160 493.2 160 480V396.4c0-4 1.5-7.8 4.2-10.7L331.8 202.8c5.8-6.3 5.6-16-.4-22s-15.7-6.4-22-.7L106 360.8 17.7 316.6C7.1 311.3 .3 300.7 0 288.9s5.9-22.8 16.1-28.7l448-256c10.7-6.1 23.9-5.5 34 1.4z" />
                                    </svg>{{$bill->customer_count}}
                                </div>

                                <div class="col-12 mt-2 overflow-hidden">
                                    <span class="me-1"><i class="fa fa-server me-1"></i></span> {{$bill->get_server->name}}
                                </div>
                                <div class="col-12 mt-2 overflow-hidden">
                                    <span class="me-1"><i class="fa fa-comment me-1"></i></span> {{$bill->get_message_template->title}}
                                </div>
                                <div class="col-12 mt-2 overflow-hidden">
                                    <span class="me-1"><i class="fa fa-clock"></i></span> {{$bill->created_at}}
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md">
                                    <a href="{{route('messaging.alert.send', ['id'=>$bill->id])}}" onclick="return confirm('Are you sure you want to send this bill?')">
                                        <button class="btn btn-sm btn-warning edit-button">
                                            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="16" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                <path d="M498.1 5.6c10.1 7 15.4 19.1 13.5 31.2l-64 416c-1.5 9.7-7.4 18.2-16 23s-18.9 5.4-28 1.6L284 427.7l-68.5 74.1c-8.9 9.7-22.9 12.9-35.2 8.1S160 493.2 160 480V396.4c0-4 1.5-7.8 4.2-10.7L331.8 202.8c5.8-6.3 5.6-16-.4-22s-15.7-6.4-22-.7L106 360.8 17.7 316.6C7.1 311.3 .3 300.7 0 288.9s5.9-22.8 16.1-28.7l448-256c10.7-6.1 23.9-5.5 34 1.4z" />
                                            </svg>
                                            Send
                                        </button>
                                    </a>
                                    <button class="btn btn-sm btn-secondary edit-button" data-bs-toggle="modal" data-bs-target="#editModal" data-id="{{$bill->id}}" data-application="{{$bill->application_id}}" data-title="{{$bill->title}}" data-device="{{$bill->device_id}}" data-server="{{$bill->server}}" data-default-message="{{$bill->default_message}}" data-shipping-time="{{$bill->shipping_time}}" data-automatic-billing="{{$bill->automatic_billing}}" data-days-to-expire="{{$bill->days_to_expire}}" data-sending-interval="{{$bill->shipping_interval}}" data-customer-subscription-situation="{{$bill->customer_subscription_status}}" data-monday-billing="{{$bill->monday_billing}}" data-tuesday-billing="{{$bill->tuesday_billing}}" data-wednesday-billing="{{$bill->wednesday_billing}}" data-thursday-billing="{{$bill->thursday_billing}}" data-friday-billing="{{$bill->friday_billing}}" data-saturday-billing="{{$bill->saturday_billing}}" data-daily-billing="{{$bill->daily_billing}}" data-sunday-billing="{{$bill->sunday_billing}}" SELECT `id`, ``, `automatic_sending`, `automatic_billing`, `sunday_billing`, `daily_billing`, `monday_billing`, `tuesday_billing`, `wednesday_billing`, `thursday_billing`, `friday_billing`, `saturday_billing`, `shipping_time`, `default_message`, `server`, `application_id`, `device_id`, `customer_referal_id`, `customer_subscription_status`, `days_to_expire`, `shipping_interval`, `last_shipment`, `customer_count`, `customer_received_count`>
                                        <i class="fa fa-edit"></i> Edit
                                    </button>
                                    <a href="{{route('billing.destroy', ['id'=>$bill->id])}}" onclick="return confirm('Are you sure you want to delete this item?')">
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
                    <h5 class="modal-title" id="exampleModalLabel">Create New Billing</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="{{ route('billing.store') }}" enctype="multipart/form-data">
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




                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-configure-tab" data-bs-toggle="pill" data-bs-target="#pills-configure" type="button" role="tab" aria-controls="pills-configure" aria-selected="true">Configure</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-automatic-tab" data-bs-toggle="pill" data-bs-target="#pills-automatic" type="button" role="tab" aria-controls="pills-automatic" aria-selected="false">Automatic</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-configure" role="tabpanel" aria-labelledby="pills-configure-tab">

                                <div class="form-group">
                                    <label>Title</label>
                                    <input name="title" class="form-control select2  @error('title') is-invalid @enderror" style="width: 100%" value="{{ old('title') }}" autocomplete="title" autofocus>

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Message</label>
                                    <select name="default_message" id="tagSelect" class="form-control select2  @error('default_message') is-invalid @enderror" style="width: 100%" autocomplete="default_message" autofocus>
                                        <option value="">--select message--</option>
                                        @foreach($message_templates as $msgTemp)
                                        <option value="{{$msgTemp->id}}">{{$msgTemp->title}}</option>
                                        @endforeach
                                    </select>
                                    @error('default_message')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label>Server</label>
                                    <select name="server" id="server" class="form-control select2  @error('server') is-invalid @enderror" style="width: 100%" autocomplete="server" autofocus>
                                        <option>--select server--</option>
                                        @foreach($servers as $server)
                                        <option value="{{$server->id}}">{{$server->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('server')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Device</label>
                                    <select name="device_id" id="device_id" class="form-control select2  @error('device_id') is-invalid @enderror" style="width: 100%" autocomplete="device_id" autofocus>
                                        <option>--select device--</option>
                                        @foreach($devices as $device)
                                        <option value="{{$device->id}}">{{$device->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('device_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Application</label>
                                    <select name="application_id" id="application_id" class="form-control select2  @error('application_id') is-invalid @enderror" style="width: 100%" autocomplete="application_id" autofocus>
                                        <option>--select application--</option>
                                        @foreach($applications as $app)
                                        <option value="{{$app->id}}">{{$app->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('application_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Customer Subscription Situation</label>
                                            <select name="customer_subscription_status" id="customer_subscription_status" class="form-control select2  @error('customer_subscription_status') is-invalid @enderror" style="width: 100%" autocomplete="customer_subscription_status" autofocus>
                                                <option>--select option--</option>
                                                <option value="all_client">All clients</option>
                                                <option value="active">Active</option>
                                                <option value="in_active">InActive</option>
                                                <option value="already_due">Already Due</option>
                                                <option value="due_today">Due Today</option>
                                            </select>
                                            @error('customer_subscription_status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Sending interval</label>
                                            <input type="number" name="shipping_interval" class="form-control select2  @error('shipping_interval') is-invalid @enderror" style="width: 100%" value="{{ old('shipping_interval') }}" autocomplete="shipping_interval" autofocus>

                                            @error('shipping_interval')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Difference in days between today and the due date</label>
                                    <input type="number" name="days_to_expire" class="form-control select2  @error('days_to_expire') is-invalid @enderror" style="width: 100%" value="{{ old('days_to_expire') }}" autocomplete="days_to_expire" autofocus>

                                    @error('days_to_expire')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!-- To learn more about how to create a charge you can click here to see the tutorial with examples of the most used charges -->
                            </div>
                            <div class="tab-pane fade" id="pills-automatic" role="tabpanel" aria-labelledby="pills-automatic-tab">

                                <div class="form-check form-switch">
                                    <input name="automatic_billing" value="1" class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Automatic billing
                                    </label>
                                </div>
                                <div class="form-group mt-3">
                                    <label>Shipping Time</label>
                                    <input type="time" name="shipping_time" class="form-control select2  @error('shipping_time') is-invalid @enderror" style="width: 100%" value="{{ old('shipping_time') }}" autocomplete="shipping_time" autofocus>

                                    @error('shipping_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="row mt-3">
                                    <div class="col-6 col-sm-4 col-md-4 col-lg-6">
                                        <div class="form-check form-switch">
                                            <input name="daily_billing" value="1" class="form-check-input" type="checkbox" id="dailyBilling">
                                            <label class="form-check-label" for="dailyBilling">Daily billing
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-6 col-sm-4 col-md-4 col-lg-6">
                                        <div class="form-check form-switch">
                                            <input name="sunday_billing" value="1" class="form-check-input" type="checkbox" id="sundayBilling">
                                            <label class="form-check-label" for="sundayBilling">Sunday billing
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-6 col-sm-4 col-md-4 col-lg-6">
                                        <div class="form-check form-switch">
                                            <input name="monday_billing" value="1" class="form-check-input" type="checkbox" id="mondayBilling">
                                            <label class="form-check-label" for="mondayBilling">Monday billing
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-6 col-sm-4 col-md-4 col-lg-6">
                                        <div class="form-check form-switch">
                                            <input name="tuesday_billing" value="1" class="form-check-input" type="checkbox" id="tuesdayBilling">
                                            <label class="form-check-label" for="tuesdayBilling">Tuesday billing
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-6 col-sm-4 col-md-4 col-lg-6">
                                        <div class="form-check form-switch">
                                            <input name="wednesday_billing" value="1" class="form-check-input" type="checkbox" id="wednesdayBilling">
                                            <label class="form-check-label" for="wednesdayBilling">Wednesday billing
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-6 col-sm-4 col-md-4 col-lg-6">
                                        <div class="form-check form-switch">
                                            <input name="thursday_billing" value="1" class="form-check-input" type="checkbox" id="thursdayBilling">
                                            <label class="form-check-label" for="thursdayBilling">Thursday billing
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-6 col-sm-4 col-md-4 col-lg-6">
                                        <div class="form-check form-switch">
                                            <input name="friday_billing" value="1" class="form-check-input" type="checkbox" id="fridayBilling">
                                            <label class="form-check-label" for="fridayBilling">Friday billing
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-6 col-sm-4 col-md-4 col-lg-6">
                                        <div class="form-check form-switch">
                                            <input name="saturday_billing" value="1" class="form-check-input" type="checkbox" id="sundayBilling">
                                            <label class="form-check-label" for="sundayBilling">Saturday billing
                                            </label>
                                        </div>
                                    </div>
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

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Bill</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="POST" action="{{ route('billing.update') }}" enctype="multipart/form-data">

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
                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-configure2-tab" data-bs-toggle="pill" data-bs-target="#pills-configure2" type="button" role="tab" aria-controls="pills-configure2" aria-selected="true">Configure</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-automatic2-tab" data-bs-toggle="pill" data-bs-target="#pills-automatic2" type="button" role="tab" aria-controls="pills-automatic2" aria-selected="false">Automatic</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-configure2" role="tabpanel" aria-labelledby="pills-configure2-tab">
                                <input name="id" id="editId" type="hidden">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input name="title" id="editTitle" class="form-control select2  @error('title') is-invalid @enderror" style="width: 100%" value="{{ old('title') }}" autocomplete="title" autofocus>

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Message</label>
                                    <select name="default_message" id="editDefaultMessage" class="form-control select2  @error('default_message') is-invalid @enderror" style="width: 100%" autocomplete="default_message" autofocus>
                                        <option value="">--select message--</option>
                                        @foreach($message_templates as $msgTemp)
                                        <option value="{{$msgTemp->id}}">{{$msgTemp->title}}</option>
                                        @endforeach
                                    </select>
                                    @error('default_message')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label>Server</label>
                                    <select name="server" id="editServer" class="form-control select2  @error('server') is-invalid @enderror" style="width: 100%" autocomplete="server" autofocus>
                                        <option>--select server--</option>
                                        @foreach($servers as $server)
                                        <option value="{{$server->id}}">{{$server->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('server')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Device</label>
                                    <select name="device_id" id="editDevice" class="form-control select2  @error('device_id') is-invalid @enderror" style="width: 100%" autocomplete="device_id" autofocus>
                                        <option>--select device--</option>
                                        @foreach($devices as $device)
                                        <option value="{{$device->id}}">{{$device->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('device_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Application</label>
                                    <select name="application_id" id="editApplication" class="form-control select2  @error('application_id') is-invalid @enderror" style="width: 100%" autocomplete="application_id" autofocus>
                                        <option>--select application--</option>
                                        @foreach($applications as $app)
                                        <option value="{{$app->id}}">{{$app->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('application_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Customer Subscription Situation</label>
                                            <select name="customer_subscription_status" id="editCustomerSubscriptionSituation" class="form-control select2  @error('customer_subscription_status') is-invalid @enderror" style="width: 100%" autocomplete="customer_subscription_status" autofocus>
                                                <option>--select option--</option>
                                                <option value="all_client">All clients</option>
                                                <option value="active">Active</option>
                                                <option value="in_active">InActive</option>
                                                <option value="already_due">Already Due</option>
                                                <option value="due_today">Due Today</option>
                                            </select>
                                            @error('customer_subscription_status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Sending interval</label>
                                            <input type="number" name="shipping_interval" id="editSendingInterval" class="form-control select2  @error('shipping_interval') is-invalid @enderror" style="width: 100%" value="{{ old('shipping_interval') }}" autocomplete="shipping_interval" autofocus>

                                            @error('shipping_interval')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Difference in days between today and the due date</label>
                                    <input type="number" name="days_to_expire" id="editDaysToExpire" class="form-control select2  @error('days_to_expire') is-invalid @enderror" style="width: 100%" value="{{ old('days_to_expire') }}" autocomplete="days_to_expire" autofocus>

                                    @error('days_to_expire')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!-- To learn more about how to create a charge you can click here to see the tutorial with examples of the most used charges -->
                            </div>
                            <div class="tab-pane fade" id="pills-automatic2" role="tabpanel" aria-labelledby="pills-automatic2-tab">

                                <div class="form-check form-switch">
                                    <input name="automatic_billing" value="1" id="editAutomaticBilling" class="form-check-input" type="checkbox">
                                    <label class="form-check-label" for="editAutomaticBilling">Automatic billing
                                    </label>
                                </div>
                                <div class="form-group mt-3">
                                    <label>Shipping Time</label>
                                    <input type="time" name="shipping_time" id="editShippingTime" class="form-control select2  @error('shipping_time') is-invalid @enderror" style="width: 100%" value="{{ old('shipping_time') }}" autocomplete="shipping_time" autofocus>

                                    @error('shipping_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="row mt-3">
                                    <div class="col-6 col-sm-4 col-md-4 col-lg-6">
                                        <div class="form-check form-switch">
                                            <input name="daily_billing" value="1" id="editDailyBilling" class="form-check-input" type="checkbox" id="dailyBilling">
                                            <label class="form-check-label" for="dailyBilling">Daily billing
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-6 col-sm-4 col-md-4 col-lg-6">
                                        <div class="form-check form-switch">
                                            <input name="sunday_billing" value="1" id="editSundayBilling" class="form-check-input" type="checkbox" id="sundayBilling">
                                            <label class="form-check-label" for="sundayBilling">Sunday billing
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-6 col-sm-4 col-md-4 col-lg-6">
                                        <div class="form-check form-switch">
                                            <input name="monday_billing" value="1" id="editMondayBilling" class="form-check-input" type="checkbox" id="mondayBilling">
                                            <label class="form-check-label" for="mondayBilling">Monday billing
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-6 col-sm-4 col-md-4 col-lg-6">
                                        <div class="form-check form-switch">
                                            <input name="tuesday_billing" value="1" id="editTuesdayBilling" class="form-check-input" type="checkbox" id="tuesdayBilling">
                                            <label class="form-check-label" for="tuesdayBilling">Tuesday billing
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-6 col-sm-4 col-md-4 col-lg-6">
                                        <div class="form-check form-switch">
                                            <input name="wednesday_billing" value="1" id="editWednesdayBilling" class="form-check-input" type="checkbox" id="wednesdayBilling">
                                            <label class="form-check-label" for="wednesdayBilling">Wednesday billing
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-6 col-sm-4 col-md-4 col-lg-6">
                                        <div class="form-check form-switch">
                                            <input name="thursday_billing" value="1" id="editThursdayBilling" class="form-check-input" type="checkbox" id="thursdayBilling">
                                            <label class="form-check-label" for="thursdayBilling">Thursday billing
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-6 col-sm-4 col-md-4 col-lg-6">
                                        <div class="form-check form-switch">
                                            <input name="friday_billing" value="1" id="editFridayBilling" class="form-check-input" type="checkbox" id="fridayBilling">
                                            <label class="form-check-label" for="fridayBilling">Friday billing
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-6 col-sm-4 col-md-4 col-lg-6">
                                        <div class="form-check form-switch">
                                            <input name="saturday_billing" value="1" id="editSaturdayBilling" class="form-check-input" type="checkbox" id="sundayBilling">
                                            <label class="form-check-label" for="sundayBilling">Saturday billing
                                            </label>
                                        </div>
                                    </div>
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
</div>


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var editButtons = document.querySelectorAll('.edit-button');
        var editId = document.getElementById('editId');
        var editTitle = document.getElementById('editTitle');
        var editApplication = document.getElementById('editApplication');
        var editDevice = document.getElementById('editDevice');
        var editServer = document.getElementById('editServer');
        var editDefaultMessage = document.getElementById('editDefaultMessage');
        var editShippingTime = document.getElementById('editShippingTime');
        var editAutomaticBilling = document.getElementById('editAutomaticBilling');
        var editDaysToExpire = document.getElementById('editDaysToExpire');
        var editSendingInterval = document.getElementById('editSendingInterval');
        var editCustomerSubscriptionSituation = document.getElementById('editCustomerSubscriptionSituation');
        var editMondayBilling = document.getElementById('editMondayBilling');
        var editSundayBilling = document.getElementById('editSundayBilling');
        var editTuesdayBilling = document.getElementById('editTuesdayBilling');
        var editWednesdayBilling = document.getElementById('editWednesdayBilling');
        var editThursdayBilling = document.getElementById('editThursdayBilling');
        var editFridayBilling = document.getElementById('editFridayBilling');
        var editSaturdayBilling = document.getElementById('editSaturdayBilling');
        var editDailyBilling = document.getElementById('editDailyBilling');





        editButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                editId.value = button.getAttribute('data-id');
                editTitle.value = button.getAttribute('data-title');
                editApplication.value = button.getAttribute('data-application');
                editDevice.value = button.getAttribute('data-device');
                editServer.value = button.getAttribute('data-server');
                editDefaultMessage.value = button.getAttribute('data-default-message');
                editShippingTime.value = button.getAttribute('data-shipping-time');
                editAutomaticBilling.checked = Number(button.getAttribute('data-automatic-billing')) === 1 ? true : false;
                editDaysToExpire.value = button.getAttribute('data-days-to-expire');
                editSendingInterval.value = button.getAttribute('data-sending-interval');
                editCustomerSubscriptionSituation.value = button.getAttribute('data-customer-subscription-situation');
                editMondayBilling.checked = parseInt(button.getAttribute('data-monday-billing')) === 1 ? true : false;
                editSundayBilling.checked = parseInt(button.getAttribute('data-sunday-billing')) === 1 ? true : false;
                editTuesdayBilling.checked = parseInt(button.getAttribute('data-tuesday-billing')) === 1 ? true : false;
                editWednesdayBilling.checked = parseInt(button.getAttribute('data-wednesday-billing')) === 1 ? true : false;
                editThursdayBilling.checked = parseInt(button.getAttribute('data-thursday-billing')) === 1 ? true : false;
                editFridayBilling.checked = parseInt(button.getAttribute('data-friday-billing')) === 1 ? true : false;
                editSaturdayBilling.checked = parseInt(button.getAttribute('data-saturday-billing')) === 1 ? true : false;
                editDailyBilling.checked = parseInt(button.getAttribute('data-daily-billing')) === 1 ? true : false;

            });
        });
    });

    async function automaticSending(id, value) {

        await fetch(`/api/billing/sedingmode/${id}/${value==0?1:0}`)
            .then(response => {
                // Check if the request was successful (status code 200)
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                return response.json();
            })
            .then(data => {

                console.log(data);
                window.location.reload();
            })
            .catch(error => {
                // Handle errors
                alert(error.message)
                console.error('Error during fetch operation:', error);
            });
    }
</script>
@endpush
@endsection