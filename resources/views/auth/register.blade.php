@extends('layouts.master')

@section('page-title', 'Регистрация')

@section('content')

    <div class="container" style="max-width: 500px; padding-top: 100px">
        <form class="form-signin" action="{{ route('register') }}" method="post">
            @csrf

            <h2>Реєстрація</h2>

            @error('name')
                <div class="alert alert-danger" style="margin-top: 10px">
                    {{ $message }}
                </div>
            @enderror
            <div class="form-label-group" style="margin-top: 10px">
                <input value="{{ old('name') }}" name="name" type="text" id="inputEmail" class="form-control" placeholder="Ім'я" autofocus="">
            </div>

            @error('email')
                <div class="alert alert-danger" style="margin-top: 10px">
                    {{ $message }}
                </div>
            @enderror
            <div class="form-label-group" style="margin-top: 10px">
                <input value="{{ old('email') }}" name="email" type="email" id="inputEmail" class="form-control" placeholder="E-mail" autofocus="">
            </div>

            @error('password')
                <div class="alert alert-danger" style="margin-top: 10px">
                    {{ $message }}
                </div>
            @enderror
            <div class="form-label-group" style="margin-top: 10px">
                <input value="{{ old('password') }}" name="password" type="password" id="inputPassword" class="form-control" placeholder="Пароль">
            </div>

            @error('password')
                <div class="alert alert-danger" style="margin-top: 10px">
                    {{ $message }}
                </div>
            @enderror
            <div class="form-label-group" style="margin-top: 10px">
                <input value="{{ old('password') }}" name="password_confirmation" type="password" id="inputEmail" class="form-control" placeholder="Підтвердіть пароль" autofocus="">
            </div>

            <button style="margin-top: 20px" class="btn btn-lg btn-danger btn-block" type="submit">Реєстрація</button>
        </form>
    </div>

@endsection
