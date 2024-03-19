<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
  use HasFactory;
  // protected $fillable = [
  //     'name',
  //     'price'
  // ];
  protected $table = 'product';
  protected $fillable = [
    'name',
    'price',
    'price_sale',
    'img',
    'description',
    'rating',
    'category_id'
  ];
  // public function category()
  // {
  //   return $this->belongsTo(Category::class);
  // }
  // public function product_variant(){
  //   return $this->hasMany(ProductVariant::class,)->onDelete('cascade');
  // }
  // public function quanity(){
  //   return $this->hasMany(Quanity::class,'product_id','id');
  // }
  
}
