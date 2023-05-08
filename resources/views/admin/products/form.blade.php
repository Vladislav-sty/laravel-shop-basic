@extends('layouts.master')

@isset($product)
    @section('page-title', 'Редагувати товар')
@else
    @section('page-title', 'Створити товар')
@endisset

@section('content')
    @include('layouts.admin-nav')
    <div class="container">
        <div style="padding-top: 40px">
            <div class="container">
                <h3 class="display-6 fw-bold" style="padding-bottom: 20px">
                    @isset($product)
                        Редагування продукту: {{ $product->name }}
                    @else
                        Додати
                    @endisset
                </h3>

                <form class="form-signin" enctype="multipart/form-data" action="@isset($product){{ route('products.update', $product->id) }}@else{{ route('products.store') }}@endisset" method="post">
                    @isset($product)
                        @method('put')
                    @endisset
                    @csrf

                    @error('name')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="form-label-group">
                        <input name="name" type="text" class="form-control" placeholder="Ім'я" autofocus="" value="{{ old('name', isset($product) ? $product->name : null ) }}">
                    </div>

                    @error('name_en')
                        <div class="alert alert-danger" style="margin-top: 15px">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="form-label-group" style="margin-top: 10px">
                        <input name="name_en" type="text" class="form-control" placeholder="Ім'я на Англійській" autofocus="" value="{{ old('name_en', isset($product) ? $product->name_en : null ) }}">
                    </div>

                    @error('code')
                        <div class="alert alert-danger" style="margin-top: 15px">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="form-label-group" style="margin-top: 10px">
                        <input name="code" type="text" class="form-control" placeholder="Код" value="{{ old('code', isset($product) ? $product->code : null ) }}">
                    </div>

                    @error('description')
                        <div class="alert alert-danger" style="margin-top: 15px">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="form-label-group" style="margin-top: 10px">
                        <input name="description" type="text" class="form-control" placeholder="Опис" value="{{ old('description', isset($product) ? $product->description : null ) }}">
                    </div>

                    @error('description_en')
                        <div class="alert alert-danger" style="margin-top: 15px">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="form-label-group" style="margin-top: 10px">
                        <input name="description_en" type="text" class="form-control" placeholder="Опис на Англійській" autofocus="" value="{{ old('description_en', isset($product) ? $product->description_en : null ) }}">
                    </div>

                    <details style="margin: 10px 0 10px 0" open>
                        <summary>Вибір властивостей</summary>
                        @foreach($properties as $property)
                            <div class="form-label-group">
                                <label for="property_{{ $property->id }}">{{ $property->name }}</label>
                                <input @isset($product) @if($product->properties->contains($property)) checked @endif @endisset type="checkbox" id="property_{{ $property->id }}" name="property_{{ $property->id }}" value="{{ $property->id }}">
                            </div>
                        @endforeach
                    </details>

                    @error('category_id')
                        <div class="alert alert-danger" style="margin-top: 15px">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="form-group" style="margin-top: 10px">
                        <select class="form-control" id="exampleFormControlSelect1" name="category_id">
                            <option @isset($product)@else selected disabled @endisset>Вибір категорії</option>
                            @foreach($categories as $category)
                                <option
                                @isset($product)
                                    @if($category->id == $product->category_id)
                                        selected
                                    @endif
                                @endisset
                                value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    @foreach([
                        'new' => 'Новий продукт',
                        'low' => 'Закінчується',
                        'recommend' => 'Рекомендуємо'
                    ] as $field => $title)
                        <div class="form-label-group" style="margin-top: 10px">
                            <label for="{{ $field }}">{{ $title }}</label>
                            <input name="{{ $field }}" id="{{ $field }}" type="checkbox"
                                @isset($product)
                                    @if($product->$field == 1)
                                        checked
                                    @endif
                                @endisset
                            >
                        </div>
                    @endforeach

                    <button style="margin-top: 20px" class="btn btn-lg btn-primary btn-block" type="submit">
                        @isset($product)
                            Змінити
                        @else
                            Додати
                        @endisset
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
