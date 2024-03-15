<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    @include('client.layout.style')

</head>

<body>
    <header class="">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <div class="navbar-brand nav_custom">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('img/custom/log0-4.png') }}" alt="">
                    </a>
                </div>
                {{-- <a class="" href="#">Navbar</a> --}}
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 fw-medium">
                        <li class="nav-item me-3">
                            <a class="nav-link" aria-current="page" href="{{ route('home') }}">Trang chủ</a>
                        </li>

                        @foreach ($category as $item)
                            <li class="nav-item dropdown me-2">
                                <a class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ $item->name }}
                                </a>
                                <ul class="dropdown-menu">
                                    @foreach ($categoryChill->getCategoryChill($item->id) as $items)
                                        <li class="">
                                            <a class="dropdown-item" href="{{route('client.product',$items->id)}}">{{$items->name}}</a>
                                        </li>
                                    @endforeach

                                </ul>
                            </li>
                        @endforeach

                    </ul>
                    <div class="d-flex">
                        <form class="me-3" role="search">
                            <div class="input-group">
                                <input class="form-control fw-medium" type="search" placeholder="Tìm kiếm"
                                    aria-label="Search">
                                <button class="btn btn-outline-primary" type="submit"><i
                                        class="fas fa-search"></i></button>
                            </div>

                        </form>
                        <div class="d-flex">
                            <ul class="nav me-5 ">
                                <li class="nav-item dropdown me-4 w-25 dropdow_custom">
                                    <a class="nav-link dropdown-toggle text-secondary" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-user"></i>
                                    </a>
                                    @if ($checkLogin)
                                        {{-- logined --}}
                                        <ul class="dropdown-menu me-5 ">
                                            <li><a class="dropdown-item" href="#">Đăng nhập</a></li>
                                            <li><a class="dropdown-item" href="#">Đăng ký</a></li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                                        </ul>
                                    @else
                                        <div class="dropdown-menu me-5 dropdown_item_custom" id="form-login">
                                            <form action="{{ route('login') }}" method="POST"
                                                class="p-4 bg-body-secondary form_login">
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
                                                <h5 class="text-center mb-4">Đăng nhập</h5>
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Email</label>
                                                    <input type="text" name="email" id="name"
                                                        placeholder="Nhập email" class="form-control"
                                                        value="{{ old('email') }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="pw" class="form-label">Mật khẩu</label>
                                                    <input type="password" name="pw" id="pw"
                                                        placeholder="Nhập mật khẩu" class="form-control"
                                                        value="{{ old('pw') }}">
                                                </div>
                                                <div class="mb-3">
                                                    <div class="group-input">
                                                        <input type="checkbox" name="">Nhớ mật khẩu của tôi
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <a id="not_account" href="#">Chưa có tài khoản ?</a>
                                                </div>
                                                <div class="mt-5 text-center">
                                                    <input type="submit" value="Đăng nhập" class="btn btn-info w-50">
                                                </div>
                                            </form>
                                        </div>
                                        {{-- register --}}
                                        <div class="dropdown-menu me-5 dropdown_item_custom" id="form-register">
                                            <form action="{{ route('register') }}" method="POST"
                                                class=" mx-auto border p-4 bg-body-secondary form_login">
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
                                                <h5 class="text-center mb-4">Đăng ký</h5>
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Tên người
                                                        dùng</label>
                                                    <input type="text" name="name" id="name"
                                                        placeholder="Nhập tên" class="form-control"
                                                        value="{{ old('name') }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Email</label>
                                                    <input type="text" name="email" id="name"
                                                        placeholder="Nhập email" class="form-control"
                                                        value="{{ old('email') }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="pw" class="form-label">Mật khẩu</label>
                                                    <input type="password" name="pw" id="pw"
                                                        placeholder="Nhập mật khẩu" class="form-control"
                                                        value="{{ old('pw') }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="rpw" class="form-label">Nhập lại mật
                                                        khẩu</label>
                                                    <input type="password" name="rpw" id="rpw"
                                                        placeholder="Nhập lại mật khẩu" class="form-control"
                                                        value="">
                                                </div>
                                                <div class="mb-3">
                                                    <a href="#" id="had_account">Đã có tài khoản ?</a>
                                                </div>
                                                <div class="mt-5 text-center">
                                                    <input type="submit" value="Đăng ký" class="btn btn-info w-50">
                                                </div>
                                            </form>
                                        </div>
                                    @endif


                                </li>
                                <li class="nav-item ">
                                    <a href="" class="nav-link text-secondary position-relative">
                                        <i class="fas fa-shopping-cart">
                                            <span
                                                class="position-absolute top-0 start-75 translate-middle badge rounded-pill bg-danger">
                                                1
                                            </span>
                                        </i>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div class="container-fluid">
        <article>
            @yield('content')
        </article>
    </div>

    <footer class="mt-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-4 col-4">
                    <h4 class="text-uppercase fs-5 fw-bold">thông tin liên hệ</h4>
                    <ul class="nav flex-column mt-5">
                        <li class="nav-item">
                            <p>
                                <span class="me-2"><i class="fas fa-map-marker-alt"></i></span>
                                123 Street, Old Trafford, NewYork, USA
                            </p>
                        </li>
                        <li class="nav-item">
                            <p>
                                <span class="me-2"><i class="fas fa-envelope"></i></span>
                                sport@gmail.com
                            </p>
                        </li>
                        <li class="nav-item">
                            <p>
                                <span class="me-2"><i class="fas fa-phone-alt"></i></span>
                                1900456789
                            </p>
                        </li>
                        <li class="nav-item">
                            <div class="d-flex social_icon">
                                <img src="{{ asset('img/custom/fblogo.png') }}" alt="" class="me-2">
                                <img src="{{ asset('img/custom/instalogo.png') }}" alt="" class="me-2">
                                <img src="{{ asset('img/custom/tiktoklogo.png') }}" alt="" class="me-2">
                                <img src="{{ asset('img/custom/twlogo - Copy.png') }}" alt=""
                                    class="me-2">
                                <img src="{{ asset('img/custom/gmaillogo - Copy.png') }}" alt=""
                                    class="me-2">
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-2 col-2">
                    <h4 class="text-uppercase fs-5 fw-bold">menu</h4>
                    <ul class="nav flex-column mt-5">
                        <li class=" nav-link">
                            <a href="" class="text-light fw-bold text-uppercase">Trang chủ</a>
                        </li>
                        <li class="nav-item">
                            <a href="">ytrang ch</a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-2 col-2">
                    <h4 class="text-uppercase fs-5 fw-bold">dịch vụ</h4>
                    <nav class="nav flex-column mt-5">
                        <li class="nav-item">
                            Miễn phí giao hàng
                        </li>
                        <li class="nav-item">
                            chính sách hoàn tiền
                        </li>
                        <li class="nav-item">
                            Hỗ trợ 24/7
                        </li>
                        <li class="nav-item">
                            Bảo mật thanh toán
                        </li>
                    </nav>
                </div>
                <div class="col-lg-4 col-4">
                    <h4 class="text-uppercase fs-5 fw-bold">Nhập email để nhận nhiều ưu đãi</h4>
                    <div class="mt-5">
                        <p>Nếu bạn muốn nhận email từ chúng tôi mỗi khi chúng tôi
                            có ưu đãi đặc biệt mới, hãy đăng ký tại đây!</p>
                        <form action="" class="input-group">
                            <input type="text" class="form-control" placeholder="Nhập email tại đây">
                            <button type="submit" class="btn btn-outline-danger"><i
                                    class="fas fa-envelope-open-text"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
@include('client.layout.script')

</html>
