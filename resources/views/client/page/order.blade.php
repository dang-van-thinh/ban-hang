@extends('client.layout.main')
@section('content')
    <div class="mt-5 container">

        <form action="{{ route('storeOrder') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-7">
                    {{-- dot  --}}
                    <div class="order_progress">
                        <div class="progress_dot">
                            <span class="dot_icon dot_active"></span>
                            <span class="dot_name fw-bold">Giỏ hàng</span>
                        </div>
                        <div class="progress_line dot_active" style="background: #000"></div>
                        <div class="progress_dot">
                            <span class="dot_icon dot_active"></span>
                            <span class="dot_name fw-bold">Đặt hàng và thanh toán</span>
                        </div>
                        <div class="progress_line dot_active"></div>
                        <div class="progress_dot">
                            <span class="dot_icon"></span>
                            <span class="dot_name fw-bold">Hoàn thành</span>
                        </div>
                    </div>

                    {{-- cart detail --}}

                    <div class="p-5">
                        {{-- form người nhận --}}
                        <h5>Thông tin người nhận</h5>
                        <div>
                            <div class="mt-3">
                                <label for="name" class="form-label fw-medium">Họ và tên người nhận</label>
                                <input type="text" name="name" id="name" placeholder="Họ và tên người nhận"
                                    class="form-control" value="{{ old('name', isset($users['name']) ? $users['name'] :'') }}">
                                @if ($errors->has('name'))
                                    <i class="badge text-danger">
                                        *{{ $errors->first('name') }}
                                    </i>
                                @endif
                            </div>
                            <div class="d-flex">
                                <div class="mt-3 w-75 me-2">
                                    <label for="email" class="form-label fw-medium">Email</label>
                                    <input type="text" name="email" id="email" placeholder="Email"
                                        class="form-control" value="{{ old('email',isset($users['email']) ? $users['email'] :'') }}">
                                    @if ($errors->has('email'))
                                        <i class="badge text-danger">
                                            *{{ $errors->first('email') }}
                                        </i>
                                    @endif
                                </div>
                                <div class="mt-3">
                                    <label for="phone" class="form-label fw-medium">Số điện thoại</label>
                                    <input type="tel" name="phone" id="phone" placeholder="Số người nhận"
                                        class="form-control" value="{{ old('phone',isset($users['phone']) ? $users['phone'] :'') }}">
                                    @if ($errors->has('phone'))
                                        <i class="badge text-danger">
                                            *{{ $errors->first('phone') }}
                                        </i>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 border rounded">
                            <div class="card">
                                <div class="card-header">
                                    <div class="form-check w-100">
                                        <input type="checkbox" checked class="form-check-input" id="exampleCheck1" readonly>
                                        <label class="form-check-label" for="exampleCheck1">Giao hàng tận nhà</label>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <input type="text" name="address" id="address"
                                        placeholder="Thôn/Xóm/Tên đường/Số nhà" class="form-control"
                                        value="{{ old('address',isset($users['address']) ? $users['address'] :'') }}">
                                    @if ($errors->has('address'))
                                        <i class="badge text-danger">
                                            *{{ $errors->first('address') }}
                                        </i>
                                    @endif
                                    <div class="d-flex justify-content-between">
                                        <div class="mt-3">
                                            <select name="provinces" id="provinces" class="form-select">
                                                <option value="">[Chọn tỉnh/TP]</option>
                                                @isset($provinces)
                                                    @foreach ($provinces as $item)
                                                        <option {{ old('provinces',isset($users['provinces']) ?$users['provinces'] :'') == $item->code ? 'selected' : '' }}
                                                            value="{{ $item->code }}">{{ $item->name }}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                            @if ($errors->has('provinces'))
                                                <i class="badge text-danger">
                                                    *{{ $errors->first('provinces') }}
                                                </i>
                                            @endif
                                        </div>
                                        <div class="mt-3">
                                            <select name="districts" id="districts" class="form-select" 
                                            data-urldistricts="{{ route('ajaxDistricts') }}">
                                                <option value="">[Chọn quận/huyện]</option>
                                                @isset($users['districts'])
                                                    <option selected value="{{$users['districts']->code}}">{{$users['districts']->name}}</option>
                                                @endisset
                                            </select>
                                            @if ($errors->has('districts'))
                                                <i class="badge text-danger">
                                                    *{{ $errors->first('districts') }}
                                                </i>
                                            @endif
                                        </div>
                                        <div class="mt-3">
                                            <select name="wards" id="wards" class="form-select" data-urlwards="{{ route('ajaxWards') }}">
                                                <option value="">[Chọn xã/phường]</option>
                                                @isset($users['wards'])
                                                    <option selected value="{{$users['wards']->code}}">{{$users['wards']->name}}</option>
                                                @endisset
                                            </select>
                                            @if ($errors->has('wards'))
                                                <i class="badge text-danger">
                                                    *{{ $errors->first('wards') }}
                                                </i>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5">
                            <h5 class="">Phương thức thanh toán</h5>
                            <div class="mt-3">
                                <div class="card mt-3">
                                    <div class="card-header p-3">
                                        <div class="form-check mb-3">
                                            <input checked type="radio" class="form-check-input pay" value="1"
                                                name="pay" id="pay_1">
                                            <label for="pay_1" class="form-check-label">Thanh toán khi nhận hàng
                                                (COD)</label>
                                        </div>
                                        <div class="form-check mb-3">
                                                <input type="radio" class="form-check-input pay" name="pay"
                                                    value="2" id="pay_2">
                                                <label for="pay_2" class="form-check-label">Thanh toán MOMO</label>
                                                <img src="{{ asset('img/custom/MoMo_Logo.png') }}" alt=""
                                                    width="30px">
                                                    <a href="{{route('paymomo')}}" 
                                                    id="2" 
                                                    style="display:none" 
                                                    class="ms-2 btn btn-warning">Thanh toán</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5">
                            <button type="submit" class="btn w-100 btn-success p-3 fs-6">Hoàn tất đơn hàng</button>
                        </div>
                    </div>
                </div>
                <div class="col-5">
                    <div class="w-100 bg-light p-5">
                        <ul class="nav flex-column">
                            <li class="nav-item mb-4">
                                <h4>Tổng tiền giỏ hàng</h4>
                            </li>
                            <li class="nav-item">
                                <div class="d-flex justify-content-between">
                                    <p class="fw-medium">Tổng sản phẩm:</p>
                                    {{-- <span id="totalQuanity">0</span> --}}
                                    <input type="text" readonly name="total_quanity" id="totalQuanity" value="">
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
                                        {{-- <span id="priceFinal">40000</span> --}}
                                        <input type="text" readonly name="price" id="priceFinal" value="">
                                        <span class="fw-bold">VNĐ</span>
                                    </p>
                                </div>
                            </li>
                            <li class="nav-item">
                                <div class="d-flex text-danger">
                                    <span class=" me-2"><i class="fas fa-exclamation-triangle"></i></span>
                                    <span>Miễn phí ship với đơn hàng trên 500.000 VNĐ</span>
                                </div>
                            </li>
                            <li class="nav-item mt-2">
                                <div class="d-flex">
                                    <span class=" me-2 "><i class="fas fa-check-circle"></i></span>
                                    <span id="ship">Đơn hàng của bạn được miễn phí ship</span>
                                </div>
                            </li>
                            <li class="nav-item">
                                <div class="mt-5">
                                    <textarea name="" id="" cols="30" rows="10" placeholder="Ghi chú cho cửa hàng"
                                        class="form-control"></textarea>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
