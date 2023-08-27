<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypebookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('typebook')->insert(array(
            ['name'=>'นิยาย'],
            ['name'=>'หนังสือเรียน'],
            ['name'=>'นิทาน'],
            ['name'=>'ชีวประวัติ'],
            ['name'=>'ความรู้ทั่วไป'],
            ['name'=>'หนังสือเพลง'],
        ));
    }
}
