@extends('layouts.master')

@section('page-title', 'Sku: ' . $sku->product->name)

@section('content')
    @include('layouts.admin-nav')
    <div class="container">
        <div style="padding-top: 40px">
            <div class="container">
                <h3 class="display-6 fw-bold" style="padding-bottom: 20px">Sku: {{ $sku->product->name }} ({{ $sku->propertyOptions->map->name->implode(", ") }})</h3>

                <table class="table">
                    <thead class="thead-dark" style="background: #EB1D36; color: #fff">
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Кількість</th>
                        <th scope="col">Ціна</th>
                        <th scope="col">Картинка</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">{{ $sku->id }}</th>
                        <td>{{ $sku->count }}</td>
                        <td>{{ $sku->price }} {{ \App\Classes\CurrencyConversion::getCurrencySymbol() }}</td>
                        <td><img src="{{ Storage::url($sku->img) }}" width="200px" height="100px" style="object-fit: cover" alt=""></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
