@extends('layouts.master')

@isset($coupon)
    @section('page-title', 'Редагувати купон')
@else
    @section('page-title', 'Створити купон')
@endisset

@section('content')
    @include('layouts.admin-nav')
    <div class="container">
        <div style="padding-top: 40px">
            <div class="container">
                <h3 class="display-6 fw-bold" style="padding-bottom: 20px">
                    @isset($coupon)
                        Редагування купону: {{ $coupon->name }}
                    @else
                        Додати
                    @endisset
                </h3>

                <form class="form-signin" enctype="multipart/form-data" action="@isset($coupon){{ route('coupons.update', $coupon->id) }}@else{{ route('coupons.store') }}@endisset" method="post">
                    @isset($coupon)
                        @method('put')
                    @endisset
                    @csrf

                    @error('code')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="form-label-group">
                        <input name="code" type="text" class="form-control" placeholder="Код" autofocus="" value="{{ old('code', isset($coupon) ? $coupon->code : null ) }}">
                    </div>

                    @error('value')
                        <div class="alert alert-danger" style="margin-top: 15px">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="form-label-group" style="margin-top: 10px">
                        <input name="value" type="text" class="form-control" placeholder="Номінал" autofocus="" value="{{ old('value', isset($coupon) ? $coupon->value : null ) }}">
                    </div>

                    @error('currency_id')
                        <div class="alert alert-danger" style="margin-top: 15px">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="form-label-group" style="margin-top: 10px">
                        <select name="currency_id" id="" class="form-control">
                            <option disabled>Валюта не обрана</option>
                            @foreach($currencies as $currency)
                                <option value="{{ $currency->id }}">{{ $currency->code }}</option>
                            @endforeach
                        </select>
                    </div>

                    @foreach([
                        'type' => 'Абсолютне значення',
                        'only_once' => 'Купон можна використати лише один раз',
                    ] as $field => $title)
                        <div class="form-label-group" style="margin-top: 10px">
                            <label for="{{ $field }}">{{ $title }}</label>
                            <input name="{{ $field }}" id="{{ $field }}" type="checkbox"
                                   @isset($coupon)
                                   @if($coupon->$field == 1)
                                   checked
                                @endif
                                @endisset
                            >
                        </div>
                    @endforeach

                    @error('expired_at')
                        <div class="alert alert-danger" style="margin-top: 15px">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="form-label-group" style="margin-top: 10px">
                        <input name="expired_at" id="expired_at" class="form-control" type="date" placeholder="123" @isset($coupon) value="{{ date('Y-m-d', strtotime($coupon->expired_at)) }}" @endisset>
                    </div>

                    @error('description')
                        <div class="alert alert-danger" style="margin-top: 15px">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="form-label-group" style="margin-top: 10px">
                        <input name="description" type="text" class="form-control" placeholder="Опис" value="{{ old('description', isset($coupon) ? $coupon->description : null ) }}">
                    </div>

                    <button style="margin-top: 20px" class="btn btn-lg btn-primary btn-block" type="submit">
                        @isset($coupon)
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
