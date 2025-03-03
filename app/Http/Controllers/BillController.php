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
    public function index(){
        $title = 'Danh sách hóa đơn';
        // $curentPage = 1;
        // if($page > 0){
        //     $curentPage = $page;
        // }
        //  // trang hiện tại
        // $limit = 12; // số lượng sản phẩm có trong 1 trang
        // $perPage = $curentPage - 1;
        // $offset = intval($perPage * $limit);
        // $count = $this->bill->countBill();
        // $numberPage = ceil($count / $limit);
        $bills = $this->bill->allBill();
        $script = [
            'js/admin/detailBill.js',
            'js/admin/listBill.js',
        ];
        return view('admin.bill.list',compact(
            'title',
            'bills',
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
    public function updateStatusBill(Request $request){
        $idBill = $request->input('idBill');
        $status = $request->input('status');
        $this->bill->updateStatusBill($idBill,$status);
        $data = [
            'status'=>200,
            'message'=>'Success'
        ];
        return response()->json($data);
    }
}
