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
                        <a class="nav-link fw-bold nav-header-menu" aria-current="page" href="{{ route('home') }}">Trang chủ</a>
                    </li>

                    @foreach ($category as $item)
                        <li class="nav-item dropdown me-2">
                            <a class="nav-link dropdown-toggle fw-bold nav-header-menu" href="#" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $item->name }}
                            </a>
                            <ul class="dropdown-menu">
                                @foreach ($categoryChill->getCategoryChill($item->id) as $items)
                                    <li class="">
                                        <a class="dropdown-item fw-bold nav-header-menu"
                                            href="{{ route('category', $items->id) }}">{{ $items->name }}</a>
                                    </li>
                                @endforeach

                            </ul>
                        </li>
                    @endforeach

                </ul>
                <div class="d-flex">
                    <form class="me-3" action="{{ route('search') }}" id="form_search" method="GET">
                        <div class="input-group">
                            <input class="form-control fw-medium" type="search" name="key" id="key"
                                placeholder="Tìm kiếm" aria-label="Search" data-url="{{ route('ajaxSearch') }}">
                            <button class="btn btn-outline-primary" type="submit"><i
                                    class="fas fa-search"></i></button>
                        </div>
                    </form>
                    <div class="media">
                        <div class="search-show"
                        data-urlimg="{{asset('')}}"
                        data-urlsearch="{{route('search')}}"
                         data-url="{{route('detailProduct')}}">  
                         {{-- hiển thị danh sách sản phẩm tìm kiếm --}}
                         <div class="show-search">

                         </div>
                         <div class="text-center show-more-media">
                             
                          </div>
                        </div>
                    </div>
                    <div class="d-flex">
                        <ul class="nav me-5 ">
                            @if (Auth::check())
                                <li class="nav-item dropdown me-4 w-25 dropdow_custom">
                                    <a class="nav-link dropdown-toggle text-secondary" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-user"></i>
                                    </a>

                                    {{-- logined --}}
                                    <ul class="dropdown-menu me-5 me-n" style="transform: translate(-50px,0)">
                                        <li><a class="dropdown-item fw-medium" href="{{ route('profiles.profile') }}">Thông tin
                                                người dùng</a></li>
                                        <li><a class="dropdown-item fw-medium" href="{{ route('profiles.profile') }}">Đơn
                                                hàng</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item fw-medium" href="{{ route('logout') }}">Đăng xuất</a></li>
                                    </ul>
                                </li>
                            @else
                                <li class="nav-item">
                                    <button class="btn text-secondary btn_overplay" data-overplay-target="#formLogin">
                                        <i class="fas fa-user"></i>
                                    </button>
                                    @include('signin.login')
                                    @include('signin.register')
                                    {{-- @include('signin.forgot-password') --}}
                                </li>
                            @endif
                            <li class="nav-item ">
                                <a href="{{ route('cart') }}" class="nav-link text-secondary position-relative">
                                    <i class="fas fa-shopping-cart">
                                        <span id="numberCart"
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
