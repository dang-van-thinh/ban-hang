<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\Users;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginCotronller extends Controller
{
    protected $users;
    protected $time;
    protected $timezone;
    public function __construct(){
        $this->users = new Users();
        $this->time = new DateTime();
        $this->timezone = new DateTimeZone('Asia/Ho_Chi_Minh');
    }
    //
    public function index(){
        $title = 'Đăng nhập';
        return view('login.login',compact([
            'title'
        ]));
    }
    // public function signup(){
    //     $title = 'Đăng ký';
    //     return view('login.register',compact([
    //         'title'
    //     ]));
    // }
    public function register(AuthRequest $request){
        $request->flash();
        $data= [
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->pw),
            'role_id'=>1,
            'created_at'=> $this->time->setTimezone($this->timezone),
        ];
        if($this->users->addUser($data)){
            return redirect()->route('login.index')->with('success','Tạo tài khoản thành công !');
        }
    }
    public function login(AuthRequest $request){
        $cr = [
            'email'=>$request->input('email'),
            'password'=>$request->input('pw')
        ];

        if(Auth::attempt($cr)){
           $role = Auth::user()->role_id;
            if($this->users->hashRole($role)){
                return redirect()->route('admin.dashboard')->with('success','Đănng nhập thành công !');
            }else{
                return redirect()->route('home')->with('success','Đăng nhập thành công');
            }
            
        }else{
            return redirect()->route('home')->with('error','Kiểm tra lại tài khoản và mật khẩu, do không chính xác !');
        }
        $request->flash();
    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home')->with('success','Đăng xuất thành công !');
   }
}
