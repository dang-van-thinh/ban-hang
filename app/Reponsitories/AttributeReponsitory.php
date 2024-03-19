<?php
namespace App\Reponsitories;
use App\Models\Color;
use App\Models\Size;

use Illuminate\Support\Facades\DB;

class   AttributeReponsitory {
  protected $color;
  protected $size;
  public function __construct(){
    $this->color = new Color();
    $this->size = new Size();
  }
  public function getAllSize(){
    return Size::all();
  }
  public function getAllColor(){
    return Color::all();
  }

  public function addColor($data){
    return Color::insert($data);
  }
  public function addSize($data){
    return Size::insert($data);
  }
    
  public function getOneColor($id){
    return Color::find($id);
  }
  public function getOneSize($id){
    return Size::find($id);
  }

  public function updateColor($id,$data){
    return Color::where('id',$id)->update($data);
  }
  public function updateSize($id,$data){
    return Size::where('id',$id)->update($data);
  }
  public function deleteColor($id){
    return Color::find($id)->delete();
  }
  public function deleteSize($id){
    return Size::find($id)->delete();
  }
}