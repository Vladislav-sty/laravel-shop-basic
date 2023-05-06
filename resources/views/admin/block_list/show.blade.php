@extends('layouts.master')

@section('page-title', 'Користувач: '. $user['name'])

@section('content')
    @include('layouts.admin-nav')
    <div style="padding-top: 40px">
        <div class="container">
            <h3 class="display-6 fw-bold" style="padding-bottom: 20px">Користувач: {{ $user->name }}</h3>

            <div>
                <b>Ім'я: {{ $user->name }}</b><br>
                <b>ID: {{ $user->id }}</b><br>
                <b>E-mail: {{ $user->email }}</b><br>
                <b>Дата реєстрації: {{ $user->created_at }}</b><br>
                @if($user->is_blocked)
                    <b>Причина блокування: {{ $user->is_blocked->cause }}</b><br>
                    <b>Дата блокування: {{ $user->is_blocked->created_at }}</b><br>
                @endif
            </div>
        </div>
    </div>
@endsection
