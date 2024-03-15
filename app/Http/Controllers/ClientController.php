<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    protected $loginmiddleware;
    protected $category;
    protected $product;
    public function __construct(){
        $this->category = new Category();
        $this->product = new Product();
    }
    //
    public function home(){
        $title = 'Trang chủ';
        $checkLogin = Auth::check();
        $categoryChill = $this->category;
        $category = $this->category->getCategoryParent();
        return view('client.page.home',compact([
            'title',
            'category',
            'checkLogin',
            'categoryChill'
        ]));
    }
    public function product($id_category){
        $categoryChill = $this->category;
        $category = $this->category->getCategoryParent();
        $checkLogin = Auth::check();
        $title = 'Sản phẩm theo danh mục';
        $products = $this->product->getProductWithCategory($id_category);
        return view('client.page.product',compact([
            'title',
            'products',
            'category',
            'categoryChill',
            'checkLogin'
        ]));

    }
}
