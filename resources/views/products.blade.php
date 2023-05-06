@extends('layouts.master')

@section('page-title', 'Всі товари')

@section('content')
    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @if(is_null($skus))
                    <h5>На сайті немає товару</h5>
                @else
                    @foreach($skus as $sku)
                        <div class="col">
                            <div class="card shadow-sm">
                                <img style="object-fit: cover;" width="100%" height="225" src="{{ Storage::url($sku->product->img) }}" alt="">
                                <div class="card-body">
                                    @if($sku->isAvailable())
                                        <div style="color: #fff; background: #dc3545; text-align: center; margin-bottom: 10px; border-radius: 5px">
                                            @lang('product.out_of_stock')
                                        </div>
                                    @endif
                                    <h5>{{ $sku->product->__('name') }}</h5>
                                    <p class="card-text" style="height: 100px; overflow: hidden;">
                                        {{ Str::words($sku->product->__('description'), 14, ' ...') }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <form action="{{ route('basket-add', $sku) }}" method="post">
                                                @csrf
                                                @if(!$sku->isAvailable())
                                                    <button type="submit" class="btn btn-outline-dark">@lang('product.to_basket')</button>
                                                @endif
                                                <a href="{{ route('sku', [$sku->product->code, $sku]) }}" class="btn btn-danger">@lang('product.see_product')</a>
                                            </form>
                                        </div>
                                        <a href="{{ route('category', $sku->product->category['code']) }}" class="text-muted text-decoration-none">{{ $sku->product->category['name'] }}</a>
                                    </div>
                                    <div class="d-flex" style="margin-top: 5px">
                                        @if($sku->product->isNew())
                                            <button class="btn btn-success" style="margin-right: 5px">@lang('product.labels.new')</button>
                                        @endif
                                        @if($sku->product->isLow())
                                            <button class="btn btn-warning" style="margin-right: 5px">@lang('product.labels.low')</button>
                                        @endif
                                        @if($sku->product->isRecommend())
                                            <button class="btn btn-primary" style="margin-right: 5px">@lang('product.labels.recommend')</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
