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
        'role_id',
        'created_at',
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
       return Users::with('role')->get();
       // lấy dữ liệu từ 2 bảng role và user 
    }
    public function role(){ 
        // tạo liên kết với bảng role để lấy ra tên role tương ứng
        return $this->belongsTo(Role::class);
    }
    public function addUser($data)
    {
        return Users::insert($data);
    }
    public function delUser($id)
    {
        return Users::where('id', $id)->delete();
    }
    public function getOneUser($id)
    {
        return User::where('id', $id)->first();
    }
    public function updateUser($id, $data)
    {
        return User::where('id', $id)->update($data);
    }
}
