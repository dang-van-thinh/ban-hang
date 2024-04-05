<div class="overlay form_overplay" id="formLogin">
    <div class="form-container" id="LoginAndRegister" style="width:40rem">
        <div class="">
            <button class="btn_close"><i class="fas fa-times"></i></button>
        </div>
        <form action="{{ route('login') }}" method="POST" class="p-4 bg-body-secondary form_login" >
            @csrf
            <h5 class="text-center mb-4 fw-bold">Đăng nhập</h5>
            <div class="mb-3">
                <label for="email" class="form-label fw-medium">Email</label>
                <input type="text" name="email" id="email" placeholder="Nhập email" class="form-control"
                    value="{{ old('email') }}">
                @if ($errors->has('email'))
                    <i class="badge text-danger">
                        *{{ $errors->first('email') }}
                    </i>
                @endif
            </div>
            <div class="mb-3">
                <label for="pw" class="form-label fw-medium">Mật khẩu</label>
                <input type="password" name="pw" id="pw" placeholder="Nhập mật khẩu" class="form-control"
                    value="{{ old('pw') }}">
                @if ($errors->has('pw'))
                    <i class="badge text-danger">
                        *{{ $errors->first('pw') }}
                    </i>
                @endif
            </div>
            <div class="mb-3">
                <div class="group-input">
                    <input type="checkbox" name="">Nhớ mật khẩu của tôi
                </div>
            </div>
            <div class="mb-3 d-flex justify-content-around">
                <a id="not_account" href="#">Chưa có tài khoản ?</a>
                <a id="forgotPassword" href="{{route('forgotPassword',csrf_token())}}">Quên mật khẩu ?</a>
            </div>
            <div class="mt-5 text-center">
                <input type="submit" value="Đăng nhập" class="btn fw-medium btn-info w-50">
            </div>
        </form>
    </div>
</div>
