@extends('client.layout.main')
@section('content')
    <div class="container mt-4">
        <form action="{{ route('order') }}" method="get">
            @csrf
            <div class="row">
                <div class="col-8">
                    {{-- dot  --}}
                    <div class="order_progress">
                        <div class="progress_dot">
                            <span class="dot_icon dot_active"></span>
                            <span class="dot_name fw-bold">Giỏ hàng</span>
                        </div>
                        <div class="progress_line"></div>
                        <div class="progress_dot">
                            <span class="dot_icon"></span>
                            <span class="dot_name fw-bold">Đặt hàng và thanh toán</span>
                        </div>
                        <div class="progress_line"></div>
                        <div class="progress_dot">
                            <span class="dot_icon"></span>
                            <span class="dot_name fw-bold">Hoàn thành</span>
                        </div>
                    </div>

                    {{-- cart detail --}}
                    <div class="mt-3">
                        <h3>Giỏ hàng</h3>
                        <div id="table_cart">
                            <table class="table-bordered table">
                                <thead>
                                    <tr>
                                        <th>Ảnh</th>
                                        <th>Thông tin</th>
                                        <th width="160px">Số lượng</th>
                                        <th width="160px">Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody id="showCart">

                                </tbody>
                            </table>
                        </div>
                        <div id="no_cart">
                            <div class="text-danger border p-4 text-center">
                                <p>Chưa có sản phẩm nào</p>
                                <p><i class="fas fs-1 fa-shopping-cart"></i></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="w-100 bg-light p-5">
                        <ul class="nav flex-column">
                            <li class="nav-item mb-4">
                                <h4>Tổng tiền giỏ hàng</h4>
                            </li>
                            <li class="nav-item">
                                <div class="d-flex justify-content-between">
                                    <p class="fw-medium">Tổng sản phẩm:</p>
                                    <span id="totalQuanity">0</span>
                                </div>
                            </li>
                            <li class="nav-item">
                                <div class="d-flex justify-content-between">
                                    <p class="fw-medium">Tiền hàng tạm tính:</p>
                                    <p>
                                        <span id="firstPrice">0</span>
                                        <span class="fw-bold">VNĐ</span>
                                    </p>
                                </div>
                            </li>

                            <li class="nav-item">
                                <div class="d-flex justify-content-between">
                                    <p class="fw-medium">Phí vận chuyển:</p>
                                    <p>
                                        <span id="priceShip">0</span>
                                        <span class="fw-bold">VNĐ</span>
                                    </p>
                                </div>
                            </li>
                            <li class="nav-item">
                                <div class="d-flex justify-content-between">
                                    <p class="fw-medium">Thành tiền:</p>
                                    <p>
                                        <span id="priceFinal">0</span>
                                        <span class="fw-bold">VNĐ</span>
                                    </p>
                                </div>
                            </li>
                            <li class="nav-item">
                                <div class="d-flex text-danger">
                                    <span class="me-2"><i class="fas fa-exclamation-triangle"></i></span>
                                    <span>Miễn phí ship với đơn hàng trên 500.000 VNĐ</span>
                                </div>
                            </li>
                            <li class="nav-item mt-2">
                                <div class="d-flex">
                                    <span class="me-2"><i class="fas fa-check-circle"></i></span>
                                    <span id="ship"></span>
                                </div>
                            </li>
                            <li class="nav-item">
                                <div class="mt-5">
                                    <button type="submit" id="orderAction" class="btn w-100 btn-danger fs-5 px-5 py-2">Đặt
                                        hàng</button>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </form>
    </div>
    {{--  --}}
@endsection
