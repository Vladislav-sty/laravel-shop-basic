@extends('layouts.master')

@section('page-title', 'Категории')

@section('content')

    <div class="album py-5 bg-light">
        <div class="container">

            <h1 style="margin-bottom: 40px" class="display-7 fw-bold lh-1">@lang('categories.categories_page_title')</h1>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach($categories as $category)
                    <div class="col">
                        <div class="card shadow-sm">
                            <img style="object-fit: cover" width="100%" height="225" src="{{ Storage::url($category->img) }}" alt="">

                            <div class="card-body">
                                <h5>{{ $category->name }}</h5>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="{{ route('category', $category->code) }}" class="btn btn-outline-danger">@lang('categories.categories_card_detail_btn')</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
