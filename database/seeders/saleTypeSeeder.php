<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class saleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_sale_type')->insert([
            'name' => 'Fresh Sales',
            'created_by' => 1
        ]);

        DB::table('payment_sale_type')->insert([
            'name' => 'Upsell',
            'created_by' => 1
        ]);
        
    }
}
