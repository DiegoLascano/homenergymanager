@extends('layouts.app')

@section('sidebar')
    {{-- @parent --}}
@endsection

@section('content')
<div class="my-auto">
    <div class="form-box mx-auto">
        <p class="text-cyan-800 text-center text-md font-bold mb-4 uppercase">Iniciar sesión</p>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            {{-- <div class="mb-4">
                <label class="block text-grey-darker text-sm font-bold mb-2" for="username">
                    Username
                </label>
                <input class="input-box focus:shadow-outline" id="username" type="text" placeholder="Username">
            </div> --}}
            <div class="mb-4">
                <label class="label-text" for="email">
                    Email
                </label>
                <input name="email" class="input-box focus:border-cyan-600" id="email" type="email" placeholder="Email" required>
            </div>
            <div class="mb-6">
                <label class="label-text" for="password">
                    Contraseña
                </label>
                <input name="password" class="input-box focus:border-cyan-600" id="password" type="password" placeholder="******************" required>
            </div>
            <div class="flex flex-wrap items-center justify-between">
                <button class="btn btn-outline" type="submit">
                    Iniciar sesión
                </button>
                <a class="inline-block align-baseline font-bold text-sm text-cyan-600 hover:text-cyan-900 mt-2 md:mt-0" href="#">
                    Olvidaste tu contraseña?
                </a>
            </div>
        </form>
        @include('partials.errors')
    </div>
</div>
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
