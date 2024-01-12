@extends('layouts.app-auth')

@section('content')
@php
$countries = \App\Models\Country::get();
@endphp

<div class="login-wrapper bg-white">
    <div class="intern8">
        <form action="{{ url('/lang') }}" method="GET">
            @csrf
            <select name="locale" class="form-control" onchange="this.form.submit()">
                <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>English</option>
                <option value="pt" {{ session()->get('locale') == 'pt' ? 'selected' : '' }}>Portuguese</option>
            </select>
        </form>

    </div>
    <div class="row h-100">
        <div class="col-md-6 d-none d-md-flex">
            <div class="overflow-hidden vh-100 w-100">
                <img src="{{asset('dist/img/login_bg.jpeg')}}" class="w-100">
            </div>
        </div>

        <div class="col-12 col-md-6 my-auto d-flex justify-content-center">

            <div class="register-box">
                <div class="card card-outline card-primary shadow-none border-0">
                    <div class="card-header text-center border-0">
                        <a href="/" class="h1"><b>{{ config('app.name', 'Laravel') }}</b></a>
                    </div>
                    <div class="card-body">
                        <p class="login-box-msg">{{ __('messages.reseller_register') }}</p>
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="{{__('messages.name')}}">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="input-group mb-3">
                                <input type="text" id="username" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required autocomplete="name" autofocus placeholder="{{__('messages.username')}}">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>


                            <div class="input-group mb-3">
                                <div>
                                    <select name="country_code" id="" class="form-control @error('country_code') is-invalid @enderror px-1" value="{{ old('country_code') }}" style="width:100px">
                                        @foreach($countries as $country)
                                        <option value="+{{$country['Phone Code']}}">{{$country->ISO2}} - +{{$country['Phone Code']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <input type="text" id="whatsapp" name="whatsapp" class="form-control @error('whatsapp') is-invalid @enderror" value="{{ old('whatsapp') }}" required autocomplete="name" autofocus placeholder="{{__('messages.whatsapp')}}">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                                @error('whatsapp')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                @error('country_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="input-group mb-3">
                                <input type="text" id="server" name="server" class="form-control @error('server') is-invalid @enderror" value="{{ old('server') }}" required autocomplete="server" autofocus placeholder="{{__('messages.server')}}">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                                @error('server')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>



                            <div class="input-group mb-3">
                                <input type="text" id="device" name="device" class="form-control @error('device') is-invalid @enderror" value="{{ old('device') }}" required autocomplete="device" autofocus placeholder="{{__('messages.device')}}">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                                @error('device')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="input-group mb-3">
                                <input type="text" id="application" name="application" class="form-control @error('application') is-invalid @enderror" value="{{ old('application') }}" required autocomplete="application" autofocus placeholder="{{__('messages.application')}}">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                                @error('application')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="input-group mb-3">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{__('messages.email')}}">

                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-envelope"></span>
                                    </div>
                                </div>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="input-group mb-3">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="{{__('messages.password')}}">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="input-group mb-3">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="{{__('messages.retypepassword')}}">

                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <div class="icheck-primary">
                                        <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                        <label for="agreeTerms">
                                            {{__('messages.terms')}} <a href="#">terms</a>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-primary btn-block">{{ __('messages.register') }}</button>
                                </div>

                            </div>
                        </form>
                        <a href="/login" class="text-center">{{__('messages.already')}}</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection