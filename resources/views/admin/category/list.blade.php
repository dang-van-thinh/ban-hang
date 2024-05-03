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
                    <td>{{ $category_count->countProduct($item->id) }}</td>
                    <td>
                        <a href="{{route('admin.category.delete',$item->id)}}" class="btn btn-danger">Xóa</a>
                        <a href="{{route('admin.category.edit',$item->id)}}" class="btn btn-warning">Sửa</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            @for ($i = 1; $i <= $numberPage; $i++)
                <li class="page-item"><a class="page-link"
                     href="{{ route('admin.category.index',$i) }}"> {{ $i }} </a></li>
            @endfor
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav> --}}
    {{ $category->links()}}
@endsection
