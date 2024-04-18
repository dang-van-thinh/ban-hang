//ẩn hiện mật khẩu

let check = true;
$('.btn-show').on('click', function () {
    let _this = $(this);
    if (check) {
        _this.siblings('input').attr('type', 'text');
        _this.children('i').attr('class','fas fa-eye')
        check = false
    }else{
        _this.siblings('input').attr('type','password')
        _this.children('i').attr('class', 'fas fa-eye-slash')
        check= true
    }

})