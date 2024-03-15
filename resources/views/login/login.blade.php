@extends('login.layout.main')
@section('content')
    <form action="{{ route('login') }}" method="POST" class="w-25 mx-auto border p-4 bg-body-secondary form_login">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Email</label>
            <input type="text" name="email" id="name" placeholder="Nhập email" class="form-control"
                value="{{ old('email') }}">
        </div>
        <div class="mb-3">
            <label for="pw" class="form-label">Mật khẩu</label>
            <input type="password" name="pw" id="pw" placeholder="Nhập mật khẩu" class="form-control"
                value="{{ old('pw') }}">
        </div>
        <div class="mb-3">
            <div class="group-input">
                <input type="checkbox" name="">Nhớ mật khẩu của tôi
            </div>
        </div>
        <div class="mb-3">
            <a href="{{route('signup')}}">Chưa có tài khoản ?</a>
        </div>
        <div class="mt-5 text-center">
            <input type="submit" value="Đăng nhập" class="btn btn-info w-50">
        </div>
    </form>
@endsection
