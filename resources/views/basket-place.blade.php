@extends('layouts.master')

@section('page-title', 'Подтверждение заказа')

@section('content')
    <div class="container">

        <h1 style="margin-bottom: 40px; margin-top: 40px" class="display-7 fw-bold lh-1">Підтвердіть замовлення:</h1>
        <p>Загальна вартість вашого замовлення: <b>{{ $order->getFullPrice() }} {{ \App\Classes\CurrencyConversion::getCurrencySymbol() }}</b></p>
        <form action="{{ route('save-order') }}" method="post">
            @csrf
            @error('placeName')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
            <div class="form-group">
                <input type="text" class="form-control" name="placeName" placeholder="Ваше ім'я">
            </div>
            @error('placePhone')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
            <div class="form-group" style="margin: 20px 0;">
                <input type="text" class="form-control" name="placePhone" placeholder="Ваш номер телефону">
            </div>
            @guest
                <div class="form-group" style="margin: 20px 0;">
                    <input type="email" class="form-control" name="placeEmail" placeholder="Ваш e-mail">
                </div>
            @endguest
            <button type="submit" class="btn btn-primary">Підтвердити</button>
        </form>

    </div>
@endsection
