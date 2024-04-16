$(document).ready(function () {
    $('#status').change(function() {
        let _this = $(this);
        let status = _this.val()
        let url = _this.data('url');
        let idBill = _this.data('id');
        let data = {
            status: status,
            idBill: idBill
        }
        console.log('sạdhajshj');
        changeStatusBill(url,data)
    })
    function changeStatusBill(url,data) {
        $.ajax({
            type: "post",
            url: url,
            data: data,
            dataType: "json",
            success: function (res) {
                if(res.status==200){
                    alert('Thay đổi trạng thái đơn hàng thành công !')
                }
            }
        });
    }
});