<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('category')->insert(
            [
                [
                    'name'=>'Quần thể thao',
                    'type'=>0
                ],
                [
                    'name'=>'Áo thể thao',
                    'type'=>0
                ],
                [
                    'name'=>'Phụ kiện thể thao',
                    'type'=>0
                ],
                [
                    'name'=>'Giày thể thao',
                    'type'=>0
                ],
            ]
            );
    }
}
