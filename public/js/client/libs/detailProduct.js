$(document).ready(function () {
    var arrCart = [];
    var itemLocal = localStorage.getItem('product');
    const idProduct = $('#data-product').data('id');
    const urlQuanity = $('#data-product').data('urlquanity');
    console.log(idProduct);
    if (itemLocal) {
        arrCart = JSON.parse(itemLocal);
    }
    $('#numberCart').text(arrCart.length);

    // add product to cart
    $('#btn_add_cart').click(() => {
        let idProduct = $('#id_product').val();
        let size = $('input[name="size"]:checked');
        let color = $('input[name="color"]:checked');
        let price = $('#price').val();
        let quanity = $('#numberOrder').val();
        let name = $('#nameProduct').text();
        let img = $('.detail_image').attr('src');
        console.log(size.data('nameSize'));
        const data = {
            id: idProduct,
            name: name,
            price: price,
            color_id: color.val(),
            color_name: color.data('namecolor'),
            size_id: size.val(),
            size_name: size.data('namesize'),
            quanity: quanity,
            img: img
        }
        console.log(arrCart);
        let check = true;
        if (arrCart.length > 0) {
            arrCart.forEach(e => {
                if (e.id == data.id && e.color_id == data.color_id && e.size_id == data
                    .size_id) {
                    e.quanity = Number(data.quanity) + Number(e.quanity);
                    check = false;
                    localStorage.setItem('product', JSON.stringify(arrCart))
                }
            });
        }

        if (check) {
            arrCart.push(data);
            localStorage.setItem('product', JSON.stringify(arrCart));

        } else {
            console.log('Sản phẩm đã có trong giỏ hàng!');
        }
        $('#numberCart').text(arrCart.length);
        // thực hiện nút click popup hiện ra
        $('.btn_pop_up').trigger('click');
    })

    // active attribute
    $('.size_item').click(function (e) {
        $(this).addClass('item_active')
        $('.size_item').not(this).removeClass('item_active')
    });
    $('.color_item').click(function (e) {
        $(this).addClass('item_active')
        $('.color_item').not(this).removeClass('item_active')
    });

    // checked input raido attribute
    var color = $('input[name="color"]');
    var size = $('input[name="size"]');
    for (let i = 0; i < color.length; i++) {
        color[0].checked = true;
        color[0].parentElement.classList.add('item_active')
    }
    for (let i = 0; i < size.length; i++) {
        size[0].checked = true
        size[0].parentElement.classList.add('item_active')
    }

    // get quanity product for color size as ajax
    let colored = $('input[name="color"]:checked').val();
    let sized = $('input[name="size"]:checked').val();
    quanityProduct(idProduct, colored, sized);
    $('input[name="color"]').change(() => {
        let color = $('input[name="color"]:checked').val();
        let size = $('input[name="size"]:checked').val();
        quanityProduct(idProduct, color, size);
    })
    $('input[name="size"]').change(() => {
        let color = $('input[name="color"]:checked').val();
        let size = $('input[name="size"]:checked').val();
        quanityProduct(idProduct, color, size);
    })

    // change to quanity
    // input fail fomart
    $('#numberOrder').on('change', function () {
        let _this = $(this);
        let quanity = $('#quanityProduct').text()
        if (_this.val() > Number(quanity)) {
            _this.val(Number(quanity));
        } else if (_this.val() < 1) {
            _this.val(1)
        }
    })
    $('#plus').click(() => {
        upToProduct();
    })
    $('#minus').click(() => {
        downToProduct();
    })
    // function augment order
    function upToProduct() {
        let number = $('#numberOrder').val();
        console.log($('#numberOrder').attr('max'));
        number < Number($('#numberOrder').attr('max')) ? number++ : '';
        $('#numberOrder').val(number);
        // console.log(number);
    }

    function downToProduct() {
        let number = $('#numberOrder').val();
        number > 1 ? number-- : null;
        $('#numberOrder').val(number);
    }

    // function send data with ajax
    function quanityProduct(id, color, size) {
        $.ajax({
            type: "post",
            url: urlQuanity,
            data: {
                'idProduct': id,
                'idColor': color,
                'idSize': size
            },
            success: function (response) {
                if (response.quanity.quanity_pr == 0 || response.quanity == null) {
                    // console.log('đúng');
                    $('#quanityProduct').text('Không còn hàng');
                    $('#numberOrder').attr('max', 0).val(0)
                    $('#btn_add_cart').css('cursor', 'no-drop');
                    $('#btn_add_cart').prop('disabled', true);
                } else {
                    console.log(response.quanity.quanity_pr);
                    // if (response.quanity.quanity_pr == 0) {
                    //     $('#btn_add_cart').css('cursor', 'no-drop');
                    //     $('#btn_add_cart').prop('disabled', true);
                    // }
                    $('#quanityProduct').text(response.quanity.quanity_pr);
                    $('#numberOrder').attr('max', response.quanity.quanity_pr).val(1);
                    $('#btn_add_cart').css('cursor', 'pointer');
                    $('#btn_add_cart').prop('disabled', false);
                }


                // console.log(response.quanity.quanity_pr);
            },
            error: function (error) {
                console.log(error)
            }
        });
    }


    //carousel

    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        responsive: {
            0: {
                items: 1
            },
            400: {
                items: 2
            },
            800: {
                items: 3
            },
            1200: {
                item: 4,
                loop: false
            },


        }
    })
});