<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Districts;
use App\Models\Product;
use App\Models\Quanity;
use App\Models\Wards;
use App\Reponsitories\ProductReponsitory;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    protected $quanity;
    protected $districts;
    protected $wards;
    protected $productReponsitories;
    public function __construct()
    {
        $this->wards = new Wards();
        $this->districts = new Districts();
        $this->quanity = new Quanity();
        $this->productReponsitories = new ProductReponsitory();
    }
    //
    public function quanityForColorAndSize(Request $request)
    {
        $id = $request->input('idProduct');
        $id_color = $request->input('idColor');
        $id_size = $request->input('idSize');
        // dd($request);
        // die;
        $quanity = $this->quanity->getQuanityForColorAndSize($id, $id_color, $id_size);
        // $data = Quanity::get();
        // dd($data);
        // die;
        // dd($quanity);
        // die;
        $data = [
            // 'status'=> true,
            'message' => 'Success',
            'quanity' => $quanity
        ];
        return response()->json($data);
        // return $data;
    }
    public function findDistrictsForProvince(Request $request){
        $province_id = $request->input('province_id');
        $districts = $this->districts->findDistrictsForProvince($province_id);
        $data = [
            'districts'=> $districts
        ];
        return response()->json($data);
    }
    public function findWardsForDistrict(Request $request){
        $district_id = $request->input('district_id');
        $wards = $this->wards->findDistrictsForProvince($district_id);
        $data = [
            'wards'=> $wards
        ];
        return response()->json($data);
    }
    public function allProductOffset(Request $request){
        
        $offset = $request->input('offset');
        $limit = $request->input('limit');
        $category = $request->input('category');
        $orderBy = $request->input('orderBy');
        $products = $this->productReponsitories->getAllProduct($offset,$limit,$category,$orderBy);
            // dd($products);
            // die;
            $data = [
                'products'=>$products
            ];
        return response()->json($data);
    }
    public function productFilter(Request $request){
        // dd($request->all());
        
        $color = $request->input('color');
        $size = $request->input('size');
        $price = $request->input('price');
        $orderBy = $request->input('orderby');
        $category = $request->input('category');
        
        $product = $this->productReponsitories->filterProduct($color,$size,$price,$orderBy,$category);
        // dd($product);
        // die;
        $data = [
            'products'=>$product
        ];
        return response()->json($data);
    }


    // function test API 
    // public function testController(){
    //     $data =  Product::all();
    //     return response()->json(['data'=>$data]);
    // }
}
