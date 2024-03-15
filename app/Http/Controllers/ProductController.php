<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Quanity;
use App\Models\Size;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    protected $product;
    protected $datetime;
    protected $timezone;
    protected $category;
    public function __construct(){
        $this->product = new Product();
        $this->category = new Category();
        $this->datetime = new DateTime();
        $this->timezone = new DateTimeZone('Asia/Ho_Chi_minh');

    }
    public function dashboard(){
        $title  = 'Quản lý trang bán hàng';
        return view('admin.dashboard',compact('title'));
    }
    public function getProductVariant($id){
        return ProductVariant::where('product_id',$id)->get();
    }
    public function getSizeWithProduct($id_size){
        $data = Size::find($id_size);
        return $data;
    }
    public function getColorWithProduct($id_color){
        $data = Color::find($id_color);
        return $data;
    }
    public function getQuanityWithProduct($id_color,$id_size,$id_product){
        return Quanity::where('id_size',$id_size)
        ->where('id_color',$id_color)->where('id_product',$id_product)->first();
    }
    public function index (){
        $productVariant = new ProductController();
       
        $title = 'Danh sách sản phẩm';
       $product=  $this->product->getAllProduct();


        return view('admin.product.list',compact([
            'title',
            'product',
            'productVariant'
        ]));
    }
    public function create(){
        $category = $this->category->getAllCategory();
        $title = 'Thêm sản phẩm';
        return view('admin.product.add',compact([
            'title',
            'category'
        ]));
    }
    public function store(ProductRequest $request){
       $request->flash();

       if( $request->has('img')){
        $file = $request->file('img');
        $extension = $file->getClientOriginalExtension();
        $fileName = time().'.'.$extension;
        $path = 'public/upload/';
        $file->move($path,$fileName);
        $filePath = $path.$fileName;
       }
       $data = [
        'name'=>$request->name,
        'price'=>$request->price,
        'quanity'=>$request->quanity,
        'price_sale'=>$request->price_sale,
        'img'=>$filePath,
        'description'=>$request->description,
        'rating'=>0,
        'category_id'=>$request->category_id,
        'created_at'=>$this->datetime->setTimezone($this->timezone),
       ];
       if($this->product->addProducts($data)){
       
        return redirect()->route('admin.product.create')->with('success','Thêm thành công sản phẩm !');
       }
       return redirect()->route('admin.product.create')->with('errors','Không thành công');
    }
    public function delete($id){
        if($this->product->delProducts($id)){
            return redirect()->route('admin.product.index')->with('success','Xóa thành công sản phẩm !');
        }
    }
    public function edit($id){
        $category = $this->category->getAllCategory();
        $products = $this->product->getOneProduct($id);
        // var_dump($products);
        // die;
        $title = 'Chỉnh sửa sản phẩm';
        return view('admin.product.edit',compact([
            'products',
            'title',
            'category'
        ]));
    }
    public function update(ProductRequest $request,$id){
        $request->flash();
        if($request->hasFile('img2')){ // kiểm tra xem file ảnh này có giá trị tải lên hay không
            $file = $request->file('img2');
            $extension = $file->getClientOriginalExtension();
            $fileName = time().'.'.$extension;
            $path = 'public/upload/';
            $file->move($path,$fileName);
            $filePath = $path.$fileName;
           }else{
            $filePath = $request->input('img');
           }
       $data = [
        'name'=>$request->name,
        'price'=>$request->price,
        'quanity'=>$request->quanity,
        'price_sale'=>$request->price_sale,
        'img'=>$filePath,
        'description'=>$request->description,
        'rating'=>0,
        'category_id'=>$request->category_id,
        'upated_at'=>$this->datetime->setTimezone($this->timezone),
       ];
       if($this->product->updateProduct($id,$data)){
        return redirect()->route('admin.product.index')->with('success','Thay đổi thành công sản phẩm !');
       }
       return redirect()->route('admin.product.edit',$id)->with('errors','Không thành công');
    }
}
