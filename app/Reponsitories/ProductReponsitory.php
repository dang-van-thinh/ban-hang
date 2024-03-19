<?php
namespace App\Reponsitories;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Quanity;
use Illuminate\Support\Facades\DB;

class ProductReponsitory {
  protected $model;
  public function __construct(){
    $this->model = new Product();
  }
    public function countProductWithCategory($id)
  {
    return Product::where('category_id', $id)->count();
  }
  public function getProductWithCategory($id_category){
    return Product::where('category_id',$id_category)->get();
  }
  public function getAllProduct($offset,$limit)
  {
    return Product::offset($offset)->limit($limit)->get();
  }
  public function countAllProduct(){
    return Product::count();
  }

  public function addProducts($data)
  {
    return Product::create($data);
  }
  
  public function delProducts($id)
  {
    $product = Product::find($id);
    ProductVariant::where('product_id',$id)->delete();
    Quanity::where('product_id',$id)->delete();
    return $product->delete();
  }

  public function getOneProduct($id)
  {
    $pro = Product::join('quanity as q','q.product_id','=','product.id')
    ->select('product.*','q.quanity_pr','q.id_color','q.id_size')
    ->where('product.id', $id)
    ->get();
    return $pro;
  }

  public function updateProduct($id, $data)
  {
    return Product::findOrFail($id)->update($data);
  }

}