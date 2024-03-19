<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Product;
use App\Reponsitories\ProductReponsitory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    protected $category;
    protected $product;
    protected $productReponsitory;
    public function __construct(ProductReponsitory $productReponsitory)
    {
        $this->category = new Category();
        $this->product =  new Product();
        $this->productReponsitory = $productReponsitory;
    }
    public function index($page=0)
    {
        $title = 'Danh sách danh mục sản phẩm';
        
        //phân trang
        $curentPage = 1;
        if($page > 0){
            $curentPage = $page;
        }
         // trang hiện tại
        $limit = 10; // số lượng sản phẩm có trong 1 trang
        $perPage = $curentPage - 1;
        $offset = intval($perPage * $limit);
        $count = $this->category->countAllCategory();
        $numberPage = ceil($count / $limit);
        $category = $this->category->getAllCategory($offset,$limit);
        $category_count = $this->productReponsitory;
        return view('admin.category.list', compact([
            'title',
            'category',
            'category_count',
            'numberPage'
        ]));
    }
    public function create()
    {
        $title = 'Thêm mới danh mục';
        $category = $this->category->getCategoryParent();
        return view('admin.category.add', compact([
            'title',
            'category'
        ]));
    }
    public function store(CategoryRequest $request)
    {
        $request->flash();
        $data = [
            'name' => $request->name,
            'type' => $request->input('type')
        ];
        if ($this->category->addCategory($data)) {
            return redirect()->route('admin.category.create')->with('success', 'Thêm danh mục sản phẩm thành công !');
        } else {
            return redirect()->route('admin.category.create')->with('error', 'Thêm danh mục sản phẩm thất bại !');
        }
    }
    public function delete($id)
    {
        $this->category->delCategory($id);
        return redirect()->route('admin.category.index')->with('success', 'Xóa thành công sản phẩm');
    }
    public function edit($id)
    {
        $title = 'Thay đổi danh mục';
        $category = $this->category->getCategoryEdit($id);
        $cate = $this->category->getOneCategory($id);
        return view('admin.category.edit', compact([
            'title',
            'category',
            'cate'
        ]));
    }
    public function update(CategoryRequest $request, $id)
    {
        $request->flash();
        $data = [
            'name' => $request->name,
            'type' => $request->input('type')
        ];
        if ($this->category->updateCategory($id, $data)) {
            return redirect()->route('admin.category.edit', $id)->with('success', 'Thêm danh mục sản phẩm thành công !');
        } else {
            return redirect()->route('admin.category.edit', $id)->with('error', 'Thêm danh mục sản phẩm thất bại !');
        }
    }
}
