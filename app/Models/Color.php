<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Quanity;
class Color extends Model
{
    use HasFactory;
    protected $table='color';
    protected $fillable = [
        'name',
        'value'
    ];
    public function product_variant(){
        return $this->hasMany(ProductVariant::class);
    }
    public function quanity(){
        return $this->hasMany(Quanity::class);
    }
}
