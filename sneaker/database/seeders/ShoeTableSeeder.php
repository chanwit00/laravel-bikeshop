<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShoeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shoe')->insert(array(
            [
                'code'  =>  's001',
                'name'  =>  'air jordan 1 low',
                'brand_id'    => 1,
                'price' =>  11900,
                'stock_qty' => 2,
            ],

            [
                'code'  =>  's002',
                'name'  =>  'monarch',
                'brand_id' => 1,
                'price' =>  5000,
                'stock_qty' => 4,
            ],

            [
                'code'  =>  's003',
                'name'  =>  'nike air max',
                'brand_id' => 1,
                'price' =>  6500,
                'stock_qty' => 2,
            ],
        ));
    }
}
