<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    protected $table='role';
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table($this->table)->insert([
            ['name'=>'Quản trị viên'],
            ['name'=>'Người dùng'],
        ]);
        //
    }
}
