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
    public function findOneProductVariant($id_product,$id_color,$id_size){
        return ProductVariant::where('product_id',$id_product)
        ->where('color_id',$id_color)
        ->where('size_id',$id_size)
        ->first();
    }
    public function addProductVariant($data){
        return ProductVariant::insert($data);
    }
    public function updateProductVariant($id,$color,$size,$data){
        return ProductVariant::where('product_id',$id)
        ->where('color_id',$color)
        ->where('size_id',$size)
        ->update($data);
    }
    public function delProductVariant($id_product){
        return ProductVariant::where('product_id',$id_product)->delete();
    }
    public function getOneProductVariant($id_product){
        return ProductVariant::where('product_id',$id_product)->get();
    }
}
