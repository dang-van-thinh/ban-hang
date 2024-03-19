@extends('client.layout.main')
@section('content')

    <div class="row">
        @foreach ($products as $item)
            <div class="col-lg-3 col-md-6 col-sm-6 col-6 mb-3">
                <div class="product">
                    <a href="">
                        <div class="image_product">
                            <img src="{{ asset('img/custom/product/áo đá bóng (1).jpg') }}" alt="" class="text-center">
                        </div>
                        <div class="mt-2">
                            <h5 class="fw-medium text-secondary">Tên sẩn phẩm</h5>
                            <p class="text-danger fw-bold">145.000 <span>đ</span></p>
                        </div>
                    </a>
                </div>
            </div>
            {{-- end product  --}}
        @endforeach
    </div>
@endsection
