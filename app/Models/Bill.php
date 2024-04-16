<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'date_time_buy',
        'status',
        'note',
        'total_quanity',
        'pay',
        'address',
        'province_id',
        'district_id',
        'ward_id',
        'phone_number',
        'email',
        'name',
        'created_at',

    ];
    protected $table = 'bill';

    public function addBill($data){
        return Bill::create($data);
    }
    public function allBill($offset,$limit){
        return Bill::offset($offset)->limit($limit)->orderBy('id','desc')->get();
    }
    public function countBill(){
        return Bill::count();
    }
    public function getOneBill($id){
        return Bill::join('detail_bill as db','db.bill_id','bill.id')
        ->join('product as pr','pr.id','db.product_id')
        ->join('provinces as p','p.code','bill.province_id')
        ->join('districts as d','d.code','bill.district_id')
        ->join('wards as w','w.code','bill.ward_id')
        ->join('color','color.id','db.color_id')
        ->join('size','size.id','db.size_id')
        ->where('bill.id','=',$id)
        ->select('bill.id as bill_id','bill.status','bill.address','db.quanity_buy as quanity_buy',
        'bill.name as name','bill.email','bill.phone_number',
        'p.name as province_name','d.name as district_name','w.name as ward_name',
        'pr.name as product_name','pr.price as price','pr.img as img',
        'color.name as color_name','size.name as size_name')
        ->get();
    }
    public function BillByUser($idUser){
        return Bill::join('provinces as p','p.code','bill.province_id')
        ->join('districts as d','d.code','bill.district_id')
        ->join('wards as w','w.code','bill.ward_id')
        ->select('bill.id','bill.name','bill.pay','bill.phone_number','bill.email','bill.date_time_buy','bill.address','bill.status',
        'd.name as districtName','w.name as wardName','p.name as provinceName')
        ->where('bill.user_id','=',$idUser)
        ->get();
    }
    public function updateStatusBill($idBill,$status){
        return Bill::find($idBill)
        ->update(['status'=>$status]);
    }
}
