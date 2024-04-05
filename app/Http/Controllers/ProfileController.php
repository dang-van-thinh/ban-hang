<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    protected $category;
    protected $users;
    protected $categoryChill;
    public function __construct(){
        $this->users = new Users();
        $this->category = new Category();
    }
    //
    public function profile(){
        $title = 'Thông tin người dùng';
        $categoryChill = $this->category;
        $category = $this->category->getCategoryParent();
        $user = Auth::user();
        return view('client.page.profiles.profile',compact(
            'title',
            'category',
            'categoryChill',
            'user'
        ));
    }
    public function profileBill(){
        $title = 'Đơn hàng';
        $categoryChill = $this->category;
        $category = $this->category->getCategoryParent();
        return view('client.page.profiles.bill',compact(
            'title',
            'category',
            'categoryChill'
        ));
    }
    public function profileSetting(){
        $title = 'Cài đặt';
        $categoryChill = $this->category;
        $category = $this->category->getCategoryParent();
        $user = Auth::user();
        $script = [
            'js/client/libs/setting.js'
        ];
        // dd($user);
        // die;
        return view('client.page.profiles.setting',compact(
            'title',
            'category',
            'categoryChill',
            'user',
            'script'
        ));
    }
    public function deleteAccount(Request $request,$id){
        // $this->users->delUser($id);
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
      return redirect()->route('home')->with('success','Xóa tài khoản thành công !');
    }
}
