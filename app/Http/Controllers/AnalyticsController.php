<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    protected $bill;
    public function __construct(){
        $this->bill = new Bill();
    }
    //
    public function dashboard()
    {
        // dd(Auth::user()->role_id);
        // die;

        $totalQuanitySell = DB::table('bill')->sum(DB::raw('total_quanity'));
        $totalUser = DB::table('users')->count();
        $dataDashboard = [
            'quanity'=> $totalQuanitySell,
            'user'=> $totalUser,
            'cod'=> $this->countPayForCOD(),
            'momo'=>$this->countPayForMM(),
            'order'=> $this->countNewOrder()
        ];

        // dd($dataDashboard);
        // die;
        $title  = 'Quản lý trang bán hàng';
        return view('admin.dashboard', compact(
            'title',
            'dataDashboard'
        ));
    }
    private function countPayForCOD(){
        $pay = DB::table('bill')->join('detail_bill as db','db.bill_id','bill.id')
        ->where('bill.pay','=',1)
        ->where('bill.status','=',5)
        ->sum(DB::raw('db.price_current * db.quanity_buy'));
        return $pay;
    }
    private function countPayForMM(){
        $pay = DB::table('bill')->join('detail_bill as db','db.bill_id','bill.id')
        ->where('bill.pay','=',2)
        ->where('bill.status','=',5)
        ->sum(DB::raw('db.price_current * db.quanity_buy'));
        return $pay;
    }
    private function countNewOrder(){
        $order = DB::table('bill')->where('status','=',1)->count();
        return $order;
    }
}
