@extends('admin.layout.main')
@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.category.update', $cate->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mt-3">
                    <label for="name" class="form-label fw-bold">Tên danh mục sản phẩm</label>
                    <input type="text" name="name" id="name" placeholder="Nhập tên danh mục sản phẩm"
                        class="form-control" value="{{ old('name', $cate->name) }}">
                </div>
                <div class="mt-3">
                    <label for="type" class="form-label fw-bold">Danh mục thuộc loại nào :</label>
                    <select name="type" id="type" class="form-select">
                        <option value="0">Không</option>
                        @foreach ($category as $item)
                            <option {{ $cate->type == $item->id ? 'selected' : '' }} value="{{ $item->id }}">
                                {{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>

            </div>
            <div class="mt-3 input-group">
                <a href="{{route('admin.category.index')}}" class="btn btn-primary">Quay lại</a>
                <input type="submit" value="Thêm mới" class="btn btn-success">
            </div>
        </div>
    </form>
@endsection
