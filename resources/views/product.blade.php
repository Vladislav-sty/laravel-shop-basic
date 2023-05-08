@extends('layouts.master')

@section('page-title', 'Продукт: ' . $skus->product->name)

@section('content')
    <div class="container">
        <div>
            <img width="100%" height="350px" style="object-fit: cover;" src="{{ Storage::url($skus->img) }}" alt="">
        </div>
        <div style="margin-top: 20px;">
            <h1 style="margin-bottom: 40px" class="display-7 fw-bold lh-1">{{ $skus->product->name }} ({{ $skus->propertyOptions->map->name->implode(', ') }})</h1>
            <div style="font-size: 20px; margin-bottom: 20px;">
                {{ $skus->product->__('description') }}
            </div>
            @isset($skus->propertyOptions)
                @foreach($skus->propertyOptions as $propertyOption)
                    <div style="font-size: 20px; margin-bottom: 20px;">
                        <b>{{ $propertyOption->property->__('name') }} -> {{ $propertyOption->__('name') }}</b>
                    </div>
                @endforeach

            @endisset
            <div style="font-size: 20px; margin-bottom: 20px;">
                <b>@lang('product.product_page.price_text'): {{ $skus->price }} {{ \App\Classes\CurrencyConversion::getCurrencySymbol() }}</b>
            </div>
            <div>
                @if(!$skus->isAvailable())
                    <form action="{{ route('basket-add', $skus) }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-success">@lang('product.product_page.to_basket')</button>
                    </form>
                @else
                    <button class="btn btn-danger">@lang('product.out_of_stock')</button>
                    <div style="background: #EB1D36; padding: 20px; margin-top: 30px; color: #fff">
                        <h5 class="fw-bold lh-1">@lang('product.product_page.subscribe_form.message')</h5>
                        <form action="{{ route('subscription', $skus) }}" method="post">
                            @csrf
                            @error('email')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                            <input type="text" name="email" class="form-control" style="margin-top: 20px" placeholder="@lang('product.product_page.subscribe_form.input_placeholder')">
                            <button type="submit" class="btn btn-info" style="margin-top: 10px">@lang('product.product_page.subscribe_form.btn')</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
