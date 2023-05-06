@extends('layouts.master')

@section('page-title', 'Регистрация')

@section('content')

    <div class="container" style="max-width: 500px; padding-top: 100px">
        <form class="form-signin">

            <h2>Создать новый аккаунт</h2>

            <div class="form-label-group">
                <label for="inputEmail">Email address</label>
                <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required="" autofocus="">
            </div>

            <div class="form-label-group" style="margin-top: 10px">
                <label for="inputPassword">Password</label>
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="">
            </div>

            <button style="margin-top: 20px" class="btn btn-lg btn-danger btn-block" type="submit">Создать аккаунт</button>
        </form>
    </div>

@endsection
