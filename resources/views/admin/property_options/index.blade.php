@extends('layouts.master')

@section('page-title', 'Опції властивостей магазину')

@section('content')
    @include('layouts.admin-nav')
    <div class="container">
        <div style="padding-top: 40px">
            <div class="container">
                <h3 class="display-6 fw-bold" style="padding-bottom: 20px">Опції властивостей сайту</h3>

                <table class="table">
                    <thead class="thead-dark" style="background: #EB1D36; color: #fff">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Назва</th>
                        <th scope="col">Назва EN</th>
                        <th scope="col">Належить до властивості</th>
                        <th scope="col">Дії</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1; ?>
                    @foreach($propertyOptions as $propertyOption)
                        <tr>
                            <th scope="row">{{ $i }}</th>
                            <td>{{ $propertyOption->name }}</td>
                            <td>{{ $propertyOption->name_en }}</td>
                            <td><b><a href="{{ route('properties.show', $propertyOption->property->id) }}">{{ $propertyOption->property->name }}</a></b></td>
                            <td>
                                <a href="{{ route('property_options.show', $propertyOption->id) }}" class="btn btn-primary">Відкрити</a>
                                <a href="{{ route('property_options.edit', $propertyOption->id) }}" class="btn btn-info">Редагувати</a>
                                <form action="{{ route('property_options.destroy', $propertyOption->id) }}" method="post" style="display: inline-block">
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
                <a href="{{ route('property_options.create') }}" class="btn btn-success">Створити опцію</a>
            </div>
        </div>
    </div>
@endsection
