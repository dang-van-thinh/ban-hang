<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    protected $category;
    protected $product;
    public function __construct()
    {
        $this->category = new Category();
        $this->product =  new Product();
    }
    public function index()
    {
        $title = 'Danh sách danh mục sản phẩm';
        $category = $this->category->getAllCategory();
        $category_count = $this->product;
        return view('admin.category.list', compact([
            'title',
            'category',
            'category_count'
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
