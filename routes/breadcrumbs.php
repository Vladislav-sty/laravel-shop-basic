<?php

use App\Models\Category;
use App\Models\Product;
use App\Models\Sku;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use Illuminate\Support\Facades\App;

Breadcrumbs::for('index', function (BreadcrumbTrail $trail): void{
    $trail->push(e(__('pages.home_page')), route('index'));
});

Breadcrumbs::for('categories', function (BreadcrumbTrail $trail): void{
    $trail->parent('index');
    $trail->push(e(__('pages.categories')), route('categories'));
});

Breadcrumbs::for('category', function (BreadcrumbTrail $trail, $category): void{
    $category = Category::where('code', $category)->first();
    $trail->parent('categories');
    $trail->push($category->name, route('category', $category));
});

Breadcrumbs::for('singleCategory', function (BreadcrumbTrail $trail, $category): void{
    $category = Category::where('code', $category)->first();
    $trail->parent('index');
    $trail->push($category->name, route('category', $category->code));
});

Breadcrumbs::for('products', function (BreadcrumbTrail $trail): void{
    $trail->parent('index');
    $trail->push(e(__('pages.all_products')), route('products'));
});

Breadcrumbs::for('sku', function (BreadcrumbTrail $trail, $product, Sku $skus): void{
    $product = Product::where('code', $product)->first();
    $productCategory = $product->category;
    $trail->parent('singleCategory', $productCategory->code);
    $trail->push($product->name, route('sku', [$product, $skus]));
});

Breadcrumbs::for('basket', function (BreadcrumbTrail $trail): void{
    $trail->parent('index');
    $trail->push(e(__('pages.basket')), route('basket'));
});
