@extends('layouts.app-auth')

@section('content')
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

            <div class="login-box">
                <div class="login-logo">
                    <a href="/"><b>{{ config('app.name', 'Laravel') }}</b></a>
                </div>

                <div class="card shadow-none">
                    <div class="card-body login-card-body">
                        <p class="login-box-msg">{{ __('Login') }} to start your session</p>
                        <form action="/login" method="post">
                            @csrf
                            <div class="input-group mb-3"><input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

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
                            <div class="row">
                                <div class="col-8">
                                    <div class="icheck-primary">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('messages.remember') }}
                                        </label>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        {{ __('messages.login') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                        <p class="mb-1">
                            @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}">
                                {{ __('messages.forgot') }}
                            </a>
                            @endif
                        </p>
                        <p class="mb-0">
                            <a href="/register" class="text-center">{{ __('messages.register') }}</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection