@extends('client.page.profiles.layout')
@section('profile')
    <div class="mt-3 container">
        <div class="bg-white">
            <div class="d-flex">
                <img src="{{ asset('img/custom/default-facebook.png') }}" alt="" class="rounded" width="100px">
                <div class="ms-3">
                    <h5 class="fs-6"> {{ $user->name }} </h5>
                    <div class="d-flex">
                        <p class="fw-medium">Email:</p>
                        <span class="ms-2">{{ $user->email }} </span> ,
                        <p class="fw-medium ms-2">Điện thoại:</p>
                        <span class="ms-2"> {{ $user->phone_number }} </span>
                        <a href="{{ route('profiles.profile-setting') }}" class="ms-2 text-primary">
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
                @isset($bill)
                    @foreach ($bill as $item)
                        @php
                            $billDetail = $oneBill->getOneBill($item->id);
                            $totalPrice = 0;
                            for ($i = 0; $i < count($billDetail); $i++) {
                                $totalPrice += $billDetail[$i]->quanity_buy * $billDetail[$i]->price;
                            }
                            // dd($totalPrice)
                        @endphp
                        <div class="container border mb-3 border-success rounded">
                            <div class="d-flex justify-content-between px-3">
                                <div class="mt-2">
                                    <div class="d-flex">
                                        <span class="fw-bold">Mã hóa đơn:</span>
                                        <span class="ms-2"> {{ $item->id }} </span>
                                    </div>
                                    <p class="d-flex fw-light">
                                        <strong class="fw-bold">Ngày:</strong>
                                        <span class="fw-medium ms-2"> {{ $item->date_time_buy }} </span>
                                    </p>
                                </div>
                                <div class="mt-3">

                                    <div class="d-flex input-group">
                                        @if ($item->status == 5)
                                            <a href="" class="btn btn-success">Đánh giá</a>
                                        @elseif ($item->status == 4)
                                        <a href="#" class="btn btn-success status" 
                                        data-url="{{route('ajaxUpdateStatus')}}" 
                                        data-status="5"
                                        data-id="{{$item->id}}">Đã nhận được hàng</a>
                                        
                                        @elseif($item->status == 1 || $item->status == 2 )
                                            <a href="#" class="btn btn-danger status" 
                                            data-url="{{route('ajaxUpdateStatus')}}" 
                                            data-status="0"
                                            data-id="{{$item->id}}">Hủy đơn hàng</a>
                                        @endif
                                        
                                        @switch($item->status)
                                            @case(0)
                                                <span class="p-3 badge bg-info text-dark fs-6 fw-normal"> Đơn hàng đã hủy</span>
                                            @break
                                            @case(1)
                                                <span class="p-3 badge bg-info text-dark fs-6 fw-normal"> Đang xử lý</span>
                                            @break

                                            @case(2)
                                                <span class="p-3 badge bg-info text-dark fs-6 fw-normal"> Đang chuẩn bị hàng</span>
                                            @break

                                            @case(3)
                                                <span class="p-3 badge bg-info text-dark fs-6 fw-normal"> Đang vận chuyển</span>
                                            @break

                                            @case(4)
                                                <span class="p-3 badge bg-info text-dark fs-6 fw-normal"> Đang giao đến bạn </span>
                                            @break

                                            @case(5)
                                                <span class="p-3 badge bg-info text-dark fs-6 fw-normal"> Đã giao</span>
                                            @break
                                        @endswitch
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
                                                    <li class="nav-item"> {{ $item->name }} </li>
                                                    <li class="nav-item d-flex">
                                                        <strong>Điện thoại:</strong>
                                                        <span> {{ $item->phone_number }} </span>
                                                    </li>
                                                    <li class="nav-item d-flex">
                                                        <strong>Email:</strong>
                                                        <span> {{ $item->email }} </span>
                                                    </li>
                                                </ul>
                                            </td>
                                            <td class="border-end">
                                                <p>
                                                    {{ $item->address }}
                                                    - {{ $item->wardName }}
                                                    - {{ $item->districtName }}
                                                    - {{ $item->provinceName }}
                                                </p>
                                            </td>
                                            <td class="border-end">
                                                <ul class=" nav flex-column table_infor_order">
                                                    <li class="nav-item">
                                                        @switch($item->pay)
                                                            @case(1)
                                                                COD
                                                            @break

                                                            @case(2)
                                                                MoMo
                                                            @break

                                                            @default
                                                                Liên hệ với chúng tôi
                                                        @endswitch
                                                    </li>
                                                    <li class="nav-item d-flex">
                                                        <strong>Tổng tiền:</strong>
                                                        <span class="ms-2 fw-medium">
                                                            {{ number_format($totalPrice, 0, ',', '.') }} VNĐ</span>
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

                                    @foreach ($billDetail as $bill)
                                        <div class="col-4">
                                            <div class="p-2 d-flex d-block">
                                                <div class="">
                                                    <img width="100px" height="100px" class= "img-thumbnail"
                                                        src="{{ asset($bill->img) }}" alt="">
                                                </div>
                                                <div class="w-75 px-2">
                                                    <span class="d-block fw-medium"> {{ $bill->product_name }} </span>
                                                    <strong>
                                                        {{ number_format($bill->quanity_buy * $bill->price, 0, ',', '.') }}
                                                        VNĐ</strong>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endisset
            </div>
        </div>
    </div>
@endsection
