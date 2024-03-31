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
    <form action="{{ route('admin.user.update',$user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mt-3">
                    <label for="name" class="form-label fw-bold">Tên người dùng</label>
                    <input type="text" name="name" id="name" placeholder="Nhập tên người dùng"
                        class="form-control" value="{{ old('name',$user->name) }}">
                </div>
                <div class="mt-3">
                    <label for="email" class="form-label fw-bold">Email</label>
                    <input type="email" name="email" id="email" placeholder="Nhập email"
                        class="form-control" value="{{ old('email',$user->email) }}">
                </div>
                <div class="mt-3">
                    <label for="phone_number" class="form-label fw-bold">Số điện thoại</label>
                    <input type="tel" name="phone_number" id="phone_number" placeholder="Nhập số điện thoại"
                        class="form-control" value="{{ old('phone_number',$user->phone_number) }}">
                </div>
                <div class="mt-3">
                    <label for="role" class="form-label fw-bold">Vai trò</label>
                    <select name="role" id="role" class="form-select">
                        @foreach ($role as $item)    
                            <option {{$item->id == $user->role_id ?'selected':''}} value="{{$item->id}}" class="">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mt-3 input-group">
                <a href="{{route('admin.user.index')}}" class="btn btn-primary"> Quay lại</a>
                <input type="submit" value="Lưu" class="btn btn-success px-5">
            </div>
        </div>
    </form>
@endsection
