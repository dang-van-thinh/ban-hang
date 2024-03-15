const form_login = document.getElementById('form-login');
const form_register = document.getElementById('form-register');
const btn_redirect_register = document.getElementById('not_account');
const btn_redirect_login = document.getElementById('had_account');
btn_redirect_register.addEventListener('click',(e)=>{
  e.preventDefault();
  form_login.style.display = 'none';
  form_register.style.display = 'block';
});
btn_redirect_login.addEventListener('click',(e)=>{
  e.preventDefault();
  form_login.style.display = 'block';
  form_register.style.display = 'none';
});

