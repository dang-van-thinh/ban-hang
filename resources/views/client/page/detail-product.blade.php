@extends('client.layout.main')
@section('content')
    <div class="container">
        <div class="row mt-3 mb-4 ">
            <div class="col-6 product_image_detail">
                <div class="w-75 h-auto m-auto mt-4">
                    <input type="hidden" id="data-product"
                     data-id="{{$product[0]->id}}"
                     data-urlquanity="{{ route('ajaxDetailProduct') }}"
                     >
                    <img src="{{ asset($product[0]->img) }}" alt="" width="100%" class="detail_image">
                </div>
            </div>
            <div class="col-6">
                <div class="detail_description border-start ps-3">
                    <input type="hidden" name="id_product" id="id_product" value="{{ $product[0]->id }}">
                    <div>
                        <ul class="nav flex-column">
                            <li class="nav-item mt-4">
                                <h2 id="nameProduct">{{ $product[0]->name }}</h2>
                            </li>
                            <li class="nav-item mt-4">
                                <div class="d-flex text-danger fw-bold">
                                    <input type="hidden" name="" id="price" value="{{ $product[0]->price }}">
                                    <h4> {{ number_format($product[0]->price, 0, ',', '.') }} </h4>
                                    <span>VNĐ</span>
                                </div>
                            </li>
                            <li class="nav-item mt-4">
                                <div class="d-flex detail_color">
                                    <div class="fw-bold">Màu sắc:</div>

                                    @foreach ($getColor->getColorForProduct($product[0]->id) as $item)
                                        <div class="ms-3">
                                            <label class="color_item">
                                                <input hidden type="radio" data-namecolor="{{ $item->nameColor }}"
                                                    value="{{ $item->idColor }}" name="color"
                                                    id="color_{{ $item->id_color }}">
                                                <span id="" class="fw-medium"> {{ $item->nameColor }} </span>
                                                <div for="color_{{ $item->id_color }}"
                                                    style="background-color: {{ $item->valueColor }}"></div>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </li>
                            <li class="nav-item mt-4">
                                <div class="d-flex detail_size">
                                    <div class="fw-bold">Kích thước:</div>
                                    @foreach ($getSize->getSizeForProduct($product[0]->id) as $item)
                                        <div class="ms-3">
                                            <div class="size_item">
                                                <input hidden type="radio" value="{{ $item->idSize }}"
                                                    data-namesize="{{ $item->nameSize }}" name="size"
                                                    id="size_{{ $item->idSize }}">
                                                <label for="size_{{ $item->idSize }}" class="fw-medium"> {{ $item->nameSize }} </label>

                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </li>
                            <li class="nav-item mt-4">
                                <div class="d-flex detail_size">
                                    <div class="fw-bold">Còn trong kho:</div>
                                    <span class="ms-3 fw-medium" id="quanityProduct"> </span>
                                </div>
                            </li>
                            <li class="nav-item mt-4">
                                <div class="d-flex detail_size">
                                    <div class="input-group w-25 in_up_quanity">
                                        <span id="minus" class="minus me-1"><i class="fas fa-minus"></i></span>
                                        <input value="1" min="1" class="me-1" type="number" id="numberOrder">
                                        <span id="plus" class="plus me-1"><i class="fas fa-plus "></i></span>
                                    </div>
                                    <div class="w-75">
                                        <button class="btn_add_cart fw-bold" id="btn_add_cart">Thêm vào giỏ hàng</button>
                                    </div>
                                </div>
                            </li>
                            <hr>
                            <li class="nav-item mt-2">
                                <ul class="nav flex-column">
                                    <li class="nav-item mb-3">
                                        <div class="d-flex ">
                                            <i class="fas fa-user-shield fs-4 text-danger icon_service"></i>
                                            <p class="ms-3">Bảo hành 6 tháng cho tất cả các sản phẩm </p>
                                        </div>
                                    </li>
                                    <li class="nav-item mb-3">
                                        <div class="d-flex">
                                            <i class="fas fa-sync-alt fs-4 text-danger icon_service"></i>
                                            <p class="ms-3">Hoàn trả trong 7 ngày </p>
                                        </div>
                                    </li>
                                    <li class="nav-item mb-3">
                                        <div class="d-flex flex-row">
                                            <i class="fas fa-hand-holding-usd fs-4 text-danger icon_service"></i>
                                            <p class="ms-3">Hoàn lại tiền nếu hàng có lỗi </p>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <hr>
                    <div class="mt-3">
                        <h5 class="text-uppercase">Thông tin sản phẩm</h5>
                        <div>
                            {!! $product[0]->description !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- feedback for user --}}
        <div class="mt-3">

        </div>
        {{-- similar product  --}}
        <div class="mt-5">
            <hr>
            <h4 class="text-center my-4">Sản phẩm liên quan</h4>
            <div class="owl-carousel owl-theme mt-3">
                @foreach ($categoryProduct as $item)
                    <div class="item product_carousel">
                        <div class="product">
                            <a href="{{ route('detailProduct', $item->id) }}">
                                <div class="image_product">
                                    <img src="{{ asset($item->img) }}" alt="" class="text-center">
                                </div>
                                <div class="mt-4 ps-3 des_product">
                                    <h5 class="fw-medium text-secondary"> {{ $item->name }} </h5>
                                    <p class="text-danger fw-bold"> {{ number_format($item->price, 0, ',', '.') }}
                                        <span>đ</span>
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                    {{-- end product  --}}
                @endforeach
            </div>
        </div>
        <div>
            @include('client.page.comments.comment')
        </div>
    </div>
    {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        
    </script> --}}
@endsection
