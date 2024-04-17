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
   //btn login
   $('.btn_overplay').click(function () {
      $('#formLogin').css('display', 'block')
   })
   $('.btn_close').click(function () {
      $('.form_overplay').css('display', 'none')
   })
   $('#not_account').click(function (e) {
      e.preventDefault();
      $('#formLogin').css('display', 'none')
      $('#formRegister').css('display', 'block')
   })
   $('#had_account').click(function (e) {
      e.preventDefault();
      $('#formLogin').css('display', 'block')
      $('#formRegister').css('display', 'none')
   })
   // login action validate
   $('.form_login').submit(function (e) {
      let email = $('#email').val();
      let pw = $('#pw').val();
      let checkEmail = true;
      let checkPassword = true;
      // console.log(email);
      // e.preventDefault();
      if (email == '') {
         console.log('sai');
         $('#erEmail').text('*Không được để trống Email');
         checkEmail = false;
      } else {
         $('#erEmail').text('');
         checkEmail = true;
      }
      if (pw == '') {
         $('#erPW').text('*Không được để trống mật khẩu');
         checkPassword = false;
      } else {
         if (pw.length < 8) {
            $('#erPW').text('Mật khẩu phải lớn hơn 8 ký tự');
            checkPassword = false;
         } else {
            $('#erPW').text('');
            checkPassword = true;
         }
      }
      if (checkEmail == false || checkPassword == false) {
         return false
      }
   })


   $('#key').on('focus',function () {
      let _this = $(this);
         let key = _this.val();
         let url = _this.data('url');
         search(key, url);
         $('.media').show()
        $('.show-search').show();

      $('#key').on('keypress keydown',function () {
         let _this = $(this);
         let key = _this.val();
         let url = _this.data('url');
         search(key, url);
         $('.media').show()
        $('.show-search').show();

      })
   })

   $(document).on('click', function(event) {
      if (!$(event.target).is('#key')) {
        // $('.show-search').html('');
        // $('.show-more-media').html('');
        $('.media').hide();
        $('.show-search').hide();
      
      }
    });

   // function search 
   function search(key, url) {
      const urlDirect = $('.search-show').data('url')
      const urlImg = $('.search-show').data('urlimg')
      const urlSearch = $('.search-show').data('urlsearch')
      let data = {
         key: key
      }
      $.ajax({
         type: "post",
         url: url,
         data: data,
         dataType: "json",
         success: function (res) {
            console.log(res.product.length);
            let products = res.product
            let html = '';
            for (let i = 0; i < (products.length); i++) {
               
               let linkDirect = urlDirect + '/' + products[i].id;
               let linkImg = urlImg + products[i].img;
               html += `
               <div class="item-media ms-4 mb-2">
                     <a href="${linkDirect}" id="media-a" data-id="${products[i].id}" class="d-flex">
                        <img id="media-img" src="${linkImg}" alt="">
                        <h3 id="media-title" class="fw-medium fs-6 ms-2 text-dark">
                           ${products[i].name}
                        </h3>
                     </a>
               </div>
               
               `;
               if(i == 5){
                  break;
               }
            }
            // res.product.forEach(el => {
            //    let linkDirect = urlDirect + '/' + el.id;
            //    let linkImg = urlImg + el.img
            //    console.log(linkImg);
            //    html += `
            //    <div class="item-media mb-2">
            //          <a href="${linkDirect}" id="media-a" data-id="${el.id}" class="d-flex">
            //             <img id="media-img" src="${linkImg}" alt="">
            //             <h3 id="media-title" class="fw-medium fs-6 ms-2 text-dark">
            //                ${el.name}
            //             </h3>
            //          </a>
            //    </div>

            //    `;
            // });
            $('.show-search').html(html)
            let moreHtml = `<a href="${urlSearch + '?key=' + key}" class="bg-danger mt-2 p-2 fw-medium text-white">Xem thêm ${products.length} sản phẩm</a> `;
            $('.show-more-media').html(moreHtml)

         }
      });

   }
});