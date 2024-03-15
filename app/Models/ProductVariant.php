<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;
    protected $table = 'product_variant';
    protected $fillable = [
        'product_id',
        'color_id',
        'size_id',
    ];
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function quanity(){
        return $this->belongsTo(Quanity::class);
    }
    public function size(){
        return $this->belongsTo(Size::class);
    }
    public function color(){
        return $this->belongsTo(Color::class);
    }
}
