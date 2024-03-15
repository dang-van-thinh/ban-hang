<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $table = 'users';
    public function run(): void
    {
        DB::table($this->table)->insert([
            [
                'name'=>'Đặng Văn Thịnh',
                'email'=>'vanthinh@gmail.com',
                'password'=>Hash::make('12345678'),
                'role_id'=>1,
                'created_at'=>date('Y-m-d'),
            ],
            // [
            //     'name'=>'Admin',
            //     'email'=>'admin@gmail.com',
            //     'password'=>Hash::make('12345678'),
            //     'role_id'=>1
            // ],
            // [
            //     'name'=>'Đặng Văn Thịnh',
            //     'email'=>'thinh@gmail.com',
            //     'password'=>Hash::make('123456789'),
            //     'role_id'=>2
            // ],
            
        ]);
        //
    }
}
