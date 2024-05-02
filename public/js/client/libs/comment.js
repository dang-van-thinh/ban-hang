$(document).ready(function () {
    $('#formComment').on('submit',function(e){
        e.preventDefault()
        let _this = $(this);
        let urlRoute = _this.data('url'); 
        let user = _this.data('user')
        let product = _this.data('product')
        let description = $('#description').val();
        let data = {
            user : user,
            product: product,
            description: description
        }
        // console.log(data);
        handleComment(data,urlRoute);
        loadComments()
        $('#description').val('');
        
    })
    function loadComments() {
        let formComment = $('#formComment');
        let urlRoute = formComment.data('urlget');
        let product = formComment.data('product')
        let urlBase = formComment.data('urlbase');
        let data = {
            product: product,
        }
        $.ajax({
            type: "get",
            url: urlRoute,
            data: data,
            dataType: "json",
            success: function (res) {
                console.log(res);
                if(res.comments.length > 0){

                let html = '';
                $.map(res.comments, function (el, index) {
                    const date = new Date(el.created_at);
                    const options = {timeZone: 'Asia/Ho_Chi_Minh', year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric' };
                    const formattedDate = date.toLocaleString('en-US', options);
                    console.log(formattedDate);
                    html+= `
                    <div class="box-comment">
                    <div class="infor_user_comment">
                        <img src="${urlBase+'img/avatars/1.png'}" alt="">
                        <p>
                            <span> ${el.name} </span>
                            <span class="comment_date"> ${formattedDate} </span>
                        </p>
                    </div>
                    <div class="content_user_comment">
                        <p class="comment_content"> ${el.description} </p>
                    </div>
                </div>
                    `;
                    $('#show_comments').html(html);
                });
            }else{
                html = ` <div class="alert alert-info">
                Hãy là người bình luận đầu tiên nhé !
            </div> `;
                $('#show_comments').html(html);

            }
                
            }
        });
    }
    loadComments();
    function handleComment(data,urlRoute) {
        $.ajax({
            type: "post",
            url: urlRoute,
            data: data,
            dataType: "json",
            success: function (res) {
                console.log(res);
            }
        });
    }
});