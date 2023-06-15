<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BlockController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\MerchantController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\PropertyOptionController;
use App\Http\Controllers\Admin\SkuController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Person\OrdersController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes([
    'confirm'=>false,
    'verify'=>false
]);

Route::get('locale/{locale}', [HomeController::class, 'changeLocale'])->name('locale');

Route::get('currency/{currencyCode}', [HomeController::class, 'changeCurrency'])->name('currency');

Route::get('logout', [LoginController::class, 'logout'])->name('get-logout');

Route::group(['middleware'=>'set_locale'], function(){
    Route::group(['middleware'=>'auth'], function(){
        Route::get('admin', [AdminController::class, 'admin'])->name('admin');

        Route::get('admin/person/orders', [OrdersController::class, 'orders'])->name('person-orders');
        Route::get('admin/person/orders/{order_id}', [OrdersController::class, 'order'])->name('person-order');

        Route::group(['middlewate'=>'is_admin'], function (){
            Route::get('admin/orders', [AdminController::class, 'orders'])->name('admin-orders');
            Route::get('admin/orders/{order_id}', [AdminController::class, 'order'])->name('admin-order');;
            Route::resource('admin/categories', CategoryController::class);
            Route::resource('admin/products', ProductController::class);
            Route::resource('admin/products/{product}/skus', SkuController::class);
            Route::resource('admin/properties', PropertyController::class);
            Route::resource('admin/property_options', PropertyOptionController::class);
            Route::resource('admin/coupons', CouponController::class);
            Route::resource('admin/merchants', MerchantController::class);
            Route::get('admin/merchant/{merchant}/update_token', [MerchantController::class, 'updateToken'])->name('merchants.update_token');

            Route::resource('admin/block', BlockController::class, [
                'only' => ['index','create','show','store','destroy']
            ]);
        });
    });

    Route::get('/',[HomeController::class, 'index'])->name('index');

    Route::get('products', [ProductsController::class, 'allProducts'])->name('products');

    Route::get('categories', [CategoriesController::class, 'categories'])->name('categories');
    Route::get('category/{category_name}', [CategoriesController::class, 'category'])->name('category');

    Route::get('product/{product_name}/{skus}', '\App\Http\Controllers\ProductController@sku')->name('sku');

    Route::get('basket',[BasketController::class, 'basket'])->name('basket');
    Route::post('basket/add/{sku}', [BasketController::class, 'add'])->name('basket-add');
    Route::post('basket/remove/{sku}', [BasketController::class, 'remove'])->name('basket-remove');
    Route::get('basket/place', [BasketController::class, 'place'])->name('basket-place');
    Route::post('basket/save-order', [BasketController::class, 'basketConfirm'])->name('save-order');

    Route::post('subscription/{sku}', [HomeController::class, 'subscribe'])->name('subscription');

    Route::post('coupon', [BasketController::class, 'setCoupon'])->name('set-coupon');
});
