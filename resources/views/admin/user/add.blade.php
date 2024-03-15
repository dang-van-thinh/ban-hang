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
    <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mt-3">
                    <label for="name" class="form-label fw-bold">Tên người dùng</label>
                    <input type="text" name="name" id="name" placeholder="Nhập tên người dùng"
                        class="form-control" value="{{ old('name') }}">
                </div>
                <div class="mt-3">
                    <label for="email" class="form-label fw-bold">Email</label>
                    <input type="email" name="email" id="email" placeholder="Nhập email"
                        class="form-control" value="{{ old('email') }}">
                </div>
                <div class="mt-3">
                    <label for="password" class="form-label fw-bold">Mật khẩu</label>
                    <input type="password" name="password" id="passworld"
                        placeholder="Nhập mật khẩu" class="form-control" 
                        value="{{ old('password') }}">
                </div>
                <div class="mt-3">
                    <label for="role" class="form-label fw-bold">Vai trò</label>
                    <select name="role" id="role" class="form-select">
                        @foreach ($role as $item)    
                            <option value="{{$item->id}}" class="">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            {{-- <div class="col-md-6">
                <div class="mt-3">
                    <label for="category">Danh mục sản phẩm</label>
                    <select name="category_id" id="category" class="form-select" value="{{ old('category_id') }}">
                        <option value="">[Chọn danh mục sản phẩm]</option>
                        @foreach ($category as $item)
                            <option {{ old('category_id') == $item->id ? 'selected' : '' }} value="{{ $item->id }}">
                                {{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-3">
                    <label for="img" class="form-label fw-bold">Ảnh sản phẩm</label>
                    <input type="file" name="img" id="img" class="">
                </div>
                <div class="mt-3">
                    <label for="description">Mô tả sản phẩm</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control"
                        placeholder="Nhập mô tả cho sản phẩm">{{ old('description') }}</textarea>
                </div>
            </div> --}}
            <div class="mt-3">
                <input type="submit" value="Thêm mới" class="btn btn-success">
            </div>
        </div>
    </form>
@endsection
