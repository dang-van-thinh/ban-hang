<div class="container-commnet">
    <h3>Bình luận</h3>
    <div class="show-comments" id="show_comments">

    </div>
    @if (Auth::id())
        <div>
            <form action="" id="formComment" data-url="{{ route('ajaxCommentProduct') }}"
                data-urlget="{{ route('ajaxIndexComment') }}" data-urlbase="{{ asset('') }}"
                data-user="{{ Auth::id() }}" data-product="{{ $product[0]->id }}">
                <div class="d-flex form_comment">
                    <img src="{{ asset('img/avatars/1.png') }}" alt="">
                    <div>
                        <input type="text" id="content" name="content" placeholder="Bình luận">
                    </div>
                    <div>
                        <button type="submit">
                            <i class="far fa-paper-plane"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    @else
        <div class="alert alert-danger">
            Vui lòng đăng nhập để bình luận !
        </div>
    @endif
</div>
