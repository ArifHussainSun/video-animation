<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\BrandSettings;
use App\Models\CountryCurrencies;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('brand_name', function(){
            return BrandSettings::where("key_name", '=', "company_name")->first()->key_value;
        });

        view()->composer('*', function($view) {
            $brandSettings = Arr::pluck(BrandSettings::get(), 'key_value', 'key_name');
            $data["brand_settings"] = $brandSettings;
            $data["brand_name"] = $data["brand_settings"]["company_name"];

            if (Auth::check()) {
                $user = Auth::user();
                $data["user"] = $user;
            }

            $view->with($data);
        });
    }
}
