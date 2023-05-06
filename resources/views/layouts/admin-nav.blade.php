<div style="border-bottom: 2px solid #EB1D36;">
    <div class="container">
        <header class="d-flex justify-content-center py-3">
            <ul class="nav nav-pills">
                @if(Auth::user()->is_admin)
                    <li class="nav-item"><a href="{{ route('admin-orders') }}" class="nav-link link-dark">Замовлення користувачів</a></li>
                    <li class="nav-item"><a href="{{ route('categories.index') }}" class="nav-link link-dark">Категорії</a></li>
                    <li class="nav-item"><a href="{{ route('products.index') }}" class="nav-link link-dark">Товари</a></li>
                    <li class="nav-item"><a href="{{ route('coupons.index') }}" class="nav-link link-dark">Купони</a></li>
                    <li class="nav-item"><a href="{{ route('block.index') }}" class="nav-link link-dark">Користувачі</a></li>
                    <li class="nav-item"><a href="{{ route('merchants.index') }}" class="nav-link link-danger">Постачальники</a></li>
                    <li class="nav-item"><a href="{{ route('properties.index') }}" class="nav-link link-primary">Властивості</a></li>
                    <li class="nav-item"><a href="{{ route('property_options.index') }}" class="nav-link link-primary">Варіанти властивостей</a></li>
                @else
                    <li class="nav-item"><a href="{{ route('person-orders') }}" class="nav-link">Мої замовлення</a></li>
                @endif
            </ul>
        </header>
    </div>
</div>
