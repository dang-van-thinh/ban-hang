<form action="{{ route('login') }}" method="POST" class="p-4 bg-body-secondary form_login">
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
    <h5 class="text-center mb-4">Đăng nhập</h5>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" name="email" id="email" placeholder="Nhập email" class="form-control"
            value="{{ old('email') }}">
    </div>
    <div class="mb-3">
        <label for="pw" class="form-label">Mật khẩu</label>
        <input type="password" name="pw" id="pw" placeholder="Nhập mật khẩu" class="form-control"
            value="{{ old('pw') }}">
    </div>
    <div class="mb-3">
        <div class="group-input">
            <input type="checkbox" name="">Nhớ mật khẩu của tôi
        </div>
    </div>
    <div class="mb-3">
        <a id="not_account" href="#">Chưa có tài khoản ?</a>
    </div>
    <div class="mt-5 text-center">
        <input type="submit" value="Đăng nhập" class="btn btn-info w-50">
    </div>
</form>
