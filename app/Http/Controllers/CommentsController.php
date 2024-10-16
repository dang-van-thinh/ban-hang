<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comments;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    //
    protected $comments;
    public function __construct()
    {
        $this->comments = new Comments();
    }
    public function index()
    {
        $title = 'Danh sách bình luận';
        $comments = $this->comments->getAll();
        return view('admin.comment.list', compact(
            'title',
            'comments'
        ));
    }

    public function store(Request $request)
    {
        $data = [
            'id_user' => $request->input('id_user'),
            'id_product' => $request->input('id_product'),
            'content' => $request->input('content')
        ];
        $this->comments->store($data);
    }
}
