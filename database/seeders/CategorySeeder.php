<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(['name' => 'Logo Design', 'title' => 'Logo Design', 'description' => 'Logo Design', 'created_by' => 1, 'active' => 1 ]);
        DB::table('categories')->insert(['name' => 'Logo + Branding', 'title' => 'Logo + Branding', 'description' => 'Logo + Branding', 'created_by' => 1, 'active' => 1 ]);
        DB::table('categories')->insert(['name' => 'Logo + Branding + Website', 'title' => 'Logo + Branding + Website', 'description' => 'Logo + Branding + Website', 'created_by' => 1, 'active' => 1 ]);
        DB::table('categories')->insert(['name' => 'Branding Collateral', 'title' => 'Branding Collateral', 'description' => 'Branding Collateral', 'created_by' => 1, 'active' => 1 ]);
        DB::table('categories')->insert(['name' => 'Website Package', 'title' => 'Website Package', 'description' => 'Website Package', 'created_by' => 1, 'active' => 1 ]);
        DB::table('categories')->insert(['name' => 'Video Animation', 'title' => 'Video Animation', 'description' => 'Video Animation', 'created_by' => 1, 'active' => 1 ]);
        DB::table('categories')->insert(['name' => 'Content Writing', 'title' => 'Content Writing', 'description' => 'Content Writing', 'created_by' => 1, 'active' => 1 ]);
        DB::table('categories')->insert(['name' => 'Printing Services', 'title' => 'Printing Services', 'description' => 'Printing Services', 'created_by' => 1, 'active' => 1 ]);
        DB::table('categories')->insert(['name' => 'Digital Marketing', 'title' => 'Digital Marketing', 'description' => 'Digital Marketing', 'created_by' => 1, 'active' => 1 ]);
        DB::table('categories')->insert(['name' => 'Mobile Application', 'title' => 'Mobile Application', 'description' => 'Mobile Application', 'created_by' => 1, 'active' => 1 ]);
    }
}
