<header class="">
    <nav class="navbar navbar-expand-lg header_custom">
        <div class="container-fluid">
            <div class="navbar-brand nav_custom">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('img/custom/logo-2.png') }}" alt="">
                </a>
            </div>
            {{-- <a class="" href="#">Navbar</a> --}}
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 fw-medium">
                    <li class="nav-item me-3">
                        <a class="nav-link" aria-current="page" href="{{ route('home') }}">Trang chủ</a>
                    </li>

                    @foreach ($category as $item)
                        <li class="nav-item dropdown me-2">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                {{ $item->name }}
                            </a>
                            <ul class="dropdown-menu">
                                @foreach ($categoryChill->getCategoryChill($item->id) as $items)
                                    <li class="">
                                        <a class="dropdown-item"
                                            href="{{ route('category', $items->id) }}">{{ $items->name }}</a>
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
                                @if (Auth::check())
                                    {{-- logined --}}
                                    <ul class="dropdown-menu me-5 me-n" style="transform: translate(-50px,0)">
                                        <li><a class="dropdown-item" href="{{route('profiles.profile')}}">Thông tin người dùng</a></li>
                                        <li><a class="dropdown-item" href="">Đơn hàng</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item" href="{{ route('logout') }}">Đăng xuất</a></li>
                                    </ul>
                                @else
                                    <div class="dropdown-menu me-5 dropdown_item_custom" id="form-login">
                                        @include('signin.login')
                                    </div>
                                    {{-- register --}}
                                    <div class="dropdown-menu me-5 dropdown_item_custom" id="form-register">
                                        @include('signin.register')
                                    </div>
                                @endif


                            </li>
                            <li class="nav-item ">
                                <a href="{{route('cart')}}" class="nav-link text-secondary position-relative">
                                    <i class="fas fa-shopping-cart">
                                        <span
                                        id="numberCart"
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
