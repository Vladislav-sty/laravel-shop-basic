@extends('layouts.master')

@section('page-title', 'Ваша корзина')

@section('content')

    <div class="container">

        <h1 style="margin-bottom: 40px; margin-top: 40px" class="display-7 fw-bold lh-1">@lang('basket.basket_title')</h1>
        @if(count($order->skus) > 0)
            <table class="table">
                <thead class="thead-dark" style="background: #EB1D36; color: #fff">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">@lang('basket.table.name')</th>
                    <th scope="col">@lang('basket.table.price')</th>
                    <th scope="col">@lang('basket.table.count')</th>
                    <th scope="col">@lang('basket.table.summary_count')</th>
                    <th scope="col">@lang('basket.table.management')</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1 ?>
                @foreach($order->skus as $sku)
                    <tr>
                        <th scope="row"><?php echo $i ?></th>
                        <td><a href="{{ route('sku', [$sku->product->code, $sku]) }}">{{ $sku->product->name }}</a></td>
                        <td><b>{{ $sku->price }} {{ \App\Classes\CurrencyConversion::getCurrencySymbol() }}</b></td>
                        <td class="d-flex">{{ $sku->countInOrder }}
                            <form action="{{ route('basket-add', $sku->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-success">+</button>
                            </form>
                        </td>
                        <td>
                            <b>{{ $sku->price * $sku->countInOrder }} {{ \App\Classes\CurrencyConversion::getCurrencySymbol() }}</b>
                        </td>
                        <td>
                            <form action="{{ route('basket-remove', $sku->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-danger">@lang('basket.table.delete')</button>
                            </form>
                        </td>
                    </tr>
                    <?php $i++ ?>
                @endforeach
                </tbody>
            </table>
            <div style="display: flex; justify-content: space-between; font-size: 18px; font-weight: 700">
                <div>@lang('basket.total_count')</div>
                <div style="display:flex;">
                    @if($order->coupon)
                        <div>
                            <strike>{{ $order->getFullPrice(false) }} {{ \App\Classes\CurrencyConversion::getCurrencySymbol() }}</strike>
                        </div>
                    @endif
                    <div style="background: #EB1D36; color: #fff; padding: 0 10px">
                        {{ $order->getFullPrice() }} {{ \App\Classes\CurrencyConversion::getCurrencySymbol() }}
                    </div>
                </div>
            </div>

            @if($order->coupon)
                <div>
                    <div style="display: inline-block; background: #EB1D36; color: #fff; padding: 0 10px">
                        Використано промо-код: {{ $order->coupon->code }}
                    </div>
                </div>
            @else
                @error('coupon_id')
                <div class="alert alert-danger" style="margin-top: 15px">
                    {{ $message }}
                </div>
                @enderror
                <div style="display: flex; justify-content: space-between; font-size: 18px; font-weight: 700">
                    <form action="{{ route('set-coupon') }}" method="post" style="display: flex">
                        @csrf
                        <input name="coupon_id" type="text" class="form-control" placeholder="Вказати промо-код">
                        <button style="margin-left: 10px" class="btn btn-success" type="submit">Активувати промо-код</button>
                    </form>
                </div>
            @endif

            <a href="{{ route('basket-place') }}" class="btn btn-primary" style="margin-top: 20px; margin-bottom: 40px">@lang('basket.basket_confirm')</a>
        @else
            <h3 style="margin-bottom: 40px; margin-top: 40px" class="display-7 fw-bold lh-1">@lang('basket.is_empty')</h3>
        @endif
    </div>
@endsection
