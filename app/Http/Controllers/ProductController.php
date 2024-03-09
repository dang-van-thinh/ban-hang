<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index (){
        $title = 'Chào mừng bạn';
        return view('admin.product.index',compact('title'));
    }
}
