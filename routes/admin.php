<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\UserController;
use App\Http\controllers\Auth\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductBundlesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\SubCategoriesController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\BriefAdminController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\ContactqueriesController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\BrandSettingsController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\Payment\StripeController;
use App\Http\Controllers\PaymentLinkController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\EmailTemplateController;
use App\Http\Controllers\MailTemplateController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ServiceController;

Route::get('/admin', function () {
    return redirect()->route('login');
})->name('home');


Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('login');
    });
    //Home
    Route::controller(HomeController::class)->group(function () {
        Route::get('/dashboard', 'dashboard')->middleware('is_admin')->name('admin.dashboard');
        Route::get('/invoice','invoice_form');
        Route::get('notification/send', 'sendOfferNotification');
        Route::post('notification/save/all', 'notification_store');
        Route::get('/notification/mark-all-read','markAllRead')->name('mark-all-read');
    });

    //Login
    Route::controller(LoginController::class)->group(function () {
        Route::get('/logout', 'logout');
    });

    //DashBoard
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard/getPayments', 'monthEarning')->name('dashboard.getpayments');
        Route::get('/paymentlinks', 'filter_chart')->name('getpaymentlinkapi');
        Route::get('/paymentlinks/yearly', 'getpaymentlinkapiyearly')->name('getpaymentlinkapiyearly');
        Route::get('/payments/category/api', 'Payments_category')->name('Payments_category_api');
        Route::post('/Total/payments/api', 'monthly_payments')->name('dateRange_Monthly_payments');
        Route::post('/Total/orders', 'orders')->name('dateRange_Orders');
        Route::post('/average/price', 'average_price')->name('dateRange_Average_price');
        Route::any('/payments/latest/transaction', 'latest_transaction')->name('dateRange_Latest_transactioN');
        Route::post('/revenue', 'revenue')->name('dateRange_Revenue');
        Route::post('/DateRange/DonutCharts', 'dateRange_DonutCharts')->name('dateRange_DonutCharts_Apidata');
        Route::post('/DateRange/CategorySales', 'total_category_sales')->name('total_category_sales_Apidata');
        Route::post('/DateRange/SalesChart', 'dateRange_SalesChart')->name('dateRange_SalesChart_Apidata');
        Route::post('/DateRange/salesTargetChart', 'salesTargetChart')->name('salesTargetChart_Apidata');

    });

    // users
    Route::controller(UserController::class)->group(function () {
        Route::get('user/list', 'index')->name('user.list');
        Route::get('user/add', 'form')->name('user.add');
        Route::get('/user/profile', [UserController::class, 'userProfile_form']);
        Route::post('/user/profile/update', [UserController::class, 'userProfile_update'])->name('admin-user.profile-update');
        Route::get('user/edit/{id}', 'edit')->name('user.edit');
        Route::get('user/detail/{id?}', 'view')->name('user.detail.view');
        Route::post('user/remove', 'delete')->name('user.remove');
        Route::post('user/destroy', 'destroy')->name('user.destroy');
        Route::post('user/restore', 'restore')->name('user.restore');
        Route::post('user/update', 'update')->name('user.update');
        Route::post('/user/status/{id}', 'status')->name('user.status');
        Route::post('user/store', 'store')->name('user.store');
        Route::get('user/trash', 'trashed')->name('user.list.trashed');
        Route::get('/additional-permission/{id}', 'details')->name('admin-user.fetchdata');
        Route::post('/user/additionalpermission/{id}', 'permission_update')->name('admin-user.additionalpermission');
    });

    // Contactqueries
    Route::controller(ContactqueriesController::class)->group(function () {
        Route::get('/contact-queries/list', 'index')->name('contact-queries.list');
        Route::get('/contact-queries/trash', 'trashed')->name('contact-queries.list.trashed');
        Route::get('/contact-queries/add', 'form')->name('contact-queries.add');
        Route::post('/contact-queries/save', 'store')->name('contact-queries.save');
        Route::get('/contact-queries/edit/{id}', 'edit')->name('contact-queries.edit');
        Route::get('/contact-queries/restore/{id}', 'restore')->name('contact-queries.restore');
        Route::post('/contact-queries/detail/{isTrashed?}', 'view')->name('contact-queries.detail.view');
        Route::post('/contact-queries/remove', 'delete')->name('contact-queries.remove');
        Route::post('/contact-queries/view', 'view')->name('contact-queries.view');
        Route::post('/contact-queries/update', 'update')->name('contact-queries.update');
        Route::post('/contact-queries/delete', 'destroy')->name('contact-queries.delete');
        Route::post('/contact-queries/status/{id}', 'status')->name('contact-queries.status');
    });


    // categories
    Route::controller(CategoriesController::class)->group(function () {
        Route::get('/category/list', 'index')->name('categories.list');
        Route::get('/category/trash', 'trashed')->name('categories.list.trashed');
        Route::post('/category/detail/{isTrashed?}', 'view')->name('categories.detail.view');
        Route::get('/category/restore/{id}', 'restore')->name('categories.restore');
        Route::get('/category/add', 'form')->name('categories.add');
        Route::post('/category/save', 'store')->name('categories.save');
        Route::get('/category/edit/{id}', 'edit')->name('categories.edit');
        Route::post('/category/remove', 'delete')->name('categories.remove');
        Route::get('/category/view/', 'view')->name('categories.view');
        Route::post('/category/update', 'update')->name('categories.update');
        Route::post('/category/delete', 'destroy')->name('categories.delete');
        Route::post('/category/status/{id}', 'status')->name('categories.status');
        Route::get('/categories-api', 'CategoryApi');
    });


    // subcategories
    Route::controller(SubCategoriesController::class)->group(function () {

        Route::get('/sub-category/list', 'index')->name('sub-category.list');
        Route::get('/sub-category/trash', 'trashed')->name('sub-category.list.trashed');
        Route::get('/sub-category/add', 'form')->name('sub-category.add');
        Route::get('/sub-category/edit/{id}', 'edit')->name('sub-category.edit');
        Route::post('/sub-category/detail/{isTrashed?}', 'view')->name('sub-category.detail.view');
        Route::post('/sub-category/store', 'store')->name('sub-category.store');
        Route::post('/sub-category/edit', 'update')->name('sub-category.update');
        Route::post('/sub-category/status/{id}', 'status')->name('sub-category.status');
        Route::get('/sub-category/api/{id?}', 'SubCategoryApi')->name('subcategory.api');
        Route::post('/sub-category/remove', 'delete')->name('sub-category.remove');
        Route::get('/sub-category/restore/{id}', 'restore')->name('sub-category.restore');
        Route::post('/sub-category/delete', 'destroy')->name('sub-category.delete');
    });

    // products
    Route::controller(ProductController::class)->group(function () {

        Route::get('/product/list', 'index')->name('product.list');
        Route::get('/product/trash', 'trashed')->name('product.list.trashed');
        Route::get('/product/add', 'form')->name('product.add');
        Route::get('/product/edit/{id}', 'edit')->name('product.edit');
        Route::post('/product/detail/{isTrashed?}', 'view')->name('product.detail.view');
        Route::post('/product/remove', 'delete')->name('product.remove');
        Route::get('/product/restore/{id}', 'restore')->name('product.restore');
        Route::get('/product/api/{id?}', 'ProductApi')->name('product.api');
        Route::post('/product/status/{id}', 'status')->name('product.status');
        Route::post('/product/store', 'store')->name('product.store');
        Route::post('/product/edit', 'update')->name('product.update');
        Route::post('/product/delete', 'destroy')->name('product.delete');
    });

    // Product Bundles
    Route::controller(ProductBundlesController::class)->group(function () {

        Route::get('/product-bundle/list', 'index')->name('product-bundle.list');
        Route::get('/product-bundle/trash', 'trashed')->name('product-bundle.list.trashed');
        Route::get('/product-bundle/add', 'form')->name('product-bundle.add');
        Route::get('/product-bundle/edit/{id}', 'edit')->name('product-bundle.edit');
        Route::post('/product-bundle/detail/{isTrashed?}', 'view')->name('product-bundle.detail.view');
        Route::post('/products-display/{isType?}', 'ProductDisplay')->name('product-display.view');
        Route::post('/product-bundle/remove', 'delete')->name('product-bundle.remove');
        Route::get('/product-bundle/restore/{id}', 'restore')->name('product-bundle.restore');
        Route::post('/product-bundle/status/{id}', 'status')->name('product-bundle.status');
        Route::post('/product-bundle/store', 'store')->name('product-bundle.store');
        Route::get('/product-bundle/api/{id?}', 'ProductBundlesApi')->name('product-bundle.api');
        Route::post('/product-bundle/edit', 'update')->name('product-bundle.update');
        Route::post('/product-bundle/delete', 'destroy')->name('product-bundle.delete');
    });

    // Pages
    Route::controller(PagesController::class)->group(function () {

        Route::get('/page/list', 'index')->name('page.list');
        Route::get('/page/trash', 'trashed')->name('page.list.trashed');
        Route::get('/page/add', 'form')->name('page.add');
        Route::get('/page/edit/{id}', 'edit')->name('page.edit');
        Route::post('/page/detail/{isTrashed?}', 'view')->name('page.detail.view');
        Route::post('/page/store', 'store')->name('page.store');
        Route::post('/page/edit', 'update')->name('page.update');
        Route::post('/page/status/{id}', 'status')->name('page.status');
        Route::get('/page/restore/{id}', 'restore')->name('page.restore');
        Route::post('/page/remove', 'delete')->name('page.remove');
        Route::post('/page/delete', 'destroy')->name('page.delete');
        Route::get('/{page}', 'slug')->name('page.slug');
        Route::get('/page/alert/message', 'alertMessage')->name('page.alert.message');
    });

    // Testimonial
    Route::controller(TestimonialController::class)->group(function () {
        Route::get('testimonial/list', 'index')->name('testimonial.list');
        Route::get('testimonial/add', 'form')->name('testimonial.add');
        Route::get('testimonial/edit/{id}', 'edit')->name('testimonial.edit');
        Route::get('testimonial/detail/{id?}', 'view')->name('testimonial.detail.view');
        Route::post('testimonial/remove', 'delete')->name('testimonial.remove');
        Route::post('testimonial/destroy', 'destroy')->name('testimonial.destroy');
        Route::post('testimonial/restore', 'restore')->name('testimonial.restore');
        Route::post('testimonial/update', 'update')->name('testimonial.update');
        Route::post('/testimonial/status/{id}', 'status')->name('testimonial.status');
        Route::post('testimonial/store', 'store')->name('testimonial.store');
        Route::get('testimonial/trash', 'trashed')->name('testimonial.list.trashed');
    });

    // Faq
    Route::controller(FaqController::class)->group(function () {

        Route::get('/faq/list', 'index')->name('faq.list');
        Route::get('/faq/trash', 'trashed')->name('faq.list.trashed');
        Route::get('/faq/add', 'form')->name('faq.add');
        Route::get('/faq/edit/{id}', 'edit')->name('faq.edit');
        Route::post('/faq/detail/{isTrashed?}', 'view')->name('faq.detail.view');
        Route::post('/faq/remove', 'delete')->name('faq.remove');
        Route::get('/faq/restore//{id}', 'restore')->name('faq.restore');
        Route::post('/faq/status/{id}', 'status')->name('faq.status');
        Route::post('/faq/store', 'store')->name('faq.store');
        Route::post('/faq/edit', 'update')->name('faq.update');
        Route::post('/faq/delete', 'destroy')->name('faq.delete');
    });

    // Partner
    Route::controller(PartnerController::class)->group(function () {
        Route::get('/partner/list', 'index')->name('partner.list');
        Route::get('/partner/trash', 'trashed')->name('partner.list.trashed');
        Route::get('/partner/add', 'form')->name('partner.add');
        Route::get('/partner/edit/{id}', 'edit')->name('partner.edit');
        Route::post('/partner/detail/{isTrashed?}', 'view')->name('partner.detail.view');
        Route::post('/partner/remove', 'delete')->name('partner.remove');
        Route::get('/partner/restore/{id}', 'restore')->name('partner.restore');
        Route::post('/partner/status/{id}', 'status')->name('partner.status');
        Route::post('/partner/store', 'store')->name('partner.store');
        Route::post('/partner/update', 'update')->name('partner.update');
        Route::post('/partner/delete', 'destroy')->name('partner.delete');
    });

    // Gallery
    Route::controller(GalleryController::class)->group(function () {
        Route::get('gallery/list', 'index')->name('gallery.list');
        Route::get('gallery/add', 'form')->name('gallery.add');
        Route::get('gallery/edit/{id}', 'edit')->name('gallery.edit');
        Route::get('gallery/detail/{id?}', 'view')->name('gallery.detail.view');
        Route::post('gallery/remove', 'delete')->name('gallery.remove');
        Route::post('gallery/destroy', 'destroy')->name('gallery.destroy');
        Route::post('gallery/restore', 'restore')->name('gallery.restore');
        Route::post('gallery/update', 'update')->name('gallery.update');
        Route::post('/gallery/status/{id}', 'status')->name('gallery.status');
        Route::post('gallery/store', 'store')->name('gallery.store');
        Route::get('gallery/trash', 'trashed')->name('gallery.list.trashed');
    });

    // Banner
    Route::controller(BannerController::class)->group(function () {

        Route::get('/banner/list', 'index')->name('banner.list');
        Route::get('/banner/trash', 'trashed')->name('banner.list.trashed');
        Route::get('/banner/add', 'form')->name('banner.add');
        Route::get('/banner/edit/{id}', 'edit')->name('banner.edit');
        Route::post('/banner/detail/{isTrashed?}', 'view')->name('banner.detail.view');
        Route::post('/banner/store', 'store')->name('banner.store');
        Route::post('/banner/edit', 'update')->name('banner.update');
        Route::post('/banner/status/{id}', 'status')->name('banner.status');
        Route::post('/banner/remove', 'delete')->name('banner.remove');
        Route::get('/banner/restore/{id}', 'restore')->name('banner.restore');
        Route::post('/banner/delete', 'destroy')->name('banner.delete');
    });


    // roles
    Route::controller(RoleController::class)->group(function () {
        Route::get('/role/list', 'index')->name('role.list');
        Route::get('/role/trash', 'trashed')->name('role.list.trashed');
        Route::get('/role/add', 'form')->name('role.add');
        Route::post('/role/freshdata', 'edit')->name('role.edit');
        Route::post('/role/detail/{isTrashed?}', 'view')->name('role.detail.view');
        Route::post('/role/remove', 'delete')->name('role.remove');
        Route::get('/role/restore/{id}', 'restore')->name('role.restore');
        Route::post('/role/status/{id}', 'status')->name('role.status');
        Route::post('/role/store', 'store')->name('role.store');
        Route::post('/role/edit', 'update')->name('role.update');
        Route::post('/role/delete', 'destroy')->name('role.delete');
    });


    // permission
    Route::controller(PermissionController::class)->group(function () {

        Route::get('/permission/list', 'index')->name('permission.list');
        Route::get('/permission/trash', 'trashed')->name('permission.trashed');
        Route::get('/permission/add', 'form')->name('permission.add');
        Route::get('/permission/edit/{id}', 'edit')->name('permission.edit');
        Route::post('/permission/detail/{isTrashed?}', 'view')->name('permission.detail.view');
        Route::post('/permission/remove', 'delete')->name('permission.remove');
        Route::get('/permission/restore/{id}', 'restore')->name('permission.restore');
        Route::post('/permission/status/{id}', 'status')->name('permission.status');
        Route::post('/permission/store', 'store')->name('permission.store');
        Route::post('/permission/edit', 'update')->name('permission.update');
        Route::post('/permission/delete', 'destroy')->name('permission.delete');
    });




    // Subscriber
    Route::controller(SubscriberController::class)->group(function () {
        Route::get('/subscriber/list', 'index')->name('subscriber.list');
        Route::get('/subscriber/trash', 'trashed')->name('subscriber.list.trashed');
        Route::get('/subscriber/add', 'form')->name('subscriber.add');
        Route::get('/subscriber/edit/{id}', 'edit')->name('subscriber.edit');
        Route::post('/subscriber/detail/{isTrashed?}', 'view')->name('subscriber.detail.view');
        Route::post('/subscriber/remove', 'delete')->name('subscriber.remove');
        Route::get('/subscriber/restore/{id}', 'restore')->name('subscriber.restore');
        Route::post('/subscriber/status/{id}', 'status')->name('subscriber.status');
        Route::post('/subscriber/store', 'store')->name('subscriber.store');
        Route::post('/subscriber/update', 'update')->name('subscriber.update');
        Route::post('/subscriber/delete', 'destroy')->name('subscriber.delete');
    });


    // Notification
    Route::controller(NotificationController::class)->group(function () {
        Route::get('/notification/list', 'index')->name('admin-notification.main');
        Route::get('/notification/add', 'form')->name('admin-notification.add');
        Route::post('/notification/save', 'store')->name('admin-notification.save');
        Route::post('/notification/fresh', 'edit')->name('admin-notification.freshdata');
        Route::post('/notification/view', 'view')->name('admin-notification.view');
        Route::post('/notification/edit', 'update')->name('admin-notification.update');
        Route::post('/notification/delete', 'destroy')->name('admin-notification.delete');
    });

    // Payments
    Route::controller(PaymentsController::class)->group(function () {

        Route::get('/payment/list', 'index')->name('payment.list');
        Route::get('/payment/trash', 'trashed')->name('payment.trashed');
        Route::get('/payment/add', 'form')->name('payment.add');
        Route::get('/payment/edit/{id}', 'edit')->name('payment.edit');
        Route::post('/payment/detail/{isTrashed?}', 'view')->name('payment.detail.view');
        Route::post('/payment/remove', 'delete')->name('payment.remove');
        Route::get('/payment/restore/{id}', 'restore')->name('payment.restore');
        Route::post('/payment/status/{id}', 'status')->name('payment.status');
        Route::post('/payment/store', 'store')->name('payment.store');
        Route::post('/payment/edit', 'update')->name('payment.update');
        Route::post('/payment/delete', 'destroy')->name('payment.delete');
        Route::any('/payment/download/invoice', 'downloadInvoice')->name('payment.download.invoice');
        Route::get('/payment/generate/report', 'generateReport')->name('payment.generate.report');
        Route::get('/payment/generate/report/email', 'generateReportviaEmail')->name('payment.generate.report.email');
    });

    // Customer
    Route::controller(CustomerController::class)->group(function () {
        Route::get('customer/list', 'index')->name('customer.list');
        Route::get('customer/add', 'form')->name('customer.add');
        Route::get('customer/edit/{id}', 'edit')->name('customer.edit');
        Route::get('customer/detail/{id?}', 'view')->name('customer.detail.view');
        Route::post('customer/remove', 'delete')->name('customer.remove');
        Route::post('customer/destroy', 'destroy')->name('customer.destroy');
        Route::post('customer/restore', 'restore')->name('customer.restore');
        Route::post('customer/update', 'update')->name('customer.update');
        Route::post('/customer/status/{id}', 'status')->name('customer.status');
        Route::post('customer/store', 'store')->name('customer.store');
        Route::get('customer/trash', 'trashed')->name('customer.list.trashed');
    });


    // BrandSettings
    Route::controller(BrandSettingsController::class)->group(function () {
        Route::get('/brand-settings/general-setting', 'general_setting')->name('admin-brand-settings-general-setting');
        Route::get('/brand-settings/logos', 'form')->name('admin-brand-settings.logos');
        Route::post('/brand-settings/logos-save', 'store')->name('admin-brand-settings.logos-save');
        Route::post('/brand-settings/theme-save', 'themestore')->name('admin-brand-settings.theme-save');
        Route::get('/brand-settings/contact-information', 'contactinformationform')->name('admin-brand-settings-contact-information-form');
        Route::post('/brand-settings/contact-information-save', 'contactinformationstore')->name('admin-brand-settings.contact-information-save');;
        Route::get('/brand-settings/social-link', 'sociallinkform')->name('admin-brand-settings-social-link-form');
        Route::post('/brand-settings/social-link-save', 'sociallinkstore')->name('admin-brand-settings.social-link-save');
        Route::get('/brand-settings/custom-header-footer', 'customheaderfooterform')->name('admin-brand-settings-custom-header-footer-form');
        Route::post('/brand-settings/custom-header-footer-save', 'customheaderfooterstore')->name('admin-brand-settings.custom-header-footer-save');
        Route::get('/brand-settings/mail-setting', 'mailsettingform')->name('admin-brand-settings-mail-setting-form');
        Route::post('/brand-settings/mailsetting-save', 'mailsettingstore')->name('admin-brand-settings.mailsetting-save');
        Route::post('/brand-settings/mailsetting-update', 'mailSettingUpdate')->name('admin-brand-settings.mailsetting-update');
    });

    // Payment Settings
    Route::controller(BrandSettingsController::class)->group(function () {
        Route::get('/brand-settings/payment-setting/add', 'paymentsettingform')->name('admin-brand-settings.payment-setting-form');
        Route::post('/brand-settings/payment-setting-save', 'paymentsettingstore')->name('admin-brand-settings.payment-setting-save');
        Route::post('/brand-settings/payment-setting-default-save', 'paymentsetting_default')->name('admin-brand-settings.payment-setting-default-save');
        Route::post('/brand-settings/payment-gateway-setting', 'updateGatewaySetting')->name('admin-brand-settings.payment-gateway-setting');
    });


    // Coupon
    Route::controller(CouponController::class)->group(function () {

        Route::get('coupon/list', 'index')->name('coupon.list');
        Route::get('coupon/add', 'form')->name('coupon.add');
        Route::get('coupon/edit/{id}', 'edit')->name('coupon.edit');
        Route::get('coupon/detail/{id?}', 'view')->name('coupon.detail.view');
        Route::post('coupon/remove', 'delete')->name('coupon.remove');
        Route::post('coupon/destroy', 'destroy')->name('coupon.destroy');
        Route::post('coupon/restore', 'restore')->name('coupon.restore');
        Route::post('coupon/update', 'update')->name('coupon.update');
        Route::post('/coupon/status/{id}', 'status')->name('coupon.status');
        Route::post('coupon/store', 'store')->name('coupon.store');
        Route::get('coupon/trash', 'trashed')->name('coupon.list.trashed');
    });


    // PaymentLink
    Route::controller(PaymentLinkController::class)->group(function () {

        Route::get('/payment-link-generator/list', 'index')->name('payment-link-generator.list');
        Route::get('/payment-link-generator/trash', 'trashed')->name('payment-link-generator.list.trashed');
        Route::get('/payment-link-generator/add', 'form')->name('payment-link-generator.add');
        Route::get('/payment-link-generator/edit/{id}', 'edit')->name('payment-link-generator.edit');
        Route::post('/payment-link-generator/detail/{isTrashed?}', 'view')->name('payment-link-generator.detail.view');
        Route::post('/payment-link-generator/remove', 'delete')->name('payment-link-generator.remove');
        Route::get('/payment-link-generator/restore/{id}', 'restore')->name('payment-link-generator.restore');
        Route::post('/payment-link-generator/status/{id}', 'status')->name('payment-link-generator.status');
        Route::post('/payment-link-generator/store', 'store')->name('payment-link-generator.store');
        Route::post('/payment-link-generator/edit', 'update')->name('payment-link-generator.update');
        Route::post('/payment-link-generator/delete', 'destroy')->name('payment-link-generator.delete');
        Route::get('/payment-link-generator/checklinkvalidity', 'checkLinkValidity')->name('payment-link-generator.check-link-valitidy');
        Route::post('/payment-link-generator/extendValidity', 'extendValidity')->name('payment-link-generator.extend-validity');
    });

    // EmailTemplate
    Route::controller(EmailTemplateController::class)->group(function () {
        Route::get('email/list', 'index')->name('emailtemplate.list');
        Route::get('email/add', 'form')->name('emailtemplate.add');
        Route::get('email/edit/{id}', 'edit')->name('emailtemplate.edit');
        Route::get('email/detail/{id?}', 'view')->name('emailtemplate.detail.view');
        Route::post('email/remove', 'delete')->name('emailtemplate.remove');
        Route::post('email/destroy', 'destroy')->name('emailtemplate.destroy');
        Route::post('email/restore', 'restore')->name('emailtemplate.restore');
        Route::post('email/update', 'update')->name('emailtemplate.update');
        Route::post('/email/status/{id}', 'status')->name('emailtemplate.status');
        Route::post('email/store', 'store')->name('emailtemplate.store');
        Route::get('email/trash', 'trashed')->name('emailtemplate.list.trashed');


        Route::get('/testing/render', 'render')->name('render');
    });

    // MailTemplateController
    Route::controller(MailTemplateController::class)->group(function () {
        Route::get('mail/list', 'index')->name('mailtemplate.list');
        Route::get('mail/add', 'form')->name('mailtemplate.add');
        Route::get('mail/display-data', 'displaydata')->name('display-data.data');
        Route::get('mail/edit/{id}', 'edit')->name('mailtemplate.edit');
        Route::get('mail/detail/{id?}', 'view')->name('mailtemplate.detail.view');
        Route::post('mail/remove', 'delete')->name('mailtemplate.remove');
        Route::post('mail/destroy', 'destroy')->name('mailtemplate.destroy');
        Route::post('mail/restore', 'restore')->name('mailtemplate.restore');
        Route::post('mail/update', 'update')->name('mailtemplate.update');
        Route::post('/mail/status/{id}', 'status')->name('mailtemplate.status');
        Route::post('mail/store', 'store')->name('mailtemplate.store');
        Route::get('mail/trash', 'trashed')->name('mailtemplate.list.trashed');
    });


    // Brief
    Route::controller(BriefAdminController::class)->group(function () {
        Route::get('/brief/list', 'index')->name('brief.list');
        Route::get('/brief/add', 'form')->name('brief.add');
        Route::post('/brief/save', 'store')->name('brief.save');
        Route::get('/brief/edit/{id}', 'edit')->name('brief.edit');
        Route::get('/brief/restore/{id}', 'restore')->name('brief.restore');
        Route::post('/brief/detail/{id?}', 'view')->name('brief.detail.view');
        Route::post('/brief/remove', 'delete')->name('brief.remove');
        Route::post('/brief/view', 'view')->name('brief.view');
        Route::post('/brief/update', 'update')->name('brief.update');
        Route::post('/brief/delete', 'destroy')->name('brief.delete');
        Route::post('/brief/status/{id}', 'status')->name('brief.status');
        Route::get('/brief/trash', 'trashed')->name('brief.list.trashed');
    });


    // Service
    Route::controller(ServiceController::class)->group(function () {
        Route::get('/service/list', 'index')->name('service.list');
        Route::get('/service/add', 'form')->name('service.add');
        Route::post('/service/save', 'store')->name('service.save');
        Route::get('/service/edit/{id}', 'edit')->name('service.edit');
        Route::get('/service/restore/{id}', 'restore')->name('service.restore');
        Route::post('/service/detail/{isTrashed?}', 'view')->name('service.detail.view');
        Route::post('/service/remove', 'delete')->name('service.remove');
        Route::post('/service/view', 'view')->name('service.view');
        Route::post('/service/update', 'update')->name('service.update');
        Route::post('/service/destroy', 'destroy')->name('service.delete');
        Route::post('/service/status/{id}', 'status')->name('service.status');
        Route::get('/service/trash', 'trashed')->name('service.list.trashed');
    });


    // PortFolio
    Route::controller(PortfolioController::class)->group(function () {
        Route::get('/portfolio/list','index')->name('portfolio.list');
        Route::get('/portfolio/add','form')->name('portfolio.add');
        Route::post('/portfolio/save','store')->name('portfolio.save');
        Route::get('/portfolio/edit/{id}','edit')->name('portfolio.edit');
        Route::get('/portfolio/restore/{id}', 'restore')->name('portfolio.restore');
        Route::post('/portfolio/detail/{id?}', 'view')->name('portfolio.detail.view');
        Route::post('/portfolio/remove', 'delete')->name('portfolio.remove');
        Route::post('/portfolio/view', 'view')->name('portfolio.view');
        Route::post('/portfolio/update','update')->name('portfolio.update');
        Route::post('/portfolio/destroy','destroy')->name('portfolio.delete');
        Route::post('/portfolio/status/{id}', 'status')->name('portfolio.status');
        Route::get('/portfolio/trash', 'trashed')->name('portfolio.list.trashed');
    });
});


