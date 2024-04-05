var carts = [];
let cartLocal = JSON.parse(localStorage.getItem('product'));

if (cartLocal) {
    carts = cartLocal;
}
// console.log(carts);
$('#numberCart').text(carts.length);



function showAndHideTableCart() {
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
    prices = prices.toLocaleString("vi-VN");
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
    const formattedFirstPrice = firstPrice.toLocaleString("vi-VN");


    if (carts.length < 1) {
        $('#orderAction').css('opacity', '0.5').css('pointer-events', 'none');

    }

    if (firstPrice >= 500000) {
        $('#ship').text('Đơn hàng của bạn được miễn phí ship !').css('color', '#00a500');
        $('#priceShip').text(0);
        $('#priceFinal').text(formattedFirstPrice);
    } else {
        let ship = (firstPrice * 0.02);
        let priceFinal = firstPrice - ship;
        $('#priceShip').text(ship);
        $('#priceFinal').text(firstPrice - ship);
        $('#ship').text(`Bạn cần mua thêm ${500000 - firstPrice} VNĐ nữa để có thể miễn phí ship !`).css(
            'color', 'red')
    }
    $('#totalQuanity').text(totalQuanity);
    $('#firstPrice').text(formattedFirstPrice);
}
inforOrder();
// delete cart
$('.btn_delete_cart').click(function () {
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
            if (confirms) {
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