<?php

namespace App\Http\Middleware;

use App\Models\Users;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LoginMiddleware
{
    protected $checklogin;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::id() > 0){ // kiểm tra xem đẫ login chưa , nếu id lớn hơn 0 thì là log rồi
            $this->checklogin = 1;
            $role = Auth::user()->role_id;
            if(Users::hashRole($role)){ // kieemt tra role của phiên đăng nhập
                return redirect()->route('admin.dashboard')->with('error','Bạn cần đăng xuất trước !');
            }
            return redirect()->route('client.home')->with('error','Bạn cần đăng xuất trước !');
        }
        $this->checklogin = 0;
        return $next($request);
        
    }
    public function checkLogin(){
        return $this->checklogin;
    }
}
