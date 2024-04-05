@extends('client.layout.main')
@section('content')
<div class="container mt-4 ">
        <form action="{{route('forgot')}}" method="POST" class="p-4 bg-body-secondary form_login mx-auto" style="width: 600px" >
            @csrf
            <h5 class="text-center mb-4 fw-bold">Quên mật khẩu</h5>
            <div class="mb-3">
                <label for="email" class="form-label fw-medium">Email</label>
                <input type="text" name="email" id="email" placeholder="Nhập email" class="form-control"
                    value="{{ old('email') }}">
                @if ($errors->has('email'))
                    <i class="badge text-danger">
                        *{{ $errors->first('email') }}
                    </i>
                @endif
            </div>
            <div>
                <ul class="text-secondary">
                    <li>Nhập email bạn đã đăng ký tại ThinhSport</li>
                    <li>Chúng tôi sẽ gửi mã về email mà bạn đã đăng ký</li>
                </ul>
            </div>
            <div class="mt-5 text-center">
                <input type="submit" value="Gửi" class="btn fw-medium btn-info w-50">
            </div>
        </form>
</div>
@endsection