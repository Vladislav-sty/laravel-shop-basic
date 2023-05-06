@extends('layouts.master')

@section('page-title', 'Замовлення: №' . $order->id)

@section('content')
    @include('layouts.admin-nav')
    <div style="padding-top: 40px">
        <div class="container">
            <h3 class="display-6 fw-bold" style="padding-bottom: 20px">Замовлення: {{ $order->id }}</h3>

            <div>
                <b>Ім'я: {{ $order->name }}</b><br>
                <b>Телефон: {{ $order->phone }}</b><br>
                <b>Дата оформлення: {{ $order->updated_at }}</b><br><br>
            </div>

            <table class="table">
                <thead class="thead-dark" style="background: #EB1D36; color: #fff">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Товар</th>
                    <th scope="col">Кількість</th>
                    <th scope="col">Ціна</th>
                </tr>
                </thead>
                <tbody>
                @foreach($order->skus()->get() as $sku)
                    <tr>
                        <th scope="row">{{ $sku->id }}</th>
                        <td><a href="{{ route('sku', [$sku->product->code,$sku]) }}">{{ $sku->name }}</a></td>
                        <td>{{ $sku->pivot->count }}</td>
                        <td>{{ $sku->price * $sku->pivot->count }} {{ \App\Classes\CurrencyConversion::getCurrencySymbol() }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @if($order->coupon())
                <div>
                    <div style="display: inline-block; background: #EB1D36; color: #fff; padding: 0 10px">
                        Використано промо-код: {{ $order->coupon->code }}
                    </div>
                </div>
            @endif
            <div style="display: flex; justify-content: space-between; font-size: 18px; font-weight: 700">
                <div>Загальна вартість корзини</div>
                <div style="background: #EB1D36; color: #fff; padding: 0 10px">
                    {{ $order->calculateFullSum() }} {{ \App\Classes\CurrencyConversion::getCurrencySymbol() }}
                </div>
            </div>

            @if($order->coupon)
                <div style="display: flex; justify-content: space-between; font-size: 18px; font-weight: 700">
                    <div>Загальна вартість корзини з промокодом</div>
                    <div style="background: #1b48d0; color: #fff; padding: 0 10px">
                        {{ $order->coupon->applyCost($order->calculateFullSum()) }} {{ \App\Classes\CurrencyConversion::getCurrencySymbol() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
