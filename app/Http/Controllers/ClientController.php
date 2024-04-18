<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\OrderRequest;
use App\Mail\MailRepassed;
use App\Mail\OrderByNotAccount;
use App\Models\Bill;
use App\Models\Category;
use App\Models\Color;
use App\Models\DetailBill;
use App\Models\Districts;
use App\Models\Provinces;
use App\Models\Quanity;
use App\Models\Size;
use App\Models\Users;
use App\Models\Wards;
use App\Reponsitories\ProductReponsitory;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ClientController extends Controller
{
    protected $category;
    protected $datetime;
    protected $timezone;

    protected $provinces;
    protected $users;
    protected $quanities;
    protected $bill;
    protected $detailBill;
    protected $color;
    protected $size;
    protected $districts;
    protected $wards;
    protected $productReponsitory;
    protected $payment;
    public function __construct()
    {
        $this->payment = new PayController();
        $this->quanities = new Quanity();
        $this->bill = new Bill();
        $this->detailBill = new DetailBill();
        $this->users = new Users();
        $this->districts = new Districts();
        $this->wards = new Wards();
        $this->category = new Category();
        $this->color = new Color();
        $this->size = new Size();
        $this->provinces = new Provinces();
        $this->productReponsitory = new ProductReponsitory();
        $this->datetime = new DateTime();
        $this->timezone = new DateTimeZone('Asia/Ho_Chi_minh');
    }
    //
    public function home()
    {
        $title = 'ThinhSport | Cửa hàng thể thao nam';
        $categoryChill = $this->category;
        $productsNew = $this->productReponsitory->getProductsNewLimit();
        $productByView = $this->productReponsitory->getProductByViewLimit();
        $category = $this->category->getCategoryParent();
        // dd($productByView);
        // die;
        return view('client.page.home', compact([
            'title',
            'category',
            'categoryChill',
            'productsNew',
            'productByView',

        ]));
    }
    public function search(Request $request){
        
        $key = $request->input('key');
        $title = "Tìm kiếm : $key ";
        $curentPage = 1;
        $limit = 12;
        $categoryChill = $this->category;
        $category = $this->category->getCategoryParent();
        $product = $this->productReponsitory->getProductBySearch($key);
        $color = $this->color->getAllColor();
        $size = $this->size->getAllSize();
        // dd($product->pluck('id')->toArray());
        // die;
        $numberPage = ceil(count($product)/$limit);

        $priceMax = $this->productReponsitory->getPriceMax(null,$product->pluck('id')->toArray());
        $priceMin = $this->productReponsitory->getPriceMin(null,$product->pluck('id')->toArray());
// dd($priceMax);
// die;
        $products = [
            'products'=>$product,
            'orderBy'=>null,
            'category'=>0,
            'priceMax'=>$priceMax,
            'priceMin'=>$priceMin
        ];
        $script = [
            'js/client/libs/category.js'
        ];
        return view('client.page.category',compact(
            'title',
            'category',
            'categoryChill',
            'products',
            'color',
            'size',
            'numberPage',
            'key',
            'script'
        ));
    }
    public function view()
    {
        $title = 'Sản phẩm có nhiều lượt xem nhất';
        $curentPage = 1;
        $limit = 12;
        $countProduct = $this->productReponsitory->countProduct();
        $numberPage = ceil($countProduct / $limit);
        $product = $this->productReponsitory->getAllProduct($curentPage, $limit, null, 0);
        // dd($products);
        // die;
        $priceMax = $this->productReponsitory->getPriceMax();
        $priceMin = $this->productReponsitory->getPriceMin();

        $products = [
            'products' => $product,
            'orderBy' => 'views',
            'category' => 0,
            'priceMax'=>$priceMax,
            'priceMin'=>$priceMin
        ];
        $script = [
            'js/client/libs/category.js'
        ];
        $color = $this->color->getAllColor();
        $size = $this->size->getAllSize();
        $category = $this->category->getCategoryParent();
        $categoryChill = $this->category;
        return view('client.page.category', compact(
            'title',
            'products',
            'numberPage',
            'color',
            'size',
            'category',
            'categoryChill',
            'script'
        ));
    }
    public function category($id_category = null)
    {
        $limit = 12;
        $currentPage = 1;
        $offset = ($currentPage - 1) * $limit;
        if ($id_category) {
            $product = $this->productReponsitory->getProductWithCategory($id_category, $offset, $limit);
            $priceMax = $this->productReponsitory->getPriceMax($id_category);
            $priceMin = $this->productReponsitory->getPriceMin($id_category);
            $products = [
                'products' => $product,
                'category' => $id_category,
                'orderBy' => null,
                'priceMax' => $priceMax,
                'priceMin' => $priceMin
            ];
            $countProduct = $this->productReponsitory->countProduct($id_category);
        } else {
            $product = $this->productReponsitory->getAllProduct($offset, $limit);
            $priceMax = $this->productReponsitory->getPriceMax();
            $priceMin = $this->productReponsitory->getPriceMin();


            $products = [
                'products' => $product,
                'category' => 0,
                'orderBy' => null,
                'priceMax' => $priceMax,
                'priceMin'=> $priceMin
            ];
            // dd($product);
            // die;
            $countProduct = $this->productReponsitory->countProduct();
        }
        $numberPage = ceil($countProduct / $limit);
        $title = 'Sản phẩm';
        $script = [
            'js/client/libs/category.js'
        ];
        $categoryChill = $this->category;
        $category = $this->category->getCategoryParent();
        $color = $this->color->getAllColor();
        $size = $this->size->getAllSize();

        return view('client.page.category', compact([
            'title',
            'products',
            'color',
            'size',
            'category',
            'categoryChill',
            'numberPage',
            'script'
        ]));
    }
    public function detailProduct($id_product)
    {
        $this->productReponsitory->upToViewForProduct($id_product);
        $title = 'Chi tiết sản phẩm';
        $categoryChill = $this->category;
        $category = $this->category->getCategoryParent();
        $product = $this->productReponsitory->getOneProduct($id_product);
        $getSize = $this->size;
        $getColor = $this->color;
        $script = [
            'js/client/libs/detailProduct.js'
        ];
        
        $categoryProduct = $this->productReponsitory->getProductForCategory($product[0]->category_id, $product[0]->id);
        // dd($categoryProduct);
        // die;
        return view('client.page.detail-product', compact(
            'title',
            'category',
            'categoryChill',
            'product',
            'getSize',
            'getColor',
            'categoryProduct',
            'script'
        ));
    }
    public function cartProduct()
    {
        $title = 'Giỏ hàng';
        $script = [
            'js/client/libs/cart.js'
        ];
        $categoryChill = $this->category;
        $category = $this->category->getCategoryParent();
        return view('client.page.cart', compact(
            'title',
            'category',
            'categoryChill',
            'script'
        ));
    }
    // hiển thị trang order
    public function orderProduct(Request $request)
    {
        $id = $request->input('id');
        $price = $request->input('price');
        
        $size = $request->input('size');
        $color = $request->input('color');
        $quanity = $request->input('quanity');
        $script = [
            'js/client/libs/order.js'
        ];
        // $productBill = [];
        for ($i = 0; $i < count($id); $i++) {
            // dd(str_replace('.','',$price[$i]));
            // die;
            $productBill[] = [
                'product_id' => $id[$i],
                'price_current' => str_replace('.','',$price[$i]),
                'quanity_buy' => $quanity[$i],
                'color_id' => $color[$i],
                'size_id' => $size[$i]
            ];
        }

        // phòng trường hợp tải lại nhiều lần 1 trang 
        // 
        if (Session::has('cart')) {
            Session::forget('cart'); // xóa trước
            Session::put('cart', $productBill); // thêm sau

        } else {
            Session::put('cart', $productBill); // thêm sau
        }
        // dd(
        //     Session::get('cart')
        // );
        // die;
        $title = 'Tiếp tục thanh toán';
        $provinces = $this->provinces->getAll();
        $categoryChill = $this->category;
        $category = $this->category->getCategoryParent();
        $users = '';
        if (Auth::id()) {
            $user = Auth::user();
            $districts = $this->districts->getNameDistrict($user->district_id);
            $wards = $this->wards->getNameWard($user->ward_id);
            $users = [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone_number,
                'address' => $user->address,
                'provinces' => $user->province_id,
                'district_id' => $user->district_id,
                'districts' => $districts,
                'wards' => $wards
            ];
        }
        return view('client.page.order', compact(
            'title',
            'category',
            'categoryChill',
            'provinces',
            'users',
            'script'
        ));
    }
    public function storeOrder(OrderRequest $request)
    {
         
        if (Auth::id()) {
            $bill = [
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone,
                'address' => $request->address,
                'province_id' => $request->provinces,
                'district_id' => $request->districts,
                'ward_id' => $request->wards,
                'pay' => $request->pay,
                'note' => $request->input('note'),
                'total_quanity' => $request->input('total_quanity'),
                'created_at' => $this->datetime->setTimezone($this->timezone),
            ];
        } else {
            // không có tài khoản thì sẽ tạo mới rồi trả ra ID user
            // trường hợp này sẽ tạm lấy số điện thoai lam pw 
            // và gửi email thoonng tin đơn hàng về email , và có mã xác nhận về email đẻ xác thực tài khoản
            // tạo mk ngẫu nhiên và gửi về cho user mới
            $pwRandom = '';
            $pwFomat = '0123456789';
            for ($i = 0; $i < 8; $i++) {
                $pwRandom .= $pwFomat[rand(0, 10 - 1)];
            }
            // dd($pwRandom);
            // die;
            $user = [
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone,
                'role_id' => 2,
                'password' => Hash::make($pwRandom),
                'address' => $request->address,
                'province_id' => $request->provinces,
                'district_id' => $request->districts,
                'ward_id' => $request->wards,
            ];
            $userId = $this->users->addUser($user);
            // nhận lại id tài khoản vừa tạo
            Mail::to($request->email)->send(new OrderByNotAccount($request->email,$pwRandom));
            //gửi pw về email cho user mới
            //tao  bill
            $bill = [
                'user_id' => $userId->id,
                'name' => $request->name,
                'email' => $request->email,
                'phone_number' => $request->phone,
                'address' => $request->address,
                'province_id' => $request->provinces,
                'district_id' => $request->districts,
                'ward_id' => $request->wards,
                'pay' => $request->pay,
                'note' => $request->input('note'),
                'total_quanity' => $request->input('total_quanity'),
                'created_at' => $this->datetime->setTimezone($this->timezone),
            ];

        }

        $idBill = $this->bill->addBill($bill);
        if ($idBill) {
            $bill = Session::get('cart'); // lấy trên session

            // dd($bill);
            // die;

            for ($i = 0; $i < count($bill); $i++) {
                // ép về oject nếu muốn
                // (object) $bill[$i];

                //thực hiện xóa số lượng sản phẩm sau khi mua trong co so du lieu
                $product_id =  $bill[$i]['product_id'];
                $color_id =  $bill[$i]['color_id'];
                $size_id =  $bill[$i]['size_id'];
                //lấy id của bảng quanity và số lượng sản phẩm theo biến thể hiện tại
                $quanityCurrent = $this->quanities->getQuanityForColorAndSize($product_id, $color_id, $size_id);

                $quanity_id = $quanityCurrent->id;
                $quanity = $quanityCurrent->quanity_pr - $bill[$i]['quanity_buy'];
                $check = $this->quanities->updateQuanityAfterAddBill($quanity_id, $quanity);
                // dd($quanity_id);
                //                 die;
                // thêm trường id bill vào detail bill
                $bill[$i]['bill_id'] = $idBill->id;
                $this->detailBill->insert($bill[$i]);
            }
            Session::forget('cart'); // xoa cart
        }
        /// check phuong thuc thanh toan cua don hang
            // neu nhu thanh toan COD thi bo qua
            // thnah toan online thi du laij de thanh toan
            //=1 COD
            //=2 : momo
            if($request->pay == 2){
               return $this->payment->momo($request);
            }
        return redirect()->route('ordered');
    }
    public function orderedProduct()
    {
        $title = 'Thành công';
        $categoryChill = $this->category;
        $category = $this->category->getCategoryParent();
        $scriptCode = "<script> localStorage.removeItem('product'); </script>";
        return view('client.page.ordered', compact(
            'scriptCode',
            'title',
            'categoryChill',
            'category',
        ));
    }


    
    public function forgotPassword($token)
    {
        $title = 'Lấy lại mật khẩu';
        $categoryChill = $this->category;
        $category = $this->category->getCategoryParent();
        return view('client.page.forgot-password', compact(
            'title',
            'category',
            'categoryChill'
        ));
    }
    public function forgot(Request $request)
    {
        $email = $request->input('email');
        // dd($mailer);
        // die;
        $user = $this->users->getPasswordForEmail($email);
        $pass = $user->password;

        Mail::to($email)->send(new MailRepassed($email,$pass));

        return redirect()->route('home')->with('success', 'Thành công !');

        // return redirect()->route('home')->with('error',' Không thành công !');
    }
    // public function testEmail(Request $request){
    //     $email = $request->input('email');
    //     // Mail::to('dangvanthinh372004@gmail.com')->send(new MailRepassed($email,$pass));
    // }









    // test API return
    // public function testApi(){
    //     $urlApi = "http://localhost/Laravel/ban-hang/public/api/test-api";
    //     $data = Http::get($urlApi);
    //     $products = $data->json();
    //     // dd($products);
    //     // die;
    //     return view('client.page.api',compact('products'));
    // }
}
