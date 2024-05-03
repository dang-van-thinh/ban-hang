<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\Role;
use App\Models\Users;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Psy\CodeCleaner\AssignThisVariablePass;

class UserController extends Controller
{
    protected $user;
    protected $dateTime;
    protected $timeZone;
    protected $role;
    public function __construct(){
        $this->user = new Users();
        $this->role = new Role();
        $this->dateTime = new DateTime();
        $this->timeZone = new DateTimeZone('Asia/Ho_Chi_Minh');
    }
    //
    public function index(){
        $title = 'Danh sách người dùng';
        //phân trang
        // $curentPage = 1;
        // if($page > 0){
        //     $curentPage = $page;
        // }
        //  // trang hiện tại
        // $limit = 10; // số lượng sản phẩm có trong 1 trang
        // $perPage = $curentPage - 1;
        // $offset = intval($perPage * $limit);
        // $count = $this->user->countAllUsers();
        // $numberPage = ceil($count / $limit);
        $users = $this->user->getAllUser();
        return view('admin.user.list',compact([
            'title',
            'users',
        ]));
    }
    public function create(){
        $title = 'Thêm mới người dùng';
        $role = $this->role->getAllRole();
        return view('admin.user.add',compact([
            'title',
            'role'
        ]));
    }
    public function store(UserRequest $request){
        $request->flash();
        $data = [
            'name'=>$request->name,
            'email'=>$request->email,
            'phone_number'=>$request->phone_number,
            'password'=>Hash::make($request->password),
            'role_id'=>$request->input('role'),
            'created_at'=>$this->dateTime->setTimezone($this->timeZone),
        ];
        if($this->user->addUser($data)){
            return redirect()->route('admin.user.create')->with('success','Thêm thành công !');
        }
        return redirect()->route('admin.user.create')->with('error','Thêm không thành công !');
    }
    public function delete($id){
        $this->user->delUser($id);
        return redirect()->route('admin.user.index')->with('success','Xóa thành công !');
    }
    public function edit($id){
        $title = 'Chỉnh sửa thông tin người dùng';
        $role = $this->role->getAllRole();
        $user = $this->user->getOneUser($id);
        return view('admin.user.edit',compact([
            'title',
            'user',
            'role'
        ]));
    }
    public function update(UserRequest $request ,int $id){
        $request->flash();
        $data = [
            'name'=>$request->name,
            'email'=>$request->email,
            'phone_number'=>$request->phone_number,
            'role_id'=>$request->input('role'),
            'updated_at'=> $this->dateTime->setTimezone($this->timeZone),
        ];

        if($this->user->updateUser($id,$data)){
            return redirect()->route('admin.user.edit',$id)->with('success','Thay dổi thành công !');
        }
        return redirect()->route('admin.user.edit',$id)->with('error','Thay đổi không thành công !');
    }
}
