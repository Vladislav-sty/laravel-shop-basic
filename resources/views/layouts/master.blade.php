<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/bootstrap/bootstrap.min.css">
    <title>@yield('page-title')</title>

    @if(Auth::check())
        @if(!Auth::user()->is_admin)
            <style>
                .phpdebugbar{
                    display: none;
                }
            </style>
        @endif
    @endif

</head>
<body>
@if(session()->has('success'))
    <div style="text-align: center; background: #03cb30; color: #fff; font-weight: 700">
        {{ session()->get('success') }}
    </div>
@endif
@if(session()->has('warning'))
    <div style="text-align: center; background: #870000; color: #fff; font-weight: 700">
        {{ session()->get('warning') }}
    </div>
@endif

<header class="p-3 text-bg-red" style="background: #EB1D36;">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
            <a href="{{ route('index') }}" class="fs-4 text-decoration-none" style="color: #fff"><b>Laravel Shop</b></a>

            <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"></use></svg>
            </a>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a href="{{ route('index') }}" class="nav-link px-2 @routeactive('index')">@lang('pages.home_page')</a></li>
                <li><a href="{{ route('products') }}" class="nav-link px-2 @routeactive('product*')">@lang('pages.all_products')</a></li>
                <li><a href="{{ route('categories') }}" class="nav-link px-2 @routeactive('categor*')">@lang('pages.categories')</a></li>
                <li><a href="{{ route('basket') }}" class="nav-link px-2 @routeactive('basket*')">@lang('pages.basket')@if($basketCount) ({{ $basketCount }}) @endif</a></li>
            </ul>

            <div class="text-end">

                <ul class="list-group d-inline-flex" style="list-style: none; display: flex ">
                    <li>
                        <a href="{{ route('locale','uk') }}" style="color: #fff;">UK</a>
                    </li>
                    <li>
                        <a href="{{ route('locale', 'en') }}" style="color: #fff;">EN</a>
                    </li>
                </ul>
                @Guest
                    <a href="{{ route('login') }}" class="btn btn-light">Sign-in</a>
                    <a href="{{ route('register') }}" class="btn btn-success">Registration</a>
                @endguest
                @Auth
                    <a href="{{ route('admin') }}" class="btn btn-light">{{ Auth::user()->name }}</a>
                    <a href="{{ route('get-logout') }}" class="btn btn-warning">Logout</a>
                @endauth
            </div>
        </div>
    </div>
</header>

<div style="margin-top: 15px">
    <div class="container">
        {{ \Diglactic\Breadcrumbs\Breadcrumbs::render() }}
    </div>
</div>

@yield('content')

<footer class="p-3 text-bg-red" style="background: #EB1D36; margin-top: 50px">
    <ul class="list-group d-flex" style="list-style: none; display: flex ; flex-direction: row">
        @foreach($currencies as $currency)
            <li style="margin-right: 20px">
                <a @if(session('currency', 'UAH') === $currency['code']) class="link-dark" @else class="text-white" @endif href="{{ route('currency', $currency['code']) }}">{{ $currency['code'] }}</a>
            </li>
        @endforeach
    </ul>
    <ul class="list-group d-flex" style="list-style: none; display: flex ; flex-direction: row">
       @foreach($categories as $category)
            <li style="margin-right: 20px">
                <a class="text-white" href="{{ route('category', $category->code) }}">{{ $category->code }}</a>
            </li>
        @endforeach
    </ul>
</footer>
<script src="/bootstrap/bootstrap.min.js"></script>
<script src="/js/jquery.min.js"></script>
<script src="{{ mix('js/app.js') }}" type="module" defer ></script>
</body>
</html>
