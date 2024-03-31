@extends('client.layout.main')
@section('content')
    <div class="container ">
        <div class="row mt-4">
            <div class="col-3 ">
                <div class="bg-body-secondary">
                    <ul class="nav flex-column nav_profile">
                        <li class="nav-item">
                          <a class="" href="#">Thông tin người dùng</a>
                        </li>
                        <li class="nav-item">
                          <a class="" href="#">Địa chỉ</a>
                        </li>
                        <li class="nav-item">
                          <a class="" href="#">Đơn hàng</a>
                        </li>
                        <li class="nav-item">
                          <a class=" " href="#">Cài đặt tài khoản</a>
                        </li>
                        <li class="nav-item">
                            <a class=" " href="{{route('logout')}}">Đăng xuất</a>
                          </li>
                      </ul>
                </div>
            </div>
            <div class="col-9 border rounded ">
                @yield('profile')
            </div>
        </div>
    </div>
@endsection