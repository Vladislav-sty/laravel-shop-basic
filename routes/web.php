<?php

use App\Http\Controllers\HomeController;
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
    'reset'=>false,
    'confirm'=>false,
    'verify'=>false
]);

Route::get('locale/{locale}', '\App\Http\Controllers\HomeController@changeLocale')->name('locale');

Route::get('currency/{currencyCode}', '\App\Http\Controllers\HomeController@changeCurrency')->name('currency');

Route::get('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('get-logout');

Route::group(['middleware'=>'set_locale'], function(){
    Route::group(['middleware'=>'auth'], function(){
        Route::get('admin', '\App\Http\Controllers\Admin\AdminController@admin')->name('admin');

        Route::get('admin/person/orders', '\App\Http\Controllers\Person\OrdersController@orders')->name('person-orders');
        Route::get('admin/person/orders/{order_id}', '\App\Http\Controllers\Person\OrdersController@order')->name('person-order');

        Route::group(['middlewate'=>'is_admin'], function (){
            Route::get('admin/orders', '\App\Http\Controllers\Admin\AdminController@orders')->name('admin-orders');
            Route::get('admin/orders/{order_id}', '\App\Http\Controllers\Admin\AdminController@order')->name('admin-order');;
            Route::resource('admin/categories', '\App\Http\Controllers\Admin\CategoryController');
            Route::resource('admin/products', '\App\Http\Controllers\Admin\ProductController');
            Route::resource('admin/products/{product}/skus', '\App\Http\Controllers\Admin\SkuController');
            Route::resource('admin/properties', '\App\Http\Controllers\Admin\PropertyController');
            Route::resource('admin/property_options', '\App\Http\Controllers\Admin\PropertyOptionController');
            Route::resource('admin/coupons', '\App\Http\Controllers\Admin\CouponController');
            Route::resource('admin/merchants', '\App\Http\Controllers\Admin\MerchantController');
            Route::get('admin/merchant/{merchant}/update_token', '\App\Http\Controllers\Admin\MerchantController@updateToken')->name('merchants.update_token');

            Route::resource('admin/block', '\App\Http\Controllers\Admin\BlockController', [
                'only' => ['index','create','show','store','destroy']
            ]);
        });
    });

    Route::get('/',[HomeController::class, 'index'])->name('index');

    Route::get('products', '\App\Http\Controllers\ProductsController@allProducts')->name('products');

    Route::get('categories', '\App\Http\Controllers\CategoriesController@categories')->name('categories');
    Route::get('category/{category_name}', '\App\Http\Controllers\CategoriesController@category')->name('category');

    Route::get('product/{product_name}/{skus}', '\App\Http\Controllers\ProductController@sku')->name('sku');

    Route::get('basket','\App\Http\Controllers\BasketController@basket')->name('basket');
    Route::post('basket/add/{sku}', '\App\Http\Controllers\BasketController@add')->name('basket-add');
    Route::post('basket/remove/{sku}', '\App\Http\Controllers\BasketController@remove')->name('basket-remove');
    Route::get('basket/place', '\App\Http\Controllers\BasketController@place')->name('basket-place');
    Route::post('basket/save-order', '\App\Http\Controllers\BasketController@basketConfirm')->name('save-order');

    Route::post('subscription/{sku}', '\App\Http\Controllers\HomeController@subscribe')->name('subscription');

    Route::post('coupon', '\App\Http\Controllers\BasketController@setCoupon')->name('set-coupon');
});
