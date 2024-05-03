@extends('admin.layout.main')
@section('content')
    <h4></h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="40px">STT</th>
                <th>Tên người dùng</th>
                <th>Tên sản phẩm</th>
                <th>Nội dung bình luận</th>
                <th>Ngày bình luận</th>
                <th width="200px">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($comments as $item)
                <tr>
                    <td> {{$item->id}} </td>
                    <td> {{$item->userName}} </td>
                    <td> {{$item->productName}} </td>
                    <td> {{$item->description}} </td>
                    <td> {{$item->created_at}} </td>
                    <td>  </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        {{ $comments->links() }}
    </div>
@endsection