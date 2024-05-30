<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\BriefController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\Payment\StripeController;

Auth::routes();

Route::get('/schedule/run', function(){
     Artisan::call('schedule:run');
});
  
//Invoice routes
Route::controller(InvoiceController::class)->group(function () {
       Route::any('/invoice/send', 'send')->name('invoice.send');
});

   //Stripe routes
Route::controller(StripeController::class)->group(function () {
       Route::get('/payment/stripe', 'index')->name('payment.stripe')->middleware(['verifyPaymentToken']);
       Route::post('/payment/stripe/paymentIntent', 'paymentIntent')->name('payment.stripe.paymentIntent');
       Route::post('/payment/stripe/paymentIntent_3d', 'paymentIntent_3d')->name('payment.stripe.paymentIntent_3d');
       Route::post('/payment/stripe/three_step', 'three_step')->name('payment.stripe.three_step');
       Route::get('/payment/stripe/success', 'success')->name('payment.stripe.success');
       Route::any('/payment/stripe/createPaymentMethod', 'createPaymentMethod')->name('payment.stripe.createPaymentMethod');
       Route::post('/payment/stripe/process', 'process')->name('payment.stripe.process');
       
       Route::any('/payment/sendInvoice', 'sendInvoice')->name('payment.sendInvoice');
});

Route::controller(PaymentController::class)->group(function() {
       Route::get('/payment/success', 'success')->name('payment.success');
       Route::get('/payment/failed', 'failed')->name('payment.failed');
       Route::get('/payment/expired', 'expired')->name('payment.expired');
       Route::get('/payment/fetch', 'tokenData')->name('payment.fetch.token')->middleware(['verifyPaymentToken']);
       Route::get('/payment/generatelink/{id}', 'generatelink')->name('payment.generatelink');
       Route::any('/payment/storePaymentApi', 'storePaymentApi')->name('payment.store.checkout');
       Route::any('/payment/redeemCoupon', 'redeemCoupon')->name('payment.redeem.coupon');
});



Route::controller(PaymentController::class)->group(function() {
       Route::get('/payment/fetch', 'tokenData')->name('payment.fetch.token')->middleware(['verifyPaymentToken']);
       Route::get('/payment/generatelink/{id}', 'generatelink')->name('payment.generatelink');

});
//FRONTEND

Route::name('front.')->controller(FrontendController::class)->group(function() {
       
       Route::post('/contact-us-footer', [FrontendController::class, 'contact_us_footer_store'])->name('contact-us.footer.form');
       Route::post('/contact-us', [FrontendController::class, 'contact_us_store'])->name('contact-us.form');
       Route::get('/brief/thankyou/store', [FrontendController::class, 'brief_thankyou'])->name('brief.thankyou.store');
       Route::any( '{slug}', 'slug' )->where('slug', '(.*)')->name('slug');
       
       // Route::get('/', [FrontendController::class, 'index'])->name('home');
       // Route::get('/about-us', [FrontendController::class, 'about_us'])->name('about.us');
       // Route::get('/services', [FrontendController::class, 'services'])->name('services');
       // Route::get('/pricing', [FrontendController::class, 'pricing'])->name('pricing');
       // Route::get('/portfolio', [FrontendController::class, 'portfolio'])->name('portfolio');
       // Route::get('/contact-us', [FrontendController::class, 'contact_us'])->name('contact.us');
});
Route::name('front.')->controller(BriefController::class)->group(function () {

       Route::get('/slogan', 'slogan')->name('slogan');
       Route::get('/slogan/industry', 'industry')->name('industry');
       Route::get('/slogan/logo/style', 'logo_style')->name('logostyle');
       Route::get('/slogan/color/picker', 'color_picker')->name('colorpicker');
       Route::get('/slogan/logo/type', 'logo_type')->name('logotype');
       Route::get('/slogan/personal/info', 'personal_info')->name('personalinfo');
       Route::get('/slogan/thankyou', 'thankyou')->name('thankyou');
});

