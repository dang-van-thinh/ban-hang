@extends('client.layout.main')
@section('content')
    <div class="mt-2">
        <div id="carouselExampleIndicators" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('img/custom/banner1.webp') }}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('img/custom/banner2.avif') }}" class="d-block w-100"
                        alt="{{ asset('img/custom/banner1.webp') }}">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('img/custom/banner3.avif') }}" class="d-block w-100"
                        alt="{{ asset('img/custom/banner1.webp') }}">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="mt-5 container">
            {{-- services --}}
            <div class="d-flex justify-content-center row">
                <div class=" service col-lg-3 col-sm-6 col-6">
                    <img src="{{ asset('img/custom/service1.png') }}" alt="" width="50px" height="auto"
                        class="">
                    <div>
                        <h6 class="fw-bold">Miễn phí giao hàng</h6>
                        <p class="text-secondary">Toàn quốc</p>
                    </div>
                </div>
                <div class=" service col-lg-3 col-sm-6 col-6">
                    <img src="{{ asset('img/custom/service2.png') }}" alt="" width="50px" height="auto"
                        class="">
                    <div>
                        <h6 class="fw-bold">Hoàn tiền</h6>
                        <p class="text-secondary">Hoàn tiền trong 30 ngày</p>
                    </div>
                </div>
                <div class=" service col-lg-3 col-sm-6 col-6">
                    <img src="{{ asset('img/custom/service3.png') }}" alt="" width="50px" height="auto"
                        class="">
                    <div>
                        <h6 class="fw-bold">Hỗ trợ khách hàng</h6>
                        <p class="text-secondary">Hỗ trợ online 24/7</p>
                    </div>
                </div>
                <div class=" service col-lg-3 col-sm-6 col-6">
                    <img src="{{ asset('img/custom/service4.png') }}" alt="" width="50px" height="auto"
                        class="">
                    <div>
                        <h6 class="fw-bold">Bảo mật thanh toán</h6>
                        <p class="text-secondary">Thanh toán an toàn</p>
                    </div>
                </div>
            </div>
            {{-- san pham --}}
            <div class="mt-5">
                <h4 class="my-5 text-uppercase fw-bold">Sản phẩm mới nhất</h4>
                <div class="row">
                    @foreach ($productsNew as $product)
                        
                    <div class="col-lg-3 col-md-6 col-sm-6 col-6 mb-3">
                        <div class="product">
                            <a href="{{route('detailProduct',$product->id)}}">
                                <div class="image_product ">
                                    <img src="{{ asset($product->img) }}" alt=""
                                    class="text-center">
                                </div>
                                <div class="des_product ps-3">
                                    <h5 class="fw-medium text-secondary">{{$product->name}}</h5>
                                    <p class="text-danger fw-bold">{{number_format($product->price, 0, ',', '.')}} <span>VNĐ</span></p>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                    
                </div>
            </div>
            {{-- banner  --}}
            <div class="mt-5 container">
                <div class=" banner">
                    <a href="">
                        <img src="{{asset('img/custom/bst1.webp')}}" alt="" class="">
                    </a>
                </div>
                <div class="row banner_chils mt-5 p-3">
                    <div class="col-lg-4 banner_chil">
                        <img src="{{asset('img/custom/bst2.webp')}}" alt="">
                    </div>
                    <div class="col-lg-4 banner_chil">
                        <img src="{{asset('img/custom/bst2.webp')}}" alt="">
                    </div>
                    <div class="col-lg-4 banner_chil">
                        <img src="{{asset('img/custom/bst2.webp')}}" alt="">
                    </div>
                </div>
            </div>
            <div class="mt-5">
                <h5 class="text-uppercase fw-bold my-5">Đồ thể thao</h5>
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-6 mb-3">
                        <div class="product">
                            <a href="{{route('detailProduct',$product->id)}}">
                                <div class="image_product ">
                                    <img src="{{ asset($product->img) }}" alt=""
                                    class="text-center">
                                </div>
                                <div class="mt-2 des_product ps-3">
                                    <h5 class="fw-medium text-secondary">{{$product->name}}</h5>
                                    <p class="text-danger fw-bold">{{number_format($product->price, 0, ',', '.')}} <span>VNĐ</span></p>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                </div>
                <div class="mt-5">
                    <div class="text-center">
                        <a href="" class="btn btn-outline-danger">Xem thêm...</a>
                    </div>
                </div>
            </div>
            {{-- // đồ nhiều lượt xem --}}
            <div class="mt-5">
                <h5 class="text-uppercase fw-bold my-5">Sản phẩm nhiều lượt xem nhất</h5>
                <div class="row">
                    @foreach ($productByView as $productView)
                    <div class="col-lg-3 col-md-6 col-sm-6 col-6 mb-3">
                        <div class="product">
                            <a href="{{route('detailProduct',$productView->id)}}">
                                <div class="image_product ">
                                    <img src="{{ asset($productView->img) }}" alt=""
                                    class="text-center">
                                </div>
                                <div class="mt-2 des_product ps-3">
                                    <h5 class="fw-medium text-secondary">{{$productView->name}}</h5>
                                    <p class="text-danger fw-bold">{{number_format($productView->price, 0, ',', '.')}} <span>VNĐ</span></p>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                    
                </div>
                <div class="mt-5">
                    <div class="text-center">
                        <a href="{{route('view',null)}}" class="btn btn-outline-danger">Xem thêm...</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
