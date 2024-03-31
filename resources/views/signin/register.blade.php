<form action="{{ route('register') }}" method="POST" class=" mx-auto border p-4 bg-body-secondary form_login">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @csrf
    <h5 class="text-center mb-4">Đăng ký</h5>
    <div class="mb-3">
        <label for="name" class="form-label fw-bold">Tên người
            dùng</label>
        <input type="text" name="name" id="name" placeholder="Nhập tên" class="form-control"
            value="{{ old('name') }}">
    </div>
    <div class="mb-3">
        <label for="name" class="form-label fw-bold">Email</label>
        <input type="text" name="email" id="name" placeholder="Nhập email" class="form-control"
            value="{{ old('email') }}">
    </div>
    <div class="mb-3">
        <label for="phone_number" class="form-label fw-bold">Số điện thoại</label>
        <input type="tel" name="phone_number" id="phone_number" placeholder="Nhập số điện thoại"
            class="form-control" value="{{ old('phone_number') }}">
    </div>
    <div class="mb-3">
        <label for="pw" class="form-label fw-bold">Mật khẩu</label>
        <input type="password" name="pw" id="pw" placeholder="Nhập mật khẩu" class="form-control"
            value="{{ old('pw') }}">
    </div>
    <div class="mb-3">
        <label for="rpw" class="form-label fw-bold">Nhập lại mật
            khẩu</label>
        <input type="password" name="rpw" id="rpw" placeholder="Nhập lại mật khẩu" class="form-control">
    </div>
    <div class="mb-3">
        <a href="#" id="had_account">Đã có tài khoản ?</a>
    </div>
    <div class="mt-5 text-center">
        <input type="submit" value="Đăng ký" class="btn btn-info w-50">
    </div>
</form>
{{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
   $('#rpw').keydown(()=>{
    console.log($('#pw').val());
    console.log($('#rpw').val());
    if( $('#pw').val() === $('#rpw').val()){
        console.log('okeee');
    }
   })
</script> --}}