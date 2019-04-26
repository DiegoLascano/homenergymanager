@extends('layouts.app')

@section('sidebar')
    {{-- @parent --}}
@endsection

@section('content')
<div class="my-auto">
    <div class="form-box mx-auto">
        <p class="text-cyan-800 text-center text-md font-bold mb-4 uppercase">Registration Form</p>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-4">
                <label class="label-text" for="name">
                    Name
                </label>
                <input name="name" class="input-box" id="name" type="name" placeholder="Name" required>
            </div>
            <div class="mb-4">
                <label class="label-text" for="email">
                    Email
                </label>
                <input name="email" class="input-box" id="email" type="email" placeholder="Email">
            </div>
            <div class="mb-4">
                <label class="label-text" for="password">
                    Password
                </label>
                <input name="password" class="input-box" id="password" type="password" placeholder="******************" required>
            </div>
            <div class="mb-6">
                <label class="label-text" for="password_confirmation">
                    Password Confirmation
                </label>
                <input name="password_confirmation" class="input-box" id="password_confirmation" type="password_confirmation" placeholder="******************" required>
            </div>
            <div class="flex flex-wrap items-center justify-between">
                <button class="btn btn-primary" type="submit">
                    Register
                </button>
                <a class="inline-block align-baseline font-bold text-sm text-cyan-600 hover:text-cyan-900 mt-2 md:mt-0" href="/login">
                    Already have an account?
                </a>
            </div>
        </form>
        @include('partials.errors')
    </div>
</div>
@endsection
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Password_confirmation') }}</label>

                            <div class="col-md-6">
                                <input id="password_confirmation" type="password_confirmation" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password_confirmation-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password_confirmation') }}</label>

                            <div class="col-md-6">
                                <input id="password_confirmation-confirm" type="password_confirmation" class="form-control" name="password_confirmation_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}