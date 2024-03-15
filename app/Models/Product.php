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
  public function category()
  {
    return $this->belongsTo(Category::class);
  }
  public function product_variant(){
    return $this->hasMany(ProductVariant::class);
  }
  public function quanity(){
    return $this->hasMany(Quanity::class);
  }
  public function countProductWithCategory($id)
  {
    return Product::where('category_id', $id)->count();
  }
  public function getProductWithCategory($id_category){
    return Product::where('category_id',$id_category)->get();
  }
  public function getAllProduct()
  {
    $product = Product::all();
    return $product;
  }
  public function addProducts($data)
  {
    return DB::table($this->table)->insert($data);
  }
  public function delProducts($id)
  {
    $stt = Product::where('id', $id)->delete();
    return $stt;
  }
  public function getOneProduct($id)
  {
    $pro = Product::where('id', $id)->first();
    return $pro;
  }
  public function updateProduct($id, $data)
  {
    return Product::findOrFail($id)->update($data);
  }
}
