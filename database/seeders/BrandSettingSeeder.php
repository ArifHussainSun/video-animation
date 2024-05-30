<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Company Information
        DB::table('brand_settings')->insert([ 'key_name' => 'logo', 'key_value' => '', 'created_by' => 1 ]);
        DB::table('brand_settings')->insert([ 'key_name' => 'logo_white', 'key_value' => '', 'created_by' => 1 ]);
        DB::table('brand_settings')->insert([ 'key_name' => 'company_alias', 'key_value' => 'BX', 'created_by' => 1 ]);
        DB::table('brand_settings')->insert([ 'key_name' => 'company_name', 'key_value' => 'BrandX', 'created_by' => 1 ]);
        DB::table('brand_settings')->insert([ 'key_name' => 'company_phone', 'key_value' => '', 'created_by' => 1 ]);
        DB::table('brand_settings')->insert([ 'key_name' => 'company_email', 'key_value' => '', 'created_by' => 1 ]);
        DB::table('brand_settings')->insert([ 'key_name' => 'company_address', 'key_value' => '', 'created_by' => 1 ]);

        //Social Links
        DB::table('brand_settings')->insert(['key_name' => 'social_facebook', 'key_value' => '#', 'created_by' => 1 ]);
        DB::table('brand_settings')->insert(['key_name' => 'social_instagram', 'key_value' => '#', 'created_by' => 1 ]);
        DB::table('brand_settings')->insert(['key_name' => 'social_twitter', 'key_value' => '#', 'created_by' => 1 ]);
        DB::table('brand_settings')->insert(['key_name' => 'social_youtube', 'key_value' => '#', 'created_by' => 1 ]);
        DB::table('brand_settings')->insert(['key_name' => 'social_linkedin', 'key_value' => '#', 'created_by' => 1 ]);

        //Testing Stripe Payment Keys
        DB::table('brand_settings')->insert([
            'key_name' => 'payment_gateway_stripe_testing', 
            'key_value' => json_encode(
                                array("merchant_id" => "", "public_key" => "", "secret_key" => "", "statement_descriptor" => "", "environment" => "", )
                            ), 
            'created_by' => 1
        ]);

        DB::table('brand_settings')->insert(['key_name' => 'default_payment_gateway', 'key_value' => 'payment_gateway_stripe_testing', 'created_by' => 1 ]);
        DB::table('brand_settings')->insert(['key_name' => 'default_currency', 'key_value' => 'US', 'created_by' => 1 ]);

        //Sample General email 
        DB::table('brand_settings')->insert([
            'key_name' => 'mail_setting_general', 
            'key_value' => json_encode(
                            array( "mail_protocol" => "", "mail_smtp_host" => "", "mail_smtp_port" => "",  "mail_smtp_user" => "", "mail_smtp_email" => "", "mail_smtp_pass" => "", "mail_charset" => "", "mail_wordwrap" => "", "mail_mailtype" => "")
                        ), 
            'created_by' => 1
        ]);

        //Sample Billing email 
        DB::table('brand_settings')->insert([
            'key_name' => 'mail_setting_billing', 
            'key_value' => json_encode(
                            array( "mail_protocol" => "", "mail_smtp_host" => "", "mail_smtp_port" => "",  "mail_smtp_user" => "", "mail_smtp_email" => "", "mail_smtp_pass" => "", "mail_charset" => "", "mail_wordwrap" => "", "mail_mailtype" => "")
                        ), 
            'created_by' => 1
        ]);

        
    }
}
