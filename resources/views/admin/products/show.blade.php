@extends('layouts.master')

@section('page-title', 'Товар: ' . $product->name)

@section('content')
    @include('layouts.admin-nav')
    <div class="container">
        <div style="padding-top: 40px">
            <div class="container">
                <h3 class="display-6 fw-bold" style="padding-bottom: 20px">Товар: {{ $product->name }}</h3>

                <table class="table">
                    <thead class="thead-dark" style="background: #EB1D36; color: #fff">
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Назва</th>
                        <th scope="col">Назва EN</th>
                        <th scope="col">Код</th>
                        <th scope="col">Опис</th>
                        <th scope="col">Опис EN</th>
                        <th scope="col">Категорія</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">{{ $product->id }}</th>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->name_en }}</td>
                        <td>{{ $product->code }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->description_en }}</td>
                        <td>{{ $product->category->name }}</td>
                    </tr>
                    </tbody>
                </table>
                <div class="d-flex">
                    @if($product->isNew())
                        <button class="btn btn-success" style="margin-right: 5px">Новинка</button>
                    @endif
                    @if($product->isLow())
                        <button class="btn btn-warning" style="margin-right: 5px">Закінчується</button>
                    @endif
                    @if($product->isRecommend())
                        <button class="btn btn-primary" style="margin-right: 5px">Рекомендуємо</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
