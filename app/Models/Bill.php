<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'date_time_buy',
        'status',
        'note',
        'total_quanity',
        'pay',
        'address',
        'province_id',
        'district_id',
        'ward_id',
        'phone_number',
        'email',
        'name',
        'created_at',

    ];
    protected $table = 'bill';

    public function addBill($data){
        return Bill::create($data);
    }
}
