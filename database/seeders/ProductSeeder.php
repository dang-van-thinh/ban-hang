<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('product')->insert(
            [
                [
                    'name'=>'Quần thể thao nam Chất lượng ',
                    'price'=>150000,
                    'quanity'=>20,
                    'quanity_sale'=>0,
                    'description'=>'Quần rất chất lượng',
                    'rating'=>0,
                    'img'=>'...',
                    'category_id'=>1
                ]
            ,
            [
                'name'=>'Áo thể thao nam Chất lượng ',
                'price'=>20000,
                'quanity'=>20,
                'quanity_sale'=>0,
                'description'=>'Áo rất chất lượng',
                'rating'=>5,
                'img'=>'...',
                'category_id'=>2
            ]
            ]
);
    }
}
