<?php

namespace App\Reponsitories;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Quanity;
use Illuminate\Support\Facades\DB;

class ProductReponsitory
{
  protected $model;
  protected $table = 'product';
  public function __construct()
  {
    $this->model = new Product();
  }
  public function getAllProduct( $category = null, $orderBy = null)
  {
    $product = DB::table($this->table);
    if ($category) {
      $product = $product->where('category_id', '=', $category);
    }
    if ($orderBy != null) {
      $product = $product->orderBy($orderBy, 'desc');
    }
    $product = $product->paginate(12);

    return $product;
  }
  
  public function countProduct($id_category = null)
  {
    $count = DB::table($this->table);
    if ($id_category != null) {
      $count = $count->where('category_id', '=', $id_category);
    }
    $count = $count->count();
    return $count;
  }

  public function delProducts($id)
  {
    $product = Product::find($id);
    ProductVariant::where('product_id', $id)->delete();
    Quanity::where('product_id', $id)->delete();
    return $product->delete();
  }
  public function addProducts($data)
  {
    return Product::create($data);
  }
  public function getOneProduct($id)
  {
    $pro = Product::join('quanity as q', 'q.product_id', '=', 'product.id')
      ->join('color', 'q.id_color', '=', 'color.id')
      ->join('size', 'q.id_size', '=', 'size.id')
      ->select(
        'product.*',
        'q.quanity_pr as quanityProduct',
        'q.id_color as idColor',
        'q.id_size as idSize',
        'color.name as nameColor',
        'color.value as valueColor',
        'size.name as nameSize'
      )
      ->where('product.id', $id)
      ->get();
    return $pro;
  }
  public function getProductForCategory($id_category, $id)
  {
    return Product::where('category_id', '=', $id_category)
      ->where('id', '!=', $id)
      ->get();
  }
  public function filterProduct($color=null, $size = null, $price = null, $orderby, $category=0,$key=null)
  {
    $product = Product::join('quanity as q', 'q.product_id', '=', 'product.id')
      ->join('color', 'color.id', '=', 'q.id_color')
      ->join('size', 'size.id', '=', 'q.id_size');
    if ($category>0) {
      $product = $product->where('product.category_id', '=', $category);
    }
    if ($color) {
      $product = $product->whereIn('q.id_color', $color);
    }
    if ($size) {
      $product = $product->whereIn('q.id_size', $size);
    }
    if ($price) {
      $product = $product->whereBetween('product.price',[0,$price]);
    }
    if ($key) {
      $product = $product->where('product.name','like','%'.$key.'%');
    }
    $product = $product->groupBy('product.id', 'product.name', 'product.img', 'product.price')
      ->select('product.id', 'product.name', 'product.img', 'product.price');
    if ($orderby == 1) {
      $product = $product->orderBy('product.price', 'desc');
    } elseif ($orderby  == 2) {
      $product = $product->orderBy('price', 'asc');
    } elseif ($orderby == 3) {
      $product = $product->orderBy('name', 'asc');
    } elseif ($orderby == 4) {
      $product = $product->orderBy('name', 'desc');
    }
    $product = $product->get();
   
    return $product;
  }
  public function updateProduct($id, $data)
  {
    return Product::findOrFail($id)->update($data);
  }


  // client
  public function getProductsNewLimit($limit = 8)
  {
    return Product::limit($limit)->orderBy('created_at', 'desc')->get();
  }
  public function getProductByViewLimit($limit = 8)
  {
    return Product::limit($limit)->orderBy('views', 'desc')->get();
  }
  public function getPriceMax($id_category=null,$id_product=null){
    $query = DB::table('product');
    if($id_category!=null){
      $query = $query->where('category_id','=',$id_category);
    }
    if($id_product != null){
      $query = $query->whereIn('id',$id_product);
    }
   return $query->max('price');

  }
  public function getPriceMin($id_category=null,$id_product=null){
    $query = DB::table('product');
    if($id_category!=null){
      $query = $query->where('category_id','=',$id_category);
    }
    if($id_product != null){
      $query = $query->whereIn('id',$id_product);
    }
   return $query->min('price');

  }
  public function getProductWithCategory($id_category)
  {
    return Product::where('category_id', '=', $id_category)
    ->paginate(12);
  }
  public function getProductBySearch($key){
    return Product::where('product.name','like','%'.$key.'%')
    ->paginate(12);
  }
  public function upToViewForProduct($id)
  {
    $product = Product::find($id);
    $view = $product->views;
    $view++;
    $product->views = $view;
    return $product->save();
  }
}
