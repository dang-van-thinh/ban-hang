@extends('admin.layout.main')
@section('content')
    <h4></h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="40px">STT</th>
                <th>Tên người dùng</th>
                <th>Email</th>
                <th>Chức năng</th>
                <th>Ngày thay đổi</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->role->name }}</td>
                    <td>{{ $item->updated_at != '' ? $item->updated_at:$item->created_at }}</td>
                    <td>
                        <a href="{{route('admin.user.delete',$item->id )}}" class="btn btn-danger" 
                            onclick="return confirm('Bạn có chắc muốn xóa người dùng này ?')">Xóa</a>
                        <a href="{{route('admin.user.edit',$item->id)}}" class="btn btn-warning">Sửa</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
