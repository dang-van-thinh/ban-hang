<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'category';
    protected $fillable = [
        'name',
        'type'
    ];
    public function getAllCategory(){
        return Category::paginate(10);
    }
    public function getCategoryForProduct($id_category){
        return Category::where('id','=',$id_category)->first();
    }

    public function getCategoryParent(){
        return Category::where('type','=',0)->get();
    }
    public function getCategoryChill($id){
        return Category::where('type',$id)->get();
    }
    public function countAllCategory(){
        return Category::count();
    }
    public function getCategoryEdit($id){
        return Category::where('type','=',0)->where('id','!=',$id)->get();
    }
    public function addCategory($data){
        return Category::insert($data);
    }
    public function delCategory($id){
        return Category::where('id',$id)->delete();
    }
    public function getOneCategory($id){
        return Category::where('id',$id)->first();
    }
    public function updateCategory($id,$data){
        return Category::findOrFail($id)->update($data);
    }
}
