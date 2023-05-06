@extends('layouts.master')

@isset($category)
    @section('page-title', 'Редагувати категорію')
@else
    @section('page-title', 'Створити катерію')
@endisset

@section('content')
    @include('layouts.admin-nav')
    <div class="container">
        <div style="padding-top: 40px">
            <div class="container">
                <h3 class="display-6 fw-bold" style="padding-bottom: 20px">
                    @isset($category)
                        Редагувати
                    @else
                        Додати категорію
                    @endisset
                </h3>

                <form class="form-signin" enctype="multipart/form-data" @isset($category)action="{{ route('categories.update', $category->id) }}"@else action="{{ route('categories.store') }}"@endisset method="post">
                    @csrf
                    @isset($category)
                        @method('put')
                    @endisset

                    @error('name')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror
                    <div class="form-label-group">
                        <input name="name" type="text" class="form-control" placeholder="Назва" autofocus="" value="{{ old('name', isset($category) ? $category->name : null )}}">
                    </div>

                    @error('code')
                        <div class="alert alert-danger" style="margin-top: 15px">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="form-label-group" style="margin-top: 10px">
                        <input name="code" type="text" class="form-control" placeholder="Код" value="{{ old('code', isset($category) ? $category->code : null) }}">
                    </div>

                    <div class="form-label-group" style="margin-top: 10px">
                        <input name="img" type="file" class="form-control" placeholder="Картинка" @isset($category)value="{{ $category->img }}"@endisset>
                    </div>

                    <button style="margin-top: 20px" class="btn btn-lg btn-primary btn-block" type="submit">
                        @isset($category)
                            Оновити
                        @else
                            Додати
                        @endisset
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
