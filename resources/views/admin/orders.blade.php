@extends('layouts.master')

@section('page-title', 'Всі замовлення')

@section('content')
    @include('layouts.admin-nav')
    <div style="padding-top: 40px">
        <div class="container">
            <h3 class="display-6 fw-bold" style="padding-bottom: 20px">Замовлення</h3>

            <table class="table">
                <thead class="thead-dark" style="background: #EB1D36; color: #fff">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Ім'я</th>
                    <th scope="col">Телефон</th>
                    <th scope="col">Коли відправлено</th>
                    <th scope="col">Сума</th>
                    <th scope="col">Керування</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr>
                        <th scope="row">{{ $order->id }}</th>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->updated_at->format('d.m.Y') }}</td>
                        <td>{{ $order->sum }} {{ \App\Classes\CurrencyConversion::getCurrencySymbol() }}</td>
                        <td><a href="

                                    @if(Auth::user()->is_admin)
                                        {{ route('admin-order', $order->id) }}
                                    @else
                                        {{ route('person-order', $order->id) }}
                                    @endif

                                    " class="btn btn-success">Відкрити
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
