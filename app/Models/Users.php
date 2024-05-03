<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Users extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'role_id',
        'created_at',
        'province_id',
        'district_id',
        'ward_id',
        'address'
    ];
    public static function hashRole($role)
    {
        //    $user =  DB::table('role')->where('id',$role)->first();
        if ($role === 1) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllUser()
    {
       return Users::paginate(10);
       // lấy dữ liệu từ 2 bảng role và user 
    }
    public function countAllUsers(){
        return Users::count();
    }
    public function role(){ 
        // tạo liên kết với bảng role để lấy ra tên role tương ứng
        return $this->belongsTo(Role::class);
    }
    public function addUser($data)
    {
        return Users::create($data);
    }
    public function delUser($id)
    {
        return Users::where('id', $id)->delete();
    }
    public function getOneUser($id)
    {
        return User::where('id', $id)->first();
    }
    public function findUser($email,$phone){
        return User::where('email','like',$email)
        ->orWhere('phone_number','=',$phone)
        ->first();
    }
    public function updateUser($id, $data)
    {
        return User::where('id', $id)->update($data);
    }
    public function getPasswordForEmail($email){
        return Users::where('email','=',$email)->first();
    }
   
}
