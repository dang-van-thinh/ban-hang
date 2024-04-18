@extends('client.page.profiles.layout')
@section('profile')
    <div class="mt-3 container">
        <div>
            <div class="mb-3">
                <h5 class="mb-3 text-uppercase">Hồ sơ của tôi</h5>
                <div class="row">
                    <div class="col-10">
                        <form action="" method="post">
                            <input type="hidden" id="user_old" 
                            data-name="{{$user->name}}"
                            data-email="{{$user->email}}"
                            data-phone="{{$user->phone_number}}"
                            >
                            <div class="input-group mb-3">
                                <label for="" class="w-25 input-group-text">Tên</label>
                                <input type="text" name="name" id="name" class="form-control input-item" value="{{ $user->name }}">

                            </div>
                            <div class="input-group mb-3">
                                <label for="" class="w-25 input-group-text">Email</label>
                                <input type="email" name="email" id="email" class="form-control input-item" value="{{ $user->email }}">

                            </div>
                            <div class="input-group mb-3">
                                <label for="" class="w-25 input-group-text">Số điện thoại</label>
                                <input type="tel" name="phone_number" id="phone" class="form-control input-item" value="{{ $user->phone_number }}">
                               <button type="submit" class="btn btn-primary btn_save px-4">Lưu</button>
                               <a href="{{route('profiles.changePassword')}}" class="btn btn-primary px-4" id="changePW">Đổi mật khẩu</a>
                            </div>
                        </form>
                       
                    </div>
                </div>
            </div>
            {{-- <div class="mb-3">
                <h5 class="mb-3 text-uppercase">Địa chỉ giao hàng</h5>
                <div class="w-50">
                    <div class="input-group mb-3">
                        <label for="" class="w-25 input-group-text">Địa chỉ</label>
                        <input type="text" class="form-control input-item">
                    </div>
                    <div class="input-group mb-3">
                        <label for="" class="w-25 input-group-text">Tên Xã</label>
                        <input type="text" class="form-control input-item">
                    </div>
                    <div class="input-group mb-3">
                        <label for="" class="w-25 input-group-text">Tên huyện</label>
                        <input type="text" class="form-control input-item">
                    </div>
                    <div class="input-group mb-3">
                        <label for="" class="w-25 input-group-text">Tỉnh</label>
                        <input type="text" class="form-control input-item">
                    </div>
                </div>
            </div> --}}
            {{-- <div class="mb-3">
                <h5 class="mb-3 text-uppercase">Ngân hàng của tôi</h5>
                <div class="w-50">
                    <div class="input-group mb-3">
                        <label for="" class="w-25 input-group-text">Ngân hàng</label>
                        <input type="text" class="form-control input-item">
                    </div>
                    <div class="input-group mb-3">
                        <label for="" class="w-25 input-group-text">Số thẻ</label>
                        <input type="text" class="form-control input-item">
                    </div>
                    <div class="input-group mb-3">
                        
                    </div>
                </div>
            </div> --}}
            <div class="mb-3">
                <h5 class="mb-3 text-uppercase">xóa tài khoản</h5>
                <div class="w-50">
                    <form action="{{route('profiles.profileDeleteAccount',$user->id)}}" method="post">
                        @csrf
                        <input type="submit" class="btn btn-danger" value="Xóa tài khoản">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
