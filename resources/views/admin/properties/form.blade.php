@extends('layouts.master')

@isset($property)
    @section('page-title', 'Редагувати властивість')
@else
    @section('page-title', 'Створити властивість')
@endisset

@section('content')
    @include('layouts.admin-nav')
    <div class="container">
        <div style="padding-top: 40px">
            <div class="container">
                <h3 class="display-6 fw-bold" style="padding-bottom: 20px">
                    @isset($property)
                        Редагувати {{ $property->name }}
                    @else
                        Створити властивість
                    @endisset
                </h3>

                <form class="form-signin" enctype="multipart/form-data" @isset($property)action="{{ route('properties.update', $property->id) }}"@else action="{{ route('properties.store') }}"@endisset method="post">
                    @csrf
                    @isset($property)
                        @method('put')
                    @endisset

                    @error('name')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror
                    <div class="form-label-group">
                        <input name="name" type="text" class="form-control" placeholder="Назва" autofocus="" value="{{ old('name', isset($property) ? $property->name : null )}}">
                    </div>

                    @error('name_en')
                        <div class="alert alert-danger" style="margin-top: 15px">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="form-label-group" style="margin-top: 10px">
                        <input name="name_en" type="text" class="form-control" placeholder="Назва EN" value="{{ old('name_en', isset($property) ? $property->name_en : null) }}">
                    </div>

                    <button style="margin-top: 20px" class="btn btn-lg btn-primary btn-block" type="submit">
                        @isset($property)
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
