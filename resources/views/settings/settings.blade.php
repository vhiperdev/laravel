@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Settings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Settings</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <form method="POST" action="{{ route('settings.update') }}" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-6 col-md-6">

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
                            <label>Site Name</label>
                            <input type="text" name="site_name" value="{{$settings->site_name}}" class="form-control select2 @error('site_name') is-invalid @enderror" style="width: 100%" autocomplete="site_name" autofocus>


                            @error('site_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Site Description</label>
                            <input name="site_description" value="{{$settings->site_description}}" class="form-control select2 @error('site_description') is-invalid @enderror" style="width: 100%" autocomplete="site_description" autofocus>


                            @error('site_description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label>Default Currency</label>
                            <select name="currency" class="form-control select2  @error('currency') is-invalid @enderror" style="width: 100%" autocomplete="currency" autofocus>
                                <option>--choose--</option>

                                @foreach($curencies as $currency)
                                <option value="{{$currency->id}}" @if(old('currency', optional($settings->currencyDetails)->id)==$currency->id) selected @endif >{{$currency->name}}</option>
                                @endforeach
                            </select>
                            @error('currency')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Time Zone</label>
                            <select name="timezone" class="form-control select2  @error('timezone') is-invalid @enderror" style="width: 100%" autocomplete="timezone" autofocus>
                                <option>--choose--</option>
                                <option value="UTC" @if($settings->timezone=='UTC') selected @endif>UTC</option>
                                <option value="America/Sao_Paulo" @if($settings->timezone=='America/Sao_Paulo') selected @endif>America/Sao_Paulo</option>

                            </select>
                            @error('timezone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Payment Message</label>
                            <select name="default_payment_message" class="form-control select2 @error('default_payment_message') is-invalid @enderror" style="width: 100%" autocomplete="default_payment_message" autofocus>
                                <option value="" selected>--choose--</option>
                                @foreach($message_templates as $msg_template)
                                <option value="{{ $msg_template->id }}" @if(old('default_payment_message', optional($settings->message_template)->id) == $msg_template->id) selected @endif>
                                    {{ $msg_template->title }}
                                </option>
                                @endforeach
                            </select>

                            @error('default_payment_message')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mt-3 ">
                            <label>Mercado Pago Access Token</label>
                            <textarea name="mp_access_token" class="form-control select2 @error('mp_access_token') is-invalid @enderror" style="width: 100%">{{$settings->mp_access_token}}</textarea>
                            @error('mp_access_token')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group d-none d-md-block">
                            <button type="submit" class="btn btn-warning">Save</button>
                        </div>
                    </div>

                    <div class="col-6 col-md-6">

                        <div class="form-group">
                            <label>Site Logo</label>
                            <div>
                                <img src="{{asset($settings->site_logo)}}" class="w-25">
                            </div>
                            <input name="site_logo" type="file" class="form-control mt-3 select2 @error('site_logo') is-invalid @enderror" style="width: 100%" autocomplete="site_logo" autofocus>


                            @error('site_logo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>



                        <div class="form-group">
                            <label>Site Favicon</label>
                            <div>
                                <img src="{{asset($settings->site_favicon)}}" class="w-25 mb-3">
                            </div>

                            <input name="site_favicon" type="file" class="form-control mt-2 select2 @error('site_favicon') is-invalid @enderror" style="width: 100%" autocomplete="site_favicon" autofocus>

                            @error('site_favicon')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group d-md-none">
                            <button type="submit" class="btn btn-warning">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>@endsection