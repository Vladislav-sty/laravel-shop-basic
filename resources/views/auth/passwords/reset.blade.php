@extends('layouts.master')

@section('page-title', 'Відновлення паролю')

@section('content')

    <div class="container" style="max-width: 500px; padding-top: 100px">
        <form class="form-signin" method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <h2>Вкажіть новий пароль у поля нижче</h2>

            @error('email')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
            <div class="form-label-group">
                <input name="email" type="text" id="inputEmail" class="form-control" placeholder="E-mail" autofocus="" value="{{ $email ?? old('email') }}">
            </div>

            @error('password')
            <div class="alert alert-danger" style="margin-top: 10px">
                {{ $message }}
            </div>
            @enderror
            <div class="form-label-group" style="margin-top: 10px">
                <input name="password" type="password" class="form-control" placeholder="Пароль">
            </div>

            <div class="form-label-group" style="margin-top: 10px">
                <input name="password_confirmation" type="password" class="form-control" placeholder="Підтвердіть пароль">
            </div>

            <button style="margin-top: 20px" class="btn btn-lg btn-primary btn-block" type="submit">Відновити</button>
        </form>
    </div>

@endsection










{{--@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection--}}
