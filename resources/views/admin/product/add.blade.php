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
    <form action="{{route('admin.product.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mt-3">
                    <label for="name" class="form-label fw-bold">Tên sản phẩm</label>
                    <input type="text" name="name" id="name" placeholder="Nhập tên sản phẩm" class="form-control" value="{{old('name')}}">
                </div>
                <div class="mt-3">
                    <label for="price" class="form-label fw-bold">Giá sản phẩm</label>
                    <input type="number" min="1000" name="price" id="price" placeholder="Nhập giá sản phẩm" class="form-control" value="{{old('price')}}">
                </div>
                <div class="mt-3">
                    <label for="price_sale" class="form-label fw-bold">Giá khuyến mãi </label>
                    <input type="number" min="0" name="price_sale" id="price_sale" placeholder="Nhập giá khuyến mãi sản phẩm" class="form-control" value="{{old('price_sale')}}">
                </div>
                <div class="mt-3">
                    <label for="quanity" class="form-label fw-bold">Số lượng sản phẩm</label>
                    <input type="number" min="1" name="quanity" id="quanity" placeholder="Nhập số lượng sản phẩm" class="form-control" value="{{old('quanity')}}">
                </div>
                <div class="mt-3">
                    <label for="quanity" class="form-label fw-bold">Size sản phẩm</label>
                    <input type="number" min="1" name="quanity" id="quanity" placeholder="Nhập số lượng sản phẩm" class="form-control" value="{{old('quanity')}}">
                </div>
                <div class="mt-3">
                    <label for="quanity" class="form-label fw-bold">Màu sản phẩm</label>
                    <input type="number" min="1" name="quanity" id="quanity" placeholder="Nhập số lượng sản phẩm" class="form-control" value="{{old('quanity')}}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mt-3">
                    <label for="category">Danh mục sản phẩm</label>
                    <select name="category_id" id="category" class="form-select" value="{{old('category_id')}}">
                        <option value="">[Chọn danh mục sản phẩm]</option>
                        @foreach ($category as $item)
                        <option {{old('category_id') == $item->id ? 'selected':''}} value="{{ $item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-3">
                    <label for="img" class="form-label fw-bold">Ảnh sản phẩm</label>
                    <input type="file" name="img" id="img" class="">
                </div>
                <div class="mt-3">
                    <label for="description">Mô tả sản phẩm</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control" placeholder="Nhập mô tả cho sản phẩm">{{old('description')}}</textarea>
                </div>
            </div>
            <div class="mt-3">
                <input type="submit" value="Thêm mới" class="btn btn-success">
            </div>
        </div>
    </form>
@endsection