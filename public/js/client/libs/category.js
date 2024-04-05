$(document).ready(function() {
    const urlDetail = $('.item-page').data('urldetail')
    const urlProductOffset = $('.item-page').data('url');
    const baseUrl = $('.item-page').data('urlimage');
    const urlFilter = $('#btn_filter_product').data('urlfilter')
    $('#rangePrice').change(() => {
        let rangePrice = $('#rangePrice').val();
        $('#maxPrice').text(rangePrice.replace(/\B(?=(\d{3})+(?!\d))/g, '.'))
    })

    $('.item-page').click(function(e) {
        e.preventDefault()
        let _this = $(this);
        let page = _this.data('page');
        let limit = _this.data('limit');
        let offsets = Number((page - 1) * limit);
        let category = _this.data('category');
        let orderBy = _this.data('orderby');
       
        itemForPage(offsets, limit, category, orderBy);
    });

    
    $('#orderby').change(function() {
        // e.preventDefault()
        filterProduct();
    });
    $('#btn_filter_product').click(function(e){
        // e.preventDefault();
        filterProduct();
    })

    function filterProduct() {
        let category = $('#methodCategory').data('category');
        let colorChecked = $('input[name=color]:checked');
        let sizeChecked = $('input[name=size]:checked');
        let color = [];
        let size = [];
        let price = $('#rangePrice').val();
        // let price = 5000000;
        let orderby = $('#orderby').val();
        console.log(colorChecked);
        if (colorChecked.length > 0) {
            for (const item of colorChecked) {
                color.push(item.value);
            }
        } else {
            color = null;
        }

        if (sizeChecked.length > 0) {
            for (const item of sizeChecked) {
                size.push(item.value);
            }
        } else {
            size = null;
        }

        let data = {
            color: color,
            size: size,
            price: price,
            orderby: orderby,
            category: category
        }
        $.ajax({
            type: "post",
            url: urlFilter,
            data: data,
            dataType: "json",
            success: function(res) {
                console.log(res.products);
                let html = '';
                res.products.forEach(el => {
                    let price = el.price.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                    html += `
                    <div class="col-lg-3 col-md-6 col-sm-6 col-6 mt-3">
                            <div class="product">
                                <a href="${urlDetail+'/'+el.id}">
                                    <div class="image_product ">
                                        <img src="${baseUrl+el.img}" alt="" class="text-center">
                                    </div>
                                    <div class=" des_product ps-3">
                                        <h5 class="fw-medium text-secondary">${el.name}</h5>
                                        <p class="text-danger fw-bold">
                                            ${price} <span>VNĐ</span></p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    `;
                });
                $('#show_product').html(html)
            }
        });
    }
    function itemForPage(offset, limit, category, orderBy) {
        let data = {
            offset: offset,
            limit: limit,
            category: category,
            orderBy: orderBy
        };
       
        $.ajax({
            type: "POST",
            url: urlProductOffset,
            data: data,
            dataType: "json",
            success: function(response) {
                console.log(response);
                let html = '';
                
                response.products.forEach(el => {
                    let price = el.price.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                    html += `
                    <div class="col-lg-3 col-md-6 col-sm-6 col-6 mt-3">
                            <div class="product">
                                <a href="${urlDetail+'/'+el.id}">
                                    <div class="image_product ">
                                        <img src="${baseUrl+el.img}" alt="" class="text-center">
                                    </div>
                                    <div class=" des_product ps-3">
                                        <h5 class="fw-medium text-secondary">${el.name}</h5>
                                        <p class="text-danger fw-bold">
                                            ${price} <span>VNĐ</span></p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    `;
                });
                $('#show_product').html(html)
            },
            error: function(xhr,status,error) {
                // console.log(xhr.responseText);
                // console.log(status);
                // console.log(error);
            }
        });
    }
});
