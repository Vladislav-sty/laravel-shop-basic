@extends('layouts.master')

@section('page-title', 'Купон: ' . $coupon->code)

@section('content')
    @include('layouts.admin-nav')
    <div class="container">
        <div style="padding-top: 40px">
            <div class="container">
                <h3 class="display-6 fw-bold" style="padding-bottom: 20px">Купон: {{ $coupon->name }}</h3>

                <table class="table">
                    <thead class="thead-dark" style="background: #EB1D36; color: #fff">
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Код</th>
                        <th scope="col">Номінал</th>
                        <th scope="col">Знижка</th>
                        <th scope="col">Валюта</th>
                        <th scope="col">Абсолютне значення</th>
                        <th scope="col">Використати лише раз</th>
                        <th scope="col">Діє до</th>
                        <th scope="col">Опис</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">{{ $coupon->id }}</th>
                        <td>{{ $coupon->code }}</td>
                        <td>{{ $coupon->value }}</td>
                        <td>{{ $coupon->value }} @if($coupon->isType()){{ $coupon->currency->symbol }}@else%@endif</td>
                        <td>@if($coupon->currency) {{ $coupon->currency->code }} @else Відсутня @endif</td>
                        <td>@if($coupon->isType()) + @else - @endif</td>
                        <td>@if($coupon->isOnlyOnce()) + @else - @endif</td>
                        <td>@if($coupon->expired_at) {{ date('d.m.Y', strtotime($coupon->expired_at)) }} @else Безстроковий @endif</td>
                        <td>{{ $coupon->description }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
