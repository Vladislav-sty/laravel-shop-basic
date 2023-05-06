@extends('layouts.master')

@section('page-title', 'Опція: ' . $propertyOption->name)

@section('content')
    @include('layouts.admin-nav')
    <div class="container">
        <div style="padding-top: 40px">
            <div class="container">
                <h3 class="display-6 fw-bold" style="padding-bottom: 20px">Опція: {{ $propertyOption->name }}</h3>

                <table class="table">
                    <thead class="thead-dark" style="background: #EB1D36; color: #fff">
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Назва</th>
                        <th scope="col">Назва EN</th>
                        <th scope="col">Належить до</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">{{ $propertyOption->id }}</th>
                            <td>{{ $propertyOption->name }}</td>
                            <td>{{ $propertyOption->name_en }}</td>
                            <td><b><a href="{{ route('properties.show', $propertyOption->property->id) }}">{{ $propertyOption->property->name }}</a></b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
