<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Districts extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];
    protected $tabble = 'districts';
    public function findDistrictsForProvince($province_id){
        return Districts::where('province_code','=',$province_id)->get();
    }
    public function getNameDistrict($distrist_id){
        return Districts::where('code','=',$distrist_id)->first();
    }
}
