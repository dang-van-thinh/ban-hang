<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Comments extends Model
{
    use HasFactory;
    protected $table = 'comment';
    protected $fillable = [
        'id_user',
        'id_product',
        'content'
    ];
    public function store($comment)
    {
        return Comments::create($comment);
    }
    public function index($idProduct)
    {
        return Comments::join('users', 'users.id', '=', 'comment.id_user')
            ->where('id_product', '=', $idProduct)
            ->select(
                'comment.content',
                'users.name'
            )
            ->get()
        ;
    }
    public function getAll()
    {
        return Comments::join('users', 'users.id', '=', 'comment.id_user')
            ->join('product', 'product.id', '=', 'comment.id_product')
            ->select(
                'comment.content',
                'comment.id',
                'users.name as userName',
                'product.name as productName'
            )
            ->paginate(10);
    }
}
