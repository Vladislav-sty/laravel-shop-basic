@extends('layouts.master')

@section('page-title', 'Постачальник: ' . $merchant->name)

@section('content')
    @include('layouts.admin-nav')
    <div class="container">
        <div style="padding-top: 40px">
            <div class="container">
                <h3 class="display-6 fw-bold" style="padding-bottom: 20px">Постачальник: {{ $merchant->name }}</h3>

                <table class="table">
                    <thead class="thead-dark" style="background: #EB1D36; color: #fff">
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Назва</th>
                        <th scope="col">Email</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">{{ $merchant->id }}</th>
                            <td>{{ $merchant->name }}</td>
                            <td>{{ $merchant->email }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
