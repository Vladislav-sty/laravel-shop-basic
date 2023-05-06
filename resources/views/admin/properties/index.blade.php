@extends('layouts.master')

@section('page-title', 'Властивості магазину')

@section('content')
    @include('layouts.admin-nav')
    <div class="container">
        <div style="padding-top: 40px">
            <div class="container">
                <h3 class="display-6 fw-bold" style="padding-bottom: 20px">Властивості сайту</h3>

                <table class="table">
                    <thead class="thead-dark" style="background: #EB1D36; color: #fff">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Назва</th>
                        <th scope="col">Назва EN</th>
                        <th scope="col">Дії</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1; ?>
                    @foreach($properties as $property)
                        <tr>
                            <th scope="row">{{ $i }}</th>
                            <td>{{ $property->name }}</td>
                            <td>{{ $property->name_en }}</td>
                            <td>
                                <a href="{{ route('properties.show', $property->id) }}" class="btn btn-primary">Відкрити</a>
                                <a href="{{ route('properties.edit', $property->id) }}" class="btn btn-info">Редагувати</a>
                                <form action="{{ route('properties.destroy', $property->id) }}" method="post" style="display: inline-block">
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
                <a href="{{ route('properties.create') }}" class="btn btn-success">Створити властивість</a>
            </div>
        </div>
    </div>
@endsection
