@extends('layouts.master')

@section('page-title', 'Категорія: ' . $category->name)

@section('content')

    <div class="album py-5 bg-light">
        <div class="container">

            <h1 style="margin-bottom: 40px" class="display-7 fw-bold lh-1">@lang('categories.category'): {{ $category->name }}</h1>
            @if(count($category->products->map->skus->flatten()) == 0)
                <h1 style="margin-bottom: 40px" class="display-8 fw-bold lh-1">У категорії {{ $category->name }} немає товарів</h1>
            @endif
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach($category->products->map->skus->flatten() as $sku)
                    <div class="col">
                        <div class="card shadow-sm">
                            <img style="object-fit: cover;" width="100%" height="225" src="{{ Storage::url($sku->img) }}" alt="">
                            <div class="card-body">
                                @if($sku->product->isAvailable())
                                    <div style="color: #fff; background: #dc3545; text-align: center; margin-bottom: 10px; border-radius: 5px">
                                        @lang('product.out_of_stock')
                                    </div>
                                @endif
                                <h5>{{ $sku->product->name }} ({{ $sku->propertyOptions->map->name->implode(", ") }})</h5>
                                <p class="card-text" style="height: 100px; overflow: hidden;">
                                    {{ Str::words($sku->product->description, 14, ' ...') }}
                                </p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <form action="{{ route('basket-add', $sku->product) }}" method="post">
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
            </div>
        </div>
    </div>

@endsection
