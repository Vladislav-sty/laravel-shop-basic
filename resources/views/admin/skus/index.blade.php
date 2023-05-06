@extends('layouts.master')

@section('page-title', 'Skus')

@section('content')
    @include('layouts.admin-nav')
    <div class="container">
        <div style="padding-top: 40px; padding-bottom: 50px">
            <div class="container">
                <h3 class="display-6 fw-bold" style="padding-bottom: 20px">Skus для {{ $product->name }}</h3>

                <table class="table">
                    <thead class="thead-dark" style="background: #EB1D36; color: #fff">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Властивості</th>
                        <th scope="col">Дії</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1 ?>
                    @foreach($skus as $sku)
                        <tr>
                            <th scope="row">{{ $i }}</th>
                            <td>{{ $sku->propertyOptions->map->name->implode(", ") }}</td>
                            <td>
                                <a href="{{ route('skus.show', [$product->id, $sku->id]) }}" class="btn btn-primary">Відкрити</a>
                                <a href="{{ route('skus.edit', [$product, $sku]) }}" class="btn btn-info">Редагувати</a>
                                <form action="{{ route('skus.destroy', [$product, $sku]) }}" method="post" style="display: inline-block">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger" type="submit">Видалити</button>
                                </form>
                            </td>
                        </tr>
                        <?php $i++ ?>
                    @endforeach
                    </tbody>
                </table>
                <a href="{{ route('skus.create', $product) }}" class="btn btn-success">Створити Sku</a>
            </div>
        </div>
    </div>
@endsection
