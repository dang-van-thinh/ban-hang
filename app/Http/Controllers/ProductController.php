<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProductVariant;
use App\Models\Quanity;
use App\Reponsitories\ProductReponsitory;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Reponsitories\AttributeReponsitory;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    protected $product;
    protected $datetime;
    protected $timezone;
    protected $category;
    protected $productReponsitory;
    protected $attReponsitory;
    protected $productVariant;
    protected $quanity;
    public function __construct(
        ProductReponsitory $productReponsitory,
        AttributeReponsitory $attributeReponsitory
    ) {
        $this->productReponsitory = $productReponsitory;
        $this->attReponsitory = $attributeReponsitory;
        $this->product = new Product();
        $this->category = new Category();
        $this->datetime = new DateTime();
        $this->timezone = new DateTimeZone('Asia/Ho_Chi_minh');
        $this->productVariant = new ProductVariant();
        $this->quanity = new Quanity();
    }
    

    public function index()
    {
        $title = 'Danh sách sản phẩm';
        $product =  $this->productReponsitory->getAllProduct(0);
        return view('admin.product.list', compact([
            'title',
            'product',
        ]));
    }
    public function create()
    {
        $category = $this->category->getAllCategory();
        $color = $this->attReponsitory->getAllColor();
        $size = $this->attReponsitory->getAllSize();
        $title = 'Thêm sản phẩm';
        $script = [
            'js/admin/product/add.js'
        ];
        return view('admin.product.add', compact([
            'title',
            'category',
            'color',
            'size',
            'script'
        ]));
    }
    public function store(ProductRequest $request)
    {

        // dd($request->all());
        if ($request->has('img')) {
            $file = $request->file('img');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $path = 'public/upload/';
            $file->move($path, $fileName);
            $filePath = $path . $fileName;
        }

        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'price_sale' => $request->price_sale,
            'img' => $filePath,
            'description' => $request->description,
            'rating' => 0,
            'category_id' => $request->category_id,
            'created_at' => $this->datetime->setTimezone($this->timezone),
        ];
        $pros = $this->productReponsitory->addProducts($data);
        //    dd($request->all());
        //  dd(count($request->quanity));
        //  die;
        $quanity_data = [];
        $productVariantData = [];
        for ($i = 0; $i < count($request->quanity); $i++) {
            $quanity_data[] = [
                'product_id' => $pros->id,
                'quanity_pr' => $request->quanity[$i],
                'id_color' => $request->color[$i],
                'id_size' => $request->size[$i]
            ];
            $productVariantData[] = [
                'product_id' => $pros->id,
                'color_id' => $request->color[$i],
                'size_id' => $request->size[$i]
            ];
        }

        $this->quanity->addQuanity($quanity_data);

        $this->productVariant->addProductVariant($productVariantData);


        if ($pros) {

            return redirect()->route('admin.product.create')->with('success', 'Thêm thành công sản phẩm !');
        }
        return redirect()->route('admin.product.create')->with('errors', 'Không thành công');
    }
    public function delete($id)
    {
        if ($this->productReponsitory->delProducts($id)) {  
            // File::exists(''); xây dưng chức năng xóa ảnh sau khi xóa sản phẩm
            return redirect()->route('admin.product.index')->with('success', 'Xóa thành công sản phẩm !');
        }
    }
    public function edit($id)
    {
        $color = $this->attReponsitory->getAllColor();
        $size = $this->attReponsitory->getAllSize();
        $category = $this->category->getAllCategory();
        $products = $this->productReponsitory->getOneProduct($id);
        // $pr_variant = $this->productVariant->getOneProductVariant($id);
        $number_variant = count($products);
        // dd($products);
        // die;
        $title = 'Chỉnh sửa sản phẩm';
        return view('admin.product.edit', compact([
            'products',
            'title',
            'category',
            'color',
            'size',
            'number_variant'
        ]));
    }
    public function update(ProductRequest $request, $id)
    {
        $request->flash();
        if ($request->hasFile('img2')) { // kiểm tra xem file ảnh này có giá trị tải lên hay không
            $file = $request->file('img2');
            $extension = $file->getClientOriginalExtension();
            $fileName = time() . '.' . $extension;
            $path = 'public/upload/';
            $file->move($path, $fileName);
            $filePath = $path . $fileName;
        } else {
            $filePath = $request->input('img');
        }

        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'price_sale' => $request->price_sale,
            'img' => $filePath,
            'description' => $request->description,
            'rating' => 0,
            'category_id' => $request->category_id,
            'upated_at' => $this->datetime->setTimezone($this->timezone),
        ];
        $pros = $this->productReponsitory->updateProduct($id,$data);

        // $quanity_data = [];
        // $productVariantData = [];
        for ($i = 0; $i < count($request->color); $i++) {
            $color = $request->color[$i];
            $size = $request->size[$i];
            $quanity_data = [
                'product_id' => $id,
                'quanity_pr' => $request->quanity[$i],
                'id_color' => $color,
                'id_size' => $size,
                'updated_at'=>$this->datetime->setTimezone($this->timezone),
            ];
            // dd($this->quanity->getQuanity($id,$color,$size));
            // die;
            if($this->quanity->getQuanity($id,$color,$size)){
                $this->quanity->updateQuanity($id,$color,$size,$quanity_data);
            }else{
                $this->quanity->addQuanity($quanity_data);
            }

            $productVariantData= [
                'product_id' => $id,
                'color_id' => $color,
                'size_id' => $size,
                'updated_at'=>$this->datetime->setTimezone($this->timezone),
            ];
            if($this->productVariant->findOneProductVariant($id,$color,$size)){
                $this->productVariant->updateProductVariant($id,$color,$size,$productVariantData);
            }else{
                $this->productVariant->addProductVariant($productVariantData);
            }
            
        }
        
        

        if ($pros) {
            return redirect()->route('admin.product.index')->with('success', 'Thay đổi thành công sản phẩm !');
        }
        return redirect()->route('admin.product.edit', $id)->with('errors', 'Không thành công');
    }
}
