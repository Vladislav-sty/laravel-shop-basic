@extends('layouts.master')

@section('page-title', 'Категории')

@section('content')
    @include('layouts.admin-nav')
    <div class="container">
        <div style="padding-top: 40px; padding-bottom: 50px">
            <div class="container">
                <h3 class="display-6 fw-bold" style="padding-bottom: 20px">Товари інтернет магазину</h3>

                <table class="table">
                    <thead class="thead-dark" style="background: #EB1D36; color: #fff">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Назва</th>
                        <th scope="col">Код</th>
                        <th scope="col">Опис</th>
                        <th scope="col">К-ст товарних пропозицій</th>
                        <th scope="col">Дії</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1; ?>
                    @foreach($products as $product)
                        <tr @if($product->isAvailable()) style="background: #bababa;" @endif>
                            <th scope="row">{{ $i }}</th>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->code }}</td>
                            <td>{{ $product->description }}</td>
                            <td>=</td>
                            <td>
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary">Відкрити</a>
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-info">Редагувати</a>
                                <a href="{{ route('skus.index', $product) }}" class="btn btn-success">Skus</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="post" style="display: inline-block">
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
{{--                <div style="margin-bottom: 20px;">{{ $products->links() }}</div>--}}
                <a href="{{ route('products.create') }}" class="btn btn-success">Створити продукт</a>
            </div>
        </div>
    </div>
@endsection
