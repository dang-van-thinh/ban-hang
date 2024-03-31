<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailBill extends Model
{
    use HasFactory;
    protected $fillable = [
        'bill_id',
        'product_id',
        'price_current',
        'quanity_buy',
        'color_id',
        'size_id'
    ];
    protected $table ='detail_bill';
    public function insert($data){
        return DetailBill::create($data);
    }
}
