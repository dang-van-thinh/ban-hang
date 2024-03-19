<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest;
use App\Models\Color;
use App\Reponsitories\AttributeReponsitory;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    //
    protected $attReponsitory;
    public function __construct()
    {
        $this->attReponsitory = new AttributeReponsitory();
    }
    public function index()
    {
        $title = 'Danh sách thuộc tính';
        $color = $this->attReponsitory->getAllColor();
        $size = $this->attReponsitory->getAllSize();
        return view('admin.attribute.list', compact([
            'title',
            'color',
            'size'
        ]));
    }
    public function create()
    {
        $title = 'Thêm mới giá trị thuộc tính';
        return view('admin.attribute.add', compact([
            'title'
        ]));
    }
    public function store(AttributeRequest $request)
    {
        // dd($request);
        if ($request->input('att') == 'color') {
            $data = [
                'name' => $request->name,
                'value' => $request->input('value')
            ];
            $this->attReponsitory->addColor($data);
        } else {
            $data = [
                'name' => $request->name,
            ];
            $this->attReponsitory->addSize($data);
        }
        return redirect()->route('admin.att.create')->with('success', 'Thêm mới thành công');
    }
    public function editColor($id){
        $title = 'Chỉnh sửa thuộc tính màu';
        $color = $this->attReponsitory->getOneColor($id);
        return view('admin.attribute.color.edit',compact([
            'title',
            'color'
        ]));
    }
    public function editSize($id){
        $title = 'Chỉnh sửa thuộc tính size';
        $size = $this->attReponsitory->getOneSize($id);
        return view('admin.attribute.size.edit',compact([
            'title',
            'size'
        ]));
    }
    public function update(AttributeRequest $request ,$id){
        if ($request->input('att') == 'color') {
            $data = [
                'name' => $request->name,
                'value' => $request->input('value')
            ];
            $this->attReponsitory->updateColor($id,$data);
        } else {
            $data = [
                'name' => $request->name,
            ];
            $this->attReponsitory->updateSize($id,$data);
        }
        return redirect()->route('admin.att.index')->with('success','Cập nhật thành công !');
    }
    public function delColor($id){
        $this->attReponsitory->deleteColor($id);
        return redirect()->route('admin.att.index')->with('success','Xóa thành công !');
    }
    public function delSize($id){
        $this->attReponsitory->deleteSize($id);
        return redirect()->route('admin.att.index')->with('success','Xóa thành công !');
    }
}
