$(document).ready(function () {
    $('.btn_detail_bill').click(function (e) {
        e.preventDefault();
        let _this = $(this);
        const id_bill = _this.data('id_bill');
        const urldetail = _this.data('urldetail')
        const urlImg = _this.data('urlimg');
        detailBill(urldetail, id_bill,urlImg);
    });
    function detailBill(url, id_bill,urlImg) {
        let data = {
            id: id_bill
        }
        $.ajax({
            type: "post",
            url: url,
            data: data,
            dataType: "json",
            success: function (response) {
                let bill = response.bills;
                console.log(bill[0].detail_id);
                console.log(bill);
                let prouductHtml = '';
                let index = 0;
                 
                let address = `${bill[0].address + '-' + bill[0].ward_name + '-' + bill[0].district_name + '-' + bill[0].province_name}`;
                let html = `
                <nav class="nav flex-column">
                <li class="nav-item">
                    <div class="d-flex">
                        <p class="fw-bold">Mã hóa đơn:</p>
                        <p class="ms-2">${bill[0].bill_id}</p>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="d-flex">
                        <p class="fw-bold">Tên khách hàng:</p>
                        <p class="ms-2">${bill[0].name}</p>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="d-flex">
                        <p class="fw-bold">Email:</p>
                        <p class="ms-2">${bill[0].email}</p>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="d-flex">
                        <p class="fw-bold">Số điện thoại:</p>
                        <p class="ms-2">${bill[0].phone_number}</p>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="d-flex">
                       <p class="fw-bold">Địa chỉ:</p>
                       <p class="ms-2">${address}</p>
                    </div>
                   </li>
                   
                   <li class="nav-item">
                    <div class="d-flex">
                       <p class="fw-bold">Chi tiết:</p>
                       <div>
                        <table class="table table-borded">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Thông tin sản phẩm</th>
                                    <th>Hình ảnh</th>
                                    <th>Số lượng</th>
                                    <th>Đơn giá</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody id="showBillDetail">
                                
                            </tbody class="text-center">
                            <tr>
                                <td colspan="5">Thành tiền: <span id="totalPrice">sad</span></td>
                            </tr>
                        </table>
                       </div>
                    </div>
                   </li>
            </nav>
                `;
                $('#showDetailBill').html(html)
                let totalPrice = 0;
                for (const product of bill) {
                    index++
                    let initialPrice = product.quanity_buy * product.price;
                    totalPrice+=initialPrice;
                    prouductHtml += `
                    <tr class="align-middle">
                        <td> ${index} </td>
                        <td>
                            <div>
                                <p>${product.product_name}</p>
                                <p>Màu : <span>${product.color_name}</span></p>
                                <p>Size : <span>${product.size_name}</span></p>
                            </div>
                        </td>
                        <td>
                            <img src="${urlImg+product.img}" width="100px">
                        </td>
                        <td> ${product.quanity_buy} </td>
                        <td> ${product.price} </td>
                        <td> ${initialPrice} </td>
                    </tr>
                    `;
                }
                $('#showBillDetail').append(prouductHtml);
                $('#totalPrice').text(totalPrice);
            },
            error: function (error) {
                console.log(error.responseText);
            }
        });
    }
});


//phần trạng thái của đơn hàng chi tiết
{/* <li class="nav-item">
                    <div class="d-flex">
                       <p class="fw-bold">Trạng thái:</p>
                       <p class="ms-2">
                       <select name="status" id="status">
                            <option ${bill[0].status == 1 ? 'selected' : ''} value="1">Đang xử lý</option>
                            <option ${bill[0].status == 2 ? 'selected' : ''} value="2">Đã xử lý</option>
                            <option ${bill[0].status == 3 ? 'selected' : ''} value="3">Đang chuẩn bị hàng</option>
                            <option ${bill[0].status == 4 ? 'selected' : ''} value="4">Chuẩn bị giao hàng</option>
                            <option ${bill[0].status == 5 ? 'selected' : ''} value="5">Đang giao hàng</option>
                            <option ${bill[0].status == 6 ? 'selected' : ''} value="6">Đã giao</option>
                        </select>
                       </p>
                    </div>
                   </li> */}