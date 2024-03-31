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
    public function getAllSize(){
        return Size::all();
    }
    public function getSizeForProduct($id_product){
        return Size::join('quanity','quanity.id_size','=','size.id')
        ->select('size.name as nameSize','size.id as idSize')
        ->distinct()
        ->where('quanity.product_id','=',$id_product)
        ->get();
    }
}
