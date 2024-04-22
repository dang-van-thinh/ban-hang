<div class="overlay form_overplay" id="formRegister">
    <div class="form-container" id="LoginAndRegister" style="width:40rem">
        <div class="">
            <button class="btn_close"><i class="fas fa-times"></i></button>
        </div>
        <form action="{{ route('register') }}" method="POST" class=" mx-auto border p-4 bg-body-secondary form_login">
            @csrf
            <h5 class="text-center mb-4">Đăng ký</h5>
            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Tên người
                    dùng</label>
                <input type="text" name="name" id="name" placeholder="Nhập tên" class="form-control"
                    value="{{ old('name') }}">
                @if ($errors->has('name'))
                    <i class="badge text-danger">
                        *{{ $errors->first('name') }}
                    </i>
                @endif
            </div>
            <div class="mb-3">
                <label for="name" class="form-label fw-bold">Email</label>
                <input type="text" name="email" id="name" placeholder="Nhập email" class="form-control"
                    value="{{ old('email') }}">
                @if ($errors->has('emaail'))
                    <i class="badge text-danger">
                        *{{ $errors->first('emaail') }}
                    </i>
                @endif
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label fw-bold">Số điện thoại</label>
                <input type="tel" name="phone_number" id="phone_number" placeholder="Nhập số điện thoại"
                    class="form-control" value="{{ old('phone_number') }}">
                @if ($errors->has('phone_number'))
                    <i class="badge text-danger">
                        *{{ $errors->first('phone_number') }}
                    </i>
                @endif
            </div>
            <div class="mb-3">
                <label for="pws" class="form-label fw-bold">Mật khẩu</label>
                <div class="btn_input_login">
                    <input type="password" name="pw" id="pws" placeholder="Nhập mật khẩu" class="form-control"
                        value="{{ old('pw') }}">
                        <button type="button" class="btn btn_login_button btn-show">
                            <i class="fas fa-eye-slash"></i>

                </div>
                @if ($errors->has('pw'))
                    <i class="badge text-danger">
                        *{{ $errors->first('pw') }}
                    </i>
                @endif
            </div>
            <div class="mb-3">
                <label for="rpw" class="form-label fw-bold">Nhập lại mật
                    khẩu</label>
                    <div class="btn_input_login">
                        <input type="password" name="rpw" id="rpw" placeholder="Nhập lại mật khẩu"
                            class="form-control">
                            <button type="button" class="btn btn_login_button btn-show">
                                <i class="fas fa-eye-slash"></i>
                    </div>
            </div>
            <div class="mb-3">
                <a href="#" id="had_account">Đã có tài khoản ?</a>
            </div>
            <div class="mt-5 text-center">
                <input type="submit" value="Đăng ký" class="btn fw-medium btn-info w-50">
            </div>
        </form>
    </div>
</div>
<script>
   $('#rpw').keydown(()=>{
    console.log($('#pw').val());
    console.log($('#rpw').val());
    if( $('#pw').val() === $('#rpw').val()){
        console.log('okeee');
    }
   })
</script> 
