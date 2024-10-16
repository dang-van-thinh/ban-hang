<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Models\Users;
use DateTime;
use DateTimeZone;
use Flasher\Prime\Notification\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginCotronller extends Controller
{
    private $users;
    private $time;
    private $timezone;
    public function __construct()
    {
        $this->users = new Users();
        $this->time = new DateTime();
        $this->timezone = new DateTimeZone('Asia/Ho_Chi_Minh');
    }
    //
    public function index()
    {
        $title = 'Đăng nhập';
        return view('login.login', compact([
            'title'
        ]));
    }

    public function register(AuthRequest $request)
    {
        $request->flash();
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->pw),
            'phone_number' => $request->phone_number,
            'role_id' => 2,
            'created_at' => $this->time->setTimezone($this->timezone),
        ];

        // xác thực email là đúng

        if ($this->users->addUser($data)) {
            noty("Tạo tài khoản thành công !", Notification::SUCCESS);
            return redirect()->route('home');
            //                ->with('success','Tạo tài khoản thành công !');
        }
    }
    public function login(AuthRequest $request)
    {
        $request->flash();
        $cr = [
            'email' => $request->input('email'),
            'password' => $request->input('pw')
        ];
        // $pwtk = '$2y$12$xLcqx1EB5i1x5RQr8gi0M.dJBgpY.kU44F4rSEFEscejkNof8wZ3G';
        // $pw = '0123456789';
        // dd(Hash::check($pw,$pwtk));
        // die;

        if (Auth::attempt($cr)) {
            $role = Auth::user()->role_id;
            if ($this->users->hashRole($role)) {
                noty("Đănng nhập thành công !", Notification::SUCCESS);
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('home')->with('success', 'Đăng nhập thành công');
            }
        } else {
            sweetalert("Kiểm tra lại tài khoản và mật khẩu, do không chính xác !", Notification::ERROR);
            return redirect()->route('home');
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        noty("Đăng xuất thành công !", Notification::SUCCESS);
        return redirect()->route('home');
    }
}
