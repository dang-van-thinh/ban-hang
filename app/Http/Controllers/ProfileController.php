<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangPasswordRequest;
use App\Models\Bill;
use App\Models\Category;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    protected $category;
    protected $users;
    protected $categoryChill;
    protected $bill;
    public function __construct(){
        $this->users = new Users();
        $this->category = new Category();
        $this->bill = new Bill();
    }
    //
    public function profile(){
        $title = 'Thông tin người dùng';
        $categoryChill = $this->category;
        $category = $this->category->getCategoryParent();
        $user = Auth::user();
        $bill = $this->bill->BillByUser($user->id);
        $oneBill = $this->bill;
        // dd($bill);
        // die;
        $script = [
            'js/client/libs/profile.js'
        ];
        return view('client.page.profiles.profile',compact(
            'title',
            'category',
            'categoryChill',
            'user',
            'bill',
            'oneBill',
            'script'
        ));
    }
    // public function profileBill(){
    //     $title = 'Đơn hàng';
    //     $categoryChill = $this->category;
    //     $category = $this->category->getCategoryParent();
    //     return view('client.page.profiles.bill',compact(
    //         'title',
    //         'category',
    //         'categoryChill'
    //     ));
    // }
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
    public function updatePassword(ChangPasswordRequest $request){
        $data = [
            'password'=>Hash::make($request->newPW)
        ];
        $this->users->updateUser(Auth::id(),$data);
        return redirect()->route('profiles.profile-setting')->with('success','Cập nhật mật khẩu thành công !');
        }
    public function changePassword(){
        $title = 'Thay đổi mật khẩu';
        $categoryChill = $this->category;
        $category = $this->category->getCategoryParent();
        $script = [
            'js/client/libs/updatePassword.js'
        ];
        return view('client.page.profiles.update-password',compact(
            'title',
            'category',
            'categoryChill',
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
