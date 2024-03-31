<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $category;
    protected $categoryChill;
    public function __construct(){
        $this->category = new Category();
    }
    //
    public function profile(){
        $title = 'Thông tin người dùng';
        $categoryChill = $this->category;
        $category = $this->category->getCategoryParent();
        return view('client.page.profiles.profile',compact(
            'title',
            'category',
            'categoryChill'
        ));
    }
}
