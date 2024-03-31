<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quanity extends Model
{
    use HasFactory;
    protected $table='quanity';
    protected $fillable = [
        'quanity_pr',
        'product_id',
        'id_color',
        'id_size'
    ];
    public function getQuanity($id_product,$id_color,$id_size){
        return Quanity::where('product_id','=',$id_product)
        ->where('id_color','=',$id_color)
        ->where('id_size','=',$id_size)
        ->first();
    }
    public function addQuanity($data){
        return Quanity::insert($data);
    }
    public function updateQuanity($id,$color,$size,$data){
        return Quanity::where('product_id','=',$id)
        ->where('id_color','=',$color)
        ->where('id_size','=',$size)
        ->update($data);
    }
    public function updateQuanityAfterAddBill($id_quanity,$quanity){
        return Quanity::find($id_quanity)->update(['quanity_pr'=>$quanity]);
    }
    public function delQuanity($id_product,$id_color,$id_size){
        return Quanity::where('product_id','=',$id_product)
        ->where('id_color','=',$id_color)
        ->where('id_size','=',$id_size)
        ->delete();
    }
    public function getQuanityForColorAndSize($id_product,$id_color,$id_size){
        return Quanity::where('product_id' ,'=',$id_product)
        ->where('id_color','=',$id_color)
        ->where('id_size','=',$id_size)
        ->first();
    }
    // public function product(){
    //     return $this->belongsTo(Product::class)->onDelete('cascade');
    // }
    // public function color(){
    //     return $this->belongsTo(Color::class);
    // }
    // public function size(){
    //     return $this->belongsTo(Size::class);
    // }
}
