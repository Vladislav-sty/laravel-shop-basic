@extends('layouts.master')

@isset($sku)
    @section('page-title', 'Редагувати Sku')
@else
    @section('page-title', 'Створити Sku')
@endisset

@section('content')
    @include('layouts.admin-nav')
    <div class="container">
        <div style="padding-top: 40px">
            <div class="container">
                <h3 class="display-6 fw-bold" style="padding-bottom: 20px">
                    @isset($sku)
                        Редагування Sku: {{ $sku->name }}
                    @else
                        Додати
                    @endisset
                </h3>
                <form class="form-signin" enctype="multipart/form-data" action="@isset($sku){{ route('skus.update', [$product, $sku]) }}@else{{ route('skus.store', $product) }}@endisset" method="post">
                    @isset($sku)
                        @method('put')
                    @endisset
                    @csrf

                    @error('price')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="form-label-group">
                        <input name="price" type="text" class="form-control" placeholder="Ціна" autofocus="" value="{{ old('price', isset($sku) ? $sku->price : null) }}">
                    </div>

                    @error('count')
                        <div class="alert alert-danger" style="margin-top: 15px">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="form-label-group" style="margin-top: 10px">
                        <input name="count" type="text" class="form-control" placeholder="Кількість" autofocus="" value="{{ old('count', isset($sku) ? $sku->count : null ) }}">
                    </div>

                    @error('sku')
                    <div class="alert alert-danger" style="margin-top: 15px">
                        {{ $message }}
                    </div>
                    @enderror
                    @foreach($product->properties as $property)
                            <div class="form-group" style="margin-top: 10px">
                                <label for="property_id[{{ $property->id }}]">{{ $property->name }}</label>
                                <select class="form-control" id="exampleFormControlSelect1" name="property_id[{{ $property->id }}]">
                                    <option @isset($sku)@else selected disabled @endisset>Обрати</option>
                                    @foreach($property->propertyOptions as $propertyOption)
                                        <option
                                            @isset($sku)
                                                @if($sku->propertyOptions->contains($propertyOption))
                                                selected
                                                @endif
                                            @endisset
                                            value="{{ $propertyOption->id }}">{{ $propertyOption->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                    @endforeach

                    <button style="margin-top: 20px" class="btn btn-lg btn-primary btn-block" type="submit">
                        @isset($sku)
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
