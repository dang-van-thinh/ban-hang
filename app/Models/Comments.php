<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $fillable=[
        'id_user',
        'id_product',
        'description'
    ];
    public function store($comment){
        return Comments::create($comment);
    }
    public function index($idProduct){
        return Comments::join('users','users.id','=','comments.id_user')
        ->where('id_product','=',$idProduct)
        ->select('comments.description','comments.created_at',
        'users.name')
        ->get();
    }
}
