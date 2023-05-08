@extends('layouts.master')

@section('page-title', 'Laravel Shop')

@section('content')
    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @error('price_from')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
                @error('price_to')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
                <form action="{{ route('index') }}" method="get" style="width: 100%">
                    <div>
                        <input name="price_from" type="text" value="{{ request('price_from') }}" placeholder="@lang('filter.price_from')">
                        <input name="price_to" type="text" value="{{ request('price_to') }}" placeholder="@lang('filter.price_to')">
                    </div>
                    <div>
                        <label for="new">New</label>
                        <input name="new" type="checkbox" id="new" style="margin-right: 10px" @if(request('new')) checked @endif>
                        <label for="low">Low</label>
                        <input name="low" type="checkbox" id="low" style="margin-right: 10px" @if(request('low')) checked @endif>
                        <label for="recommend">Recommend</label>
                        <input name="recommend" type="checkbox" id="recommend" @if(request('recommend')) checked @endif>
                    </div>
                    <div class="d-flex">
                        <button type="submit" class="btn btn-primary" style="margin-right: 10px">@lang('filter.filter_btn')</button>
                        <a href="{{ route('index') }}" class="btn btn-danger">@lang('filter.refresh_filter_btn')</a>
                    </div>
                </form>
                @if(count($skus->all()) < 1)
                    <h2 style="width: 100%; margin-top: 50px; padding: 20px; background: #EB1D36; color: #fff">@lang('product.dot_have_products')</h2>
                @else
                    @foreach($skus as $sku)
                        <div class="col">
                            <div class="card shadow-sm">
                                <img style="object-fit: cover;" width="100%" height="225" src="{{ Storage::url($sku->img) }}" alt="">
                                <div class="card-body">
                                    @if($sku->isAvailable())
                                        <div style="color: #fff; background: #dc3545; text-align: center; margin-bottom: 10px; border-radius: 5px">
                                            @lang('product.out_of_stock')
                                        </div>
                                    @endif
                                    <h5>{{ $sku->product->__('name') }} ({{ $sku->propertyOptions->map->name->implode(',') }})</h5>
                                    <p class="card-text" style="height: 100px; overflow: hidden;">
                                        {{ Str::words($sku->product->__('description'), 14, ' ...') }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <form action="{{ route('basket-add', $sku) }}" method="post">
                                                @csrf
                                                @if(!$sku->product->isAvailable())
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
                <div style="width: 100%">
                    {{ $skus->links() }}
                </div>
                <h2 style="width: 100%; margin-top: 50px; padding: 20px; background: #ffc107; color: #fff">@lang('product.best_products_recom')</h2>
                @foreach($bestSkus as $bestSku)
                    <div class="col">
                        <div class="card shadow-sm">
                            <img style="object-fit: cover;" width="100%" height="225" src="{{ Storage::url($bestSku->img) }}" alt="">
                            <div class="card-body">
                                @if($bestSku->isAvailable())
                                    <div style="color: #fff; background: #dc3545; text-align: center; margin-bottom: 10px; border-radius: 5px">
                                        @lang('product.out_of_stock')
                                    </div>
                                @endif
                                <h5>{{ $bestSku->product->__('name') }}</h5>
                                <p class="card-text" style="height: 100px; overflow: hidden;">
                                    {{ Str::words($bestSku->product->__('description'), 14, ' ...') }}
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <form action="{{ route('basket-add', $bestSku) }}" method="post">
                                            @csrf
                                            @if(!$bestSku->isAvailable())
                                                <button type="submit" class="btn btn-outline-dark">@lang('product.to_basket')</button>
                                            @endif
                                            <a href="{{ route('sku', [$bestSku->product->code, $bestSku]) }}" class="btn btn-danger">@lang('product.see_product')</a>
                                        </form>
                                    </div>
                                    <a href="{{ route('category', $bestSku->product->category['code']) }}" class="text-muted text-decoration-none">{{ $bestSku->product->category['name'] }}</a>
                                </div>
                                <div class="d-flex" style="margin-top: 5px">
                                    @if($bestSku->product->isNew())
                                        <button class="btn btn-success" style="margin-right: 5px">@lang('product.labels.new')</button>
                                    @endif
                                    @if($bestSku->product->isLow())
                                        <button class="btn btn-warning" style="margin-right: 5px">@lang('product.labels.low')</button>
                                    @endif
                                    @if($bestSku->product->isRecommend())
                                        <button class="btn btn-primary" style="margin-right: 5px">@lang('product.labels.recommend')</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
