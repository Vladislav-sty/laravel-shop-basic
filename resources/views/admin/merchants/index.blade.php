@extends('layouts.master')

@section('page-title', 'Постачальники')

@section('content')
    @include('layouts.admin-nav')
    <div class="container">
        <div style="padding-top: 40px">
            <div class="container">
                <h3 class="display-6 fw-bold" style="padding-bottom: 20px">Постачальники</h3>

                <table class="table">
                    <thead class="thead-dark" style="background: #EB1D36; color: #fff">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Назва</th>
                        <th scope="col">Пошта</th>
                        <th scope="col">Дії</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1; ?>
                    @foreach($merchants as $merchant)
                        <tr>
                            <th scope="row">{{ $i }}</th>
                            <td>{{ $merchant->name }}</td>
                            <td>{{ $merchant->email }}</td>
                            <td>
                                <a href="{{ route('merchants.update_token', $merchant->id) }}" class="btn btn-secondary">Оновити токен</a>
                                <a href="{{ route('merchants.show', $merchant->id) }}" class="btn btn-primary">Відкрити</a>
                                <a href="{{ route('merchants.edit', $merchant->id) }}" class="btn btn-info">Редагувати</a>
                                <form action="{{ route('merchants.destroy', $merchant->id) }}" method="post" style="display: inline-block">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger" type="submit">Видалити</button>
                                </form>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    @endforeach
                    </tbody>
                </table>
                <a href="{{ route('merchants.create') }}" class="btn btn-success">Створити постачальника</a>
            </div>
        </div>
    </div>
@endsection
