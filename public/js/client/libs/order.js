var carts = [];
let cartLocal = JSON.parse(localStorage.getItem('product'));
const urlDistricts = $('#districts').data('urldistricts');
const urlWards = $('#wards').data('urlwards');
if (cartLocal) {
    carts = cartLocal;
}
let totalQuanity = 0;
let firstPrice = 0;
for (const item of carts) {
    totalQuanity += Number(item.quanity);
    firstPrice += Number(item.price) * Number(item.quanity);
}

if (firstPrice >= 500000) {
    $('#ship').text('Đơn hàng của bạn được miễn phí ship !').css('color', '#00a500');
    $('#priceShip').text(0);
    $('#priceFinal').val(firstPrice);
} else {
    let ship = (firstPrice * 0.02);
    let priceFinal = firstPrice - ship;
    $('#priceShip').text(ship);
    $('#priceFinal').val(firstPrice - ship);
    $('#ship').text(`Bạn cần mua thêm ${500000 - firstPrice} VNĐ nữa để có thể miễn phí ship !`)
}
$('#totalQuanity').val(totalQuanity);
$('#firstPrice').text(firstPrice);


// location viet nam
$('#provinces').change(function () {
    let province_id = $(this).val();
    console.log(province_id);
    let data = {
        'province_id': province_id
    }
    let html = '';
    $.ajax({
        type: "post",
        url: urlDistricts,
        data: data,
        dataType: "json",
        success: function (res) {
            for (const district of res.districts) {
                html += `
                        <option value="${district.code}">${district.name}</option>
                        `;
            }
            $('#districts').html(html);
        },
        error: function (err) {
            console.log(err);
        }
    });
});

// WADRS LOCATION VIET NAM
$('#districts').change(function () {
    let district_id = $(this).val();
    // console.log(district_id);
    let data = {
        'district_id': district_id
    }
    let html = '';
    $.ajax({
        type: "post",
        url: urlWards,
        data: data,
        dataType: "json",
        success: function (res) {
            // console.log(res.wards);
            for (const ward of res.wards) {
                html += `
                        <option value="${ward.code}">${ward.name}</option>
                        `;
            }
            $('#wards').html(html);
        },
        error: function (err) {
            console.log(err);
        }
    });
})