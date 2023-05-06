@extends('layouts.master')

@section('page-title', 'Категорія: ' . $category->name)

@section('content')
    @include('layouts.admin-nav')
    <div class="container">
        <div style="padding-top: 40px">
            <div class="container">
                <h3 class="display-6 fw-bold" style="padding-bottom: 20px">Категорія: {{ $category->name }}</h3>

                <table class="table">
                    <thead class="thead-dark" style="background: #EB1D36; color: #fff">
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Назва</th>
                        <th scope="col">Код</th>
                        <th scope="col">Картинка</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">{{ $category->id }}</th>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->code }}</td>
                            <td>
                                <img src="{{ Storage::url($category->img) }}" width="200px" height="100px" style="object-fit: cover" alt="">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
