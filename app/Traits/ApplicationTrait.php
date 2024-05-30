<?php
namespace App\Traits;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Models\BrandSettings;
use Illuminate\Support\Arr;

trait ApplicationTrait {

    public function get_setting($key_name = null) {

        if($key_name==null) {
            return BrandSettings::all()->pluck('key_value', 'key_name');
        }

        if(cache::has('brandSettings')) {
            $brand_settings = cache::get('brandSettings');
        } else {
            $brand_settings = Cache::remember('brandSettings', 86400, function() {
                return BrandSettings::all()->toArray();
            });
        }



        $find = Arr::where($brand_settings, function ($value, $key) use ($key_name) {
            if($value["key_name"] == $key_name) {
                return $value["key_value"];
            }
        });

        if(!empty($find)) {
            return head($find)["key_value"];
        } else {
            return null;
        }
    }

}
