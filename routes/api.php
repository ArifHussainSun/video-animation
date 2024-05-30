<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductBundlesController;
use App\Models\CountryCurrencies;

Route::group([
    'middleware' => 'api',
], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('customer', [AuthController::class, 'customerApiData']);
    Route::post('payments', [AuthController::class, 'paymentApiData']);
    Route::post('paymentlink', [AuthController::class, 'paymentLinkApiData']);
    Route::post('users', [AuthController::class, 'userApiData']);
    Route::post('contact-queries', [AuthController::class, 'ContactQueriesApiData']);
    Route::post('subscriber', [AuthController::class, 'subscriberApiData']);
    Route::post('categories', [AuthController::class, 'categoriesApiData']);
    Route::post('sub-categories', [AuthController::class, 'SubCategoriesApiData']);
    Route::post('products', [AuthController::class, 'productsApiData']);
    Route::post('email-template', [AuthController::class, 'emailTemplateApiData']);
    Route::post('pages', [AuthController::class, 'pagesApiData']);
    Route::post('testimonials', [AuthController::class, 'testimonialsApiData']);
    Route::post('partners', [AuthController::class, 'partnersApiData']);
    Route::post('faqs', [AuthController::class, 'faqsApiData']);
    Route::post('brand-settings/contact-information', [AuthController::class, 'contactInformationApiData']);
    Route::post('brand-settings/coupon', [AuthController::class, 'couponApiData']);
    Route::get('user-profile', [AuthController::class, 'userProfile']);

});

// Route::get('/products[/{id?}]', [ProductController::class , 'ProductApi']);
Route::get('/products[/{id?}[/category/{category_id?}]]', [ProductController::class , 'ProductApi']);
// Route::get('/products[/{id?}/category/{category_id?}]', [ProductController::class , 'ProductApi']);
Route::get('/products/{id?}', [ProductController::class , 'ProductCategoryApi']);
Route::get('/categories/{id}', [CategoriesController::class, 'CategoryApi']);
Route::get('/products-bundles/{id?}', [ProductBundlesController::class , 'ProductBundlesApi']);

Route::get('/country/list', function() {
    $countries = CountryCurrencies::select('id','country_name','currency_code','currency_symbol')
                ->where('status',1)
                ->orderBy('country_name', 'ASC')
                ->get();
    return response()->json(["status" =>true, "data" => $countries]);
})->name('api.fetch.countries');

