@extends('client.layout.main')
@section('content')
    <div class="mt-4 container">
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
                            <table class="table table-bordered">
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
                            <div class="text-center text-danger border p-4">
                                <p>Chưa có sản phẩm nào</p>
                                <p><i class="fas fs-1 fa-shopping-cart"></i></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="w-100 p-5 bg-light">
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
                                    <span class=" me-2"><i class="fas fa-exclamation-triangle"></i></span>
                                    <span>Miễn phí ship với đơn hàng trên 500.000 VNĐ</span>
                                </div>
                            </li>
                            <li class="nav-item mt-2">
                                <div class="d-flex">
                                    <span class=" me-2 "><i class="fas fa-check-circle"></i></span>
                                    <span id="ship"></span>
                                </div>
                            </li>
                            <li class="nav-item">
                                <div class="mt-5">
                                    <button type="submit" id="orderAction" class="btn w-100 btn-danger py-2 px-5 fs-5">Đặt hàng</button>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        // show cart

        var carts = [];
        let cartLocal = JSON.parse(localStorage.getItem('product'));

        if (cartLocal) {
            carts = cartLocal;
        }
        // console.log(carts);
        $('#numberCart').text(carts.length);



function showAndHideTableCart () { 
    if (carts.length < 1) {
            $('#no_cart').show();
            $('#table_cart').hide();
            $('#orderAction').css('opacity', '0.5').css('pointer-events', 'none');
        } else {
            $('#no_cart').hide();
            $('#table_cart').show();
        }
 }
 showAndHideTableCart()
        



        let html = '';
        let index = 0;
        for (const item of carts) {
            index++;
            let prices = Number(item.price) * Number(item.quanity);
            html += `<tr data-cart="${index}" class="align-middle tr_cart">
                                <td class="text-center">
                                    <img width="180px" class="rounded" src="${item.img}" alt="">
                                    <input hidden type="text" name="id[]" value="${item.id}">
                                </td>
                                <td>
                                    <div>
                                        <p>${item.name}</p>
                                        <p>Màu: 
                                            <span>${item.color_name}</span>
                                            <input hidden type="text" name="color[]" value="${item.color_id}">
                                        </p>
                                        <p>Size:
                                            <span>${item.size_name}</span>
                                            <input hidden type="text" name="size[]" value="${item.size_id}">
                                        </p>
                                    </div>
                                </td>
                                <td class="text-center">
                                    ${item.quanity}
                                    <input hidden type="text" name="quanity[]" value="${item.quanity}">
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <input hidden type="text" name="price[]" value="${prices}">
                                        <span>${prices}</span>
                                        <span>VNĐ</span>
                                    </div>
                                </td>
                                <td width="40px">
                                    <button data-id="${item.id}"
                                     data-color="${item.color_id}" 
                                     data-size="${item.size_id}" 
                                     type="button"
                                     class="btn btn_delete_cart text-center text-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        `;
        }
        $('#showCart').append(html);



        let inforOrder = () => {
            let totalQuanity = 0;
            let firstPrice = 0;
            for (const item of carts) {
                totalQuanity += Number(item.quanity);
                firstPrice += Number(item.price) * Number(item.quanity);
            }

            if(carts.length < 1){
            $('#orderAction').css('opacity', '0.5').css('pointer-events', 'none');

            }

            if (firstPrice >= 500000) {
                $('#ship').text('Đơn hàng của bạn được miễn phí ship !').css('color', '#00a500');
                $('#priceShip').text(0);
                $('#priceFinal').text(firstPrice);
            } else {
                let ship = (firstPrice * 0.02);
                let priceFinal = firstPrice - ship;
                $('#priceShip').text(ship);
                $('#priceFinal').text(firstPrice - ship);
                $('#ship').text(`Bạn cần mua thêm ${500000 - firstPrice} VNĐ nữa để có thể miễn phí ship !`).css(
                    'color', 'red')
            }
            $('#totalQuanity').text(totalQuanity);
            $('#firstPrice').text(firstPrice);
        }
        inforOrder();
        // delete cart
        $('.btn_delete_cart').click(function() {
            const _this = $(this);
            const id = (_this.data('id'));
            const color = (_this.data('color'));
            const size = (_this.data('size'));
            console.log(carts);
            for (const product of carts) {
                if (product.id == id && product.color_id == color && product.size_id == size) {

                    let i = $.inArray(product, carts);
                    console.log(i);
                    let confirms = confirm('Bạn có chắc muốn xóa sản phẩm ra khỏi giỏ hàng ?');
                    if(confirms){
                        carts.splice(i, 1);
                        _this.parents('.tr_cart').remove();
                    }
                    console.log(carts.length);
                    localStorage.setItem('product', JSON.stringify(carts));
                    $('#numberCart').text(carts.length);
                }
            }
            showAndHideTableCart()
            inforOrder();
        });
    </script>
@endsection
