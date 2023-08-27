<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('book')->insert(array(
            [
                'code'  =>  'b001',
                'name'  =>  'ภาษาไทย',
                'typebook_id'    => 1,
                'price' =>  11900,
                'stock_qty' => 2,
            ],

            [
                'code'  =>  'b002',
                'name'  =>  'oasis',
                'typebook_id' => 1,
                'price' =>  5000,
                'stock_qty' => 4,
            ],

            [
                'code'  =>  'b003',
                'name'  =>  'nervana',
                'typebook_id' => 1,
                'price' =>  6500,
                'stock_qty' => 2,
            ],
        ));
    }
}
