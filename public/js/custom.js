// const form_login = document.getElementById('form-login');
// const form_register = document.getElementById('form-register');
// const btn_redirect_register = document.getElementById('not_account');
// const btn_redirect_login = document.getElementById('had_account');
// btn_redirect_register.addEventListener('click',(e)=>{
//   e.preventDefault();
//   form_login.style.display = 'none';
//   form_register.style.display = 'block';
// });
// btn_redirect_login.addEventListener('click',(e)=>{
//   e.preventDefault();
//   form_login.style.display = 'block';
//   form_register.style.display = 'none';
// });

$(document).ready(function () {
 $('.btn_overplay').click(function () {
    $('#formLogin').css('display','block')
 })
 $('.btn_close').click(function () {
    $('.form_overplay').css('display','none')
 })
 $('#not_account').click(function (e) {
  e.preventDefault();
    $('#formLogin').css('display','none')
    $('#formRegister').css('display','block')
 })
 $('#had_account').click(function (e) {
  e.preventDefault();
    $('#formLogin').css('display','block')
    $('#formRegister').css('display','none')
 })

});