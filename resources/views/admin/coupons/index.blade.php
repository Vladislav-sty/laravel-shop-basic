@extends('layouts.master')

@section('page-title', 'Купони')

@section('content')
    @include('layouts.admin-nav')
    <div class="container">
        <div style="padding-top: 40px; padding-bottom: 50px">
            <div class="container">
                <h3 class="display-6 fw-bold" style="padding-bottom: 20px">Купони інтернет магазину</h3>

                <table class="table">
                    <thead class="thead-dark" style="background: #EB1D36; color: #fff">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Код</th>
                        <th scope="col">Опис купону</th>
                        <th scope="col">Дії</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1; ?>
                    @foreach($coupons as $coupon)
                        <tr>
                            <th scope="row">{{ $i }}</th>
                            <td>{{ $coupon->code }}</td>
                            <td>{{ $coupon->description }}</td>
                            <td>
                                <a href="{{ route('coupons.show', $coupon->id) }}" class="btn btn-primary">Відкрити</a>
                                <a href="{{ route('coupons.edit', $coupon->id) }}" class="btn btn-info">Редагувати</a>
                                <form action="{{ route('coupons.destroy', $coupon->id) }}" method="post" style="display: inline-block">
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
                <a href="{{ route('coupons.create') }}" class="btn btn-success">Створити Купон</a>
            </div>
        </div>
    </div>
@endsection
