@extends('layouts.master')

@section('page-title', 'Категорії магазину')

@section('content')
    @include('layouts.admin-nav')
    <div class="container">
        <div style="padding-top: 40px">
            <div class="container">
                <h3 class="display-6 fw-bold" style="padding-bottom: 20px">Категорії інтернет магазину</h3>

                <table class="table">
                    <thead class="thead-dark" style="background: #EB1D36; color: #fff">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Код</th>
                        <th scope="col">Назва</th>
                        <th scope="col">Дії</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1; ?>
                    @foreach($categories_all as $category)
                        <tr>
                            <th scope="row">{{ $i }}</th>
                            <td>{{ $category->code }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <a href="{{ route('categories.show', $category->id) }}" class="btn btn-primary">Відкрити</a>
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-info">Редагувати</a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="post" style="display: inline-block">
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
                <a href="{{ route('categories.create') }}" class="btn btn-success">Створити категорію</a>
            </div>
        </div>
    </div>
@endsection
