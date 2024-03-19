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
        <form action="{{route('admin.att.update',$color->id)}}" method="post" id="" class="value1">
            @csrf
            <input type="text" name="att" value="color" hidden id="">
            <div class="mt-3">
                <label for="name" class="form-label">Tên</label>
                <input type="text" value="{{ $color->name}}" name="name" class="form-control" placeholder="Nhập tên">
            </div>
            <div class="mt-3">
                <label for="name" class="form-label">Giá trị</label>
                <input type="color" value="{{ $color->value}}" name="value" class="form-control">
            </div>
            <button type="submit" class="btn btn-success mt-3">Thay đổi</button>
        </form>
    </div>
@endsection

