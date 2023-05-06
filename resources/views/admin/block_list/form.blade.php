@extends('layouts.master')

@section('page-title', 'Заблокувати користувача')

@section('content')
    @include('layouts.admin-nav')
    <div style="padding-top: 40px">
        <div class="container">
            <h3 class="display-6 fw-bold" style="padding-bottom: 20px">Вкажіть причину блокування для користувача: <b style="color: #EB1D36; border-bottom: 3px solid #EB1D36">{{ $user->name }}</b></h3>

            <form class="form-signin" method="post" action="{{ route('block.store') }}">
                @csrf
                <input name="user_id" type="hidden" value="{{ $user->id }}">
                @error('cause')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
                @enderror
                <div class="form-label-group">
                    <input name="cause" type="text" class="form-control" placeholder="Причина блокування">
                </div>
                <button style="margin-top: 20px" class="btn btn-lg btn-danger btn-block" type="submit">
                    Заблокувати
                </button>
            </form>

        </div>
    </div>
@endsection
