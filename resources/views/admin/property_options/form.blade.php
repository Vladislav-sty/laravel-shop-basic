@extends('layouts.master')

@isset($propertyOption)
    @section('page-title', 'Редагувати опцію властивості')
@else
    @section('page-title', 'Створити опцію властивості')
@endisset

@section('content')
    @include('layouts.admin-nav')
    <div class="container">
        <div style="padding-top: 40px">
            <div class="container">
                <h3 class="display-6 fw-bold" style="padding-bottom: 20px">
                    @isset($propertyOption)
                        Редагувати опцію {{ $propertyOption->name }}
                    @else
                        Створити опцію властивості
                    @endisset
                </h3>

                <form class="form-signin" enctype="multipart/form-data" @isset($propertyOption)action="{{ route('property_options.update', $propertyOption->id) }}"@else action="{{ route('property_options.store') }}"@endisset method="post">
                    @csrf
                    @isset($propertyOption)
                        @method('put')
                    @endisset

                    @error('name')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror
                    <div class="form-label-group">
                        <input name="name" type="text" class="form-control" placeholder="Назва" autofocus="" value="{{ old('name', isset($propertyOption) ? $propertyOption->name : null )}}">
                    </div>

                    @error('name_en')
                        <div class="alert alert-danger" style="margin-top: 15px">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="form-label-group" style="margin-top: 10px">
                        <input name="name_en" type="text" class="form-control" placeholder="Назва EN" value="{{ old('name_en', isset($propertyOption) ? $propertyOption->name_en : null) }}">
                    </div>

                    @error('property_id')
                    <div class="alert alert-danger" style="margin-top: 15px">
                        {{ $message }}
                    </div>
                    @enderror
                    <div class="form-group" style="margin-top: 10px">
                        <select class="form-control" id="exampleFormControlSelect1" name="property_id">
                            <option @isset($property)@else selected disabled @endisset>Властивість для якої належить опція</option>
                            @foreach($properties as $property)
                                <option
                                    @isset($propertyOption)
                                    @if($property->id == $propertyOption->property_id)
                                    selected
                                    @endif
                                    @endisset
                                    value="{{ $property->id }}">{{ $property->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    @isset($propertyOption)
                        @if($propertyOption->property->name == 'Колір пристрою')
                            <div class="form-group" style="margin-top: 10px">
                                <label for="hex">Оберіть колір</label>
                                <input type="color" id="hex" name="hex" value="{{ $propertyOption->hex }}">
                            </div>
                        @endif
                    @endif

                    <button style="margin-top: 20px" class="btn btn-lg btn-primary btn-block" type="submit">
                        @isset($propertyOption)
                            Оновити
                        @else
                            Створити
                        @endisset
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
