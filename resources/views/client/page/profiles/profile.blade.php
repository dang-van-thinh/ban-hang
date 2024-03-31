@extends('client.page.profiles.layout')
@section('profile')
    <div class="mt-3 container">
        <div class="bg-white">
            <div class="d-flex">
                <img src="{{ asset('img/custom/default-facebook.png') }}" alt="" class="rounded" width="100px">
                <div class="ms-3">
                    <h5 class="fs-6">Tên người dùng</h5>
                    <div class="d-flex">
                        <p class="fw-medium">Email:</p>
                        <span>dangvanthnh@gmail.com </span> ,
                        <p class="fw-medium ms-2">Điện thoại:</p>
                        <span>0102382387</span>
                        <a href="" class="ms-2 text-primary">
                            <i class="far fa-edit"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div>
            <div class="">
                <h5>Đơn hàng của bạn</h5>
                <div class="container border mb-3 border-success rounded">
                    <div class="d-flex justify-content-between px-3">
                        <div class="mt-2">
                            <div class="d-flex">
                                <span class="fw-medium">Mã hóa đơn:</span>
                                <span>8237</span>
                            </div>
                            <p class="d-flex fw-light">
                                <strong>Ngày:</strong>
                                <span class="fw-light">8237</span>
                            </p>
                        </div>
                        <div class="mt-3">
                            <div class="d-flex input-group">
                                <a href="" class="btn btn-danger">Thông tin hóa đơn</a>
                                <a href="" class="btn btn-info">Hủy đơn hàng</a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="container">
                        <table class="table align-center ">
                            <thead class="text-center">
                                <tr>
                                    <th class="border-end">Thông tin người đặt</th>
                                    <th class="border-end">Địa chỉ nhận hàng</th>
                                    <th>Thanh toán</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="border-end">
                                        <ul class=" nav flex-column table_infor_order">
                                            <li class="nav-item">dang thinh ne</li>
                                            <li class="nav-item d-flex">
                                                <span>Điện thoại:</span>
                                                <span>2342889089089</span>
                                            </li>
                                            <li class="nav-item d-flex">
                                                <span>Email:</span>
                                                <span>jshajdhjah@gmail.com</span>
                                            </li>
                                        </ul>
                                    </td>
                                    <td class="border-end">
                                        <p>
                                            jhsahdjawakjj ajkkkkkkkkkkkkkkkkkkkkkkkkkdhhsja wjdha hjak wh adha
                                        </p>
                                    </td>
                                    <td class="border-end">
                                        <ul class=" nav flex-column table_infor_order">
                                            <li class="nav-item">COD</li>
                                            <li class="nav-item d-flex">
                                                <span>Phí ship:</span>
                                                <span>2342889089089</span>
                                            </li>
                                            <li class="nav-item d-flex">
                                                <span>Tổng tiền:</span>
                                                <span>jshajdhjah@gmail.com</span>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <div>
                        <div class="row">
                            <div class="col-4">
                                <div class="p-2 d-flex d-block">
                                    <div class="">
                                        <img width="100px" height="100px" class= "img-thumbnail" src="{{asset('img/custom/product/giay-tt-1.avif')}}" alt="">
                                    </div>
                                    <div class="w-75 px-2">
                                        <span class="d-block">sạdjhákahsjdhjahsjdhajjdhj</span>
                                        <strong>355$</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="p-2 d-flex d-block">
                                    <div class="">
                                        <img width="100px" height="100px" class="border img-thumbnail" src="{{asset('img/custom/product/giay-tt-1.avif')}}" alt="">
                                    </div>
                                    <div class="w-75 px-2">
                                        <span class="d-block">sạdjhákahsjdhjahsjdhajjdhj</span>
                                        <strong>355$</strong>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 ">
                                <div class="p-2 d-flex d-block">
                                    <div class="">
                                        <img width="100px" height="100px" class="border img-thumbnail" src="{{asset('img/custom/product/giay-tt-1.avif')}}" alt="">
                                    </div>
                                    <div class="w-75 px-2">
                                        <span class="d-block">sạdjhákahsjdhjahsjdhajjdhj</span>
                                        <strong>355$</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
