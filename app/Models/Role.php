<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table='role';
    protected $fillable = [
        'name'
    ];

    public static function hashRole($role){
        // $data = Role::where('id',$role)->first();
        // if($data->id)
    }
    public function getAllRole(){
        return Role::all();
    }
}
