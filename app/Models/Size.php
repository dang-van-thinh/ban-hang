<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    protected $table='size';
    protected $fillable = [
        'name'
    ];
    public function product_variant(){
       return $this->hasMany(ProductVariant::class);
    }
    public function quanity(){
        return $this->hasMany(Quanity::class);
    }
}
