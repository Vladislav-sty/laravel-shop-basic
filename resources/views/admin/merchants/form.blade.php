@extends('layouts.master')

@isset($merchant)
    @section('page-title', 'Редагувати постачальника')
@else
    @section('page-title', 'Створити постачальника')
@endisset

@section('content')
    @include('layouts.admin-nav')
    <div class="container">
        <div style="padding-top: 40px">
            <div class="container">
                <h3 class="display-6 fw-bold" style="padding-bottom: 20px">
                    @isset($merchant)
                        Редагувати {{ $merchant->name }}
                    @else
                        Створити постачальника
                    @endisset
                </h3>

                <form class="form-signin" enctype="multipart/form-data" @isset($merchant)action="{{ route('merchants.update', $merchant->id) }}"@else action="{{ route('merchants.store') }}"@endisset method="post">
                    @csrf
                    @isset($merchant)
                        @method('put')
                    @endisset

                    @error('name')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror
                    <div class="form-label-group">
                        <input name="name" type="text" class="form-control" placeholder="Назва" autofocus="" value="{{ old('name', isset($merchant) ? $merchant->name : null )}}">
                    </div>

                    @error('email')
                        <div class="alert alert-danger" style="margin-top: 15px">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="form-label-group" style="margin-top: 10px">
                        <input name="email" type="text" class="form-control" placeholder="Пошта постачальника" value="{{ old('email', isset($merchant) ? $merchant->email : null) }}">
                    </div>

                    <button style="margin-top: 20px" class="btn btn-lg btn-primary btn-block" type="submit">
                        @isset($merchant)
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
