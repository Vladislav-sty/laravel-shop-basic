@extends('layouts.master')

@section('page-title', 'Властивість: ' . $property->name)

@section('content')
    @include('layouts.admin-nav')
    <div class="container">
        <div style="padding-top: 40px">
            <div class="container">
                <h3 class="display-6 fw-bold" style="padding-bottom: 20px">Властивість: {{ $property->name }}</h3>

                <table class="table">
                    <thead class="thead-dark" style="background: #EB1D36; color: #fff">
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Назва</th>
                        <th scope="col">Назва EN</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">{{ $property->id }}</th>
                            <td>{{ $property->name }}</td>
                            <td>{{ $property->name_en }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
