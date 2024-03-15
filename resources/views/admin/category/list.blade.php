@extends('admin.layout.main')
@section('content')
    <h4></h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="40px">STT</th>
                <th>Tên danh mục</th>
                <th width="200px">Số lượng sản phẩm</th>
                <th width="200px">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($category as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $category_count->countProductWithCategory($item->id) }}</td>
                    <td>
                        <a href="{{route('admin.category.delete',$item->id)}}" class="btn btn-danger">Xóa</a>
                        <a href="{{route('admin.category.edit',$item->id)}}" class="btn btn-warning">Sửa</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
