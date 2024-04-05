<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use Illuminate\Http\Request;

class BillController extends Controller
{
    protected $bill;
    public function __construct(){
        $this->bill = new Bill();
    }
    //
    public function index($page=0){
        $title = 'Danh sách hóa đơn';
        $curentPage = 1;
        if($page > 0){
            $curentPage = $page;
        }
         // trang hiện tại
        $limit = 12; // số lượng sản phẩm có trong 1 trang
        $perPage = $curentPage - 1;
        $offset = intval($perPage * $limit);
        $count = $this->bill->countBill();
        $numberPage = ceil($count / $limit);
        $bills = $this->bill->allBill($offset,$limit);
        $script = [
            'js/admin/detailBill.js'
        ];
        return view('admin.bill.list',compact(
            'title',
            'bills',
            'numberPage',
            'script'
        ));
    }
    public function detailBill(Request $request){
        $id = $request->input('id');
        $bills = $this->bill->getOneBill($id);
        
        $data = [
            'bills'=>$bills
        ];
        return response()->json($data);
    }
}
