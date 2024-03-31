<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wards extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];
    protected $tabble = 'wards';
    public function findDistrictsForProvince($district_id){
        return Wards::where('district_code','=',$district_id)->get();
    }
    public function getNameWard($ward_id){
        return Wards::where('code','=',$ward_id)->first();
    }
}
