@extends('layouts.master')

@section('page-title', 'Админ панель')

@section('content')
    @include('layouts.admin-nav')
    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container">
            <div class="container-fluid py-5">
                <h1 class="display-5 fw-bold">Привіт: {{ Auth::user()->name }}
                </h1>
                <p class="col-md-8 fs-4">Адмін панель з якої виконується керування сайтом</p>
                <a href="{{ route('get-logout') }}" class="btn btn-danger btn-lg" type="button">Вийти з адмін панелі</a>
            </div>
        </div>
    </div>
@endsection
