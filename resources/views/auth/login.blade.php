@extends('layouts.master')

@section('page-title', 'Авторизация')

@section('content')

    <div class="container" style="max-width: 500px; padding-top: 100px">
        <form class="form-signin" action="{{ route('login') }}" method="post">
            @csrf

            <h2>Авторизація</h2>

            @error('email')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
            <div class="form-label-group">
                <input name="email" type="email" id="inputEmail" class="form-control" placeholder="E-mail" required="" autofocus="">
            </div>

            @error('password')
            <div class="alert alert-danger">
                {{ $message }}
            </div>
            @enderror
            <div class="form-label-group" style="margin-top: 10px">
                <input name="password" type="password" id="inputPassword" class="form-control" placeholder="Пароль" required="">
            </div>

            <button style="margin-top: 20px" class="btn btn-lg btn-danger btn-block" type="submit">Увійти</button>
        </form>
    </div>

@endsection
