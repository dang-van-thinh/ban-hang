@extends('admin.layout.main')
@section('content')
    <h4></h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="40px">STT</th>
                <th>Tên sản phẩm</th>
                <th>Giá sản phẩm</th>
                <th>Ảnh</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($product as $items)
                <tr>
                    <td>{{ $items->id }}</td>
                    <td>{{ $items->name }}</td>
                    <td>{{ $items->price }}</td>
                    <td>
                        <img src="{{ asset($items->img) }}" alt="" width="100px">
                    </td>
                    {{-- <td>{{ $items->}}</td> --}}
                    {{-- @foreach ($items->quanity as $quanity_item)
                        <td>{{ $quanity_item->quanity }}</td>
                    @endforeach --}}
                    <td>
                        <a href="{{ route('admin.product.delete', $items->id) }}" class="btn btn-danger">Xóa</a>
                        <a href="{{ route('admin.product.edit', $items->id) }}" class="btn btn-warning">Sửa</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    {{$product->links()}}

@endsection
