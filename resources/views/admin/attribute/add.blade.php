@extends('admin.layout.main')
@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="w-25">
        <label for="att" class="">Lựa chọn thuộc tính cần thêm</label>
        <select name="att" id="att" class="form-select">
            <option value="1" id="color">Thêm mới màu</option>
            <option value="2" id="size">Thêm mới size</option>
        </select>
        <form action="{{route('admin.att.store')}}" method="post" id="" class="value1">
            @csrf
            <input type="text" name="att" value="color" hidden id="">
            <div class="mt-3">
                <label for="name" class="form-label">Tên</label>
                <input type="text" name="name" class="form-control" placeholder="Nhập tên">
            </div>
            <div class="mt-3">
                <label for="name" class="form-label">Giá trị</label>
                <input type="color" name="value" class="form-control">
            </div>
            <button type="submit" class="btn btn-success mt-3">Thêm</button>
        </form>
        <form action="{{route('admin.att.store')}}" method="post" class="value2" style="display:none">
            @csrf
            <input type="text" name="att" value="size" hidden id="">
            <div class="mt-3">
                <label for="name" class="form-label">Tên</label>
                <input type="text" name="name" class="form-control" 
                placeholder="Nhập tên">
            </div>
            <button type="submit" class="btn btn-success mt-3">Thêm</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js
    "></script>
    <script>
        $('#att').change(function () { 
          let value =  $(this).val()
          if(value == 1){
            $('.value1').show()
            $('.value2').hide()
          }else{
            $('.value1').hide()
            $('.value2').show()
          }
        });
        </script>
@endsection

