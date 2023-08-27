<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brand')->insert(array(
            ['name'=>'nike'],
            ['name'=>'adidas'],
            ['name'=>'vans'],
            ['name'=>'puma'],
            ['name'=>'new balance'],
            ['name'=>'gucci'],
        ));
    }
}
