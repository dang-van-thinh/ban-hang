@extends('client.page.profiles.layout')
@section('profile')
    <div class="container">
        <form action="{{route('profiles.updatePassword')}}" method="post" class="card my-5 mx-5" id="formChangePW" >
            <h5 class="card-header text-center">Đổi mật khẩu</h5>
            @csrf
            <div class="card-body">
                <div class="input-group mb-3 ">
                    <label for="oldPW" class="w-25 input-group-text">Mật khẩu cũ</label>
                    <input type="password" name="oldPW" id="oldPW" class="form-control input-item"
                     value="{{old('oldPW')}}" 
                    placeholder="Nhập mật khẩu cũ">
                    <button type="button" class="btn btn-show">
                    <i class="fas fa-eye-slash"></i>
                    </button>
                    <i class="badge text-danger" id="erOldPW">
                        @if ($errors->has('oldPW'))
                        *{{ $errors->first('oldPW') }}
                        @endif
                    </i>
                </div>
                <div class="input-group mb-3">
                    <label for="newPW" class="w-25 input-group-text">Mật khẩu mới</label>
                    <input type="password" name="newPW" id="newPW" class="form-control input-item" 
                    value="{{old('newPW')}}" 
                    placeholder="Nhập mật khẩu mới">
                    <button type="button" class="btn btn-show">
                        <i class="fas fa-eye-slash"></i>
                        </button>
                    <i class="badge text-danger" id="erNewPW">
                        @if ($errors->has('newPW'))
                        *{{ $errors->first('newPW') }}
                        @endif
                    </i>
                   
                </div>
                <div class="input-group mb-3">
                    <label for="reNewPW" class="w-25 input-group-text">Nhập lại mật khẩu mới</label>
                    <input type="password" name="reNewPW" id="reNewPW" class="form-control input-item" 
                    value="{{old('reNewPW')}}"
                     placeholder="Nhập lại mật khẩu mới">
                     <button type="button" class="btn btn-show">
                        <i class="fas fa-eye-slash"></i>
                        </button>
                   <i class="badge text-danger" id="erReNewPW">
                    @if ($errors->has('reNewPW'))
                    *{{ $errors->first('reNewPW') }}
                    @endif
                </i>
                </div>
                <button type="submit" id="changePW" class="btn btn-primary px-4">Đổi mật khẩu</button>
            </div>
            
        </form>
    </div>
@endsection