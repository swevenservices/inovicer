@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-4">
            <h1><img src="{{asset('img/logo.png')}}"></h1>

            <p class="text-white">{{ trans('global.login') }}</p>

            @if(session('message'))
                <div class="alert alert-info" role="alert">
                    {{ session('message') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-user"></i>
                            </span>
                    </div>

                    <input id="email" name="email" type="text"
                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required
                           autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}"
                           value="{{ old('email', null) }}">

                    @if($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-lock"></i></span>
                    </div>

                    <input id="password" name="password" type="password"
                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required
                           placeholder="{{ trans('global.login_password') }}">

                    @if($errors->has('password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                </div>

                <div class="input-group mb-4">
                    <div class="form-check checkbox">
                        <input class="form-check-input" name="remember" type="checkbox" id="remember"
                               style="vertical-align: middle;"/>
                        <label style="color: white" class="form-check-label" for="remember"
                               style="vertical-align: middle;">
                            {{ trans('global.remember_me') }}
                        </label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <button type="submit" class="btn btn-primary px-4 loginbtn">
                            {{ trans('global.login') }}
                        </button>
                    </div>
                    <div class="col-6 text-right">
                        @if(Route::has('password.request'))
                            <a style="color: white" class="btn btn-link px-0" href="{{ route('password.request') }}">
                                {{ trans('global.forgot_password') }}
                            </a><br>
                        @endif

                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $('.loginbtn').on('click', function () {
            $('.loginbtn').html("<i class='fa fa-spinner fa-spin'></i>");
        });
    </script>
@endsection