$(document).ready(function () {
    let old_name = $('#user_old').data('name')
    let old_email = $('#user_old').data('email')
    let old_phone = $('#user_old').data('phone')

    $('#name').keyup(function () {
        checkOld()
    })
    $('#email').keyup(function () {
        checkOld()
    })
    $('#phone').keyup(function () {
        checkOld()
    })
    checkOld()
    function checkOld() {
        let new_name = $('#name').val();
        let new_email = $('#email').val();
        let new_phone = $('#phone').val();
        let check = false;
        if (new_name != old_name || new_email != old_email || new_phone != old_phone) {
            check = true;
        }
        if (check) {
            $('.btn_save').css('cursor', 'pointer')
            $('.btn_save').prop('disabled', false)

        } else {
            $('.btn_save').css('cursor', 'no-drop')
            $('.btn_save').prop('disabled', true)
        }
    };


});