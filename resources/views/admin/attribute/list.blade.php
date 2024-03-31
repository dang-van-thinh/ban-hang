@extends('admin.layout.main')
@section('content')
    <div class="row">
        <div class="col-6">
            <h4 class="mt-3 fw-bold">Bảng Màu Sắc</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td width="40px">STT</td>
                        <td>Tên thuộc tính</td>
                        <td>Giá trị</td>
                        <td>
                            <a href="{{route('admin.att.create')}}" class="btn btn-primary">Thêm mới </a>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($color as $item)
                        <tr>
                            <td>{{ $item->id }} </td>
                            <td>{{ $item->name }} </td>
                            <td>{{ $item->value }} </td>
                            <td>
                                <a href="{{route('admin.att.editColor',$item->id)}}" class="btn btn-warning">Sửa</a>
                                <a href="{{route('admin.att.editColor',$item->id)}}" class="btn btn-danger">Xóa</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <div class="col-6">
            <h4 class="mt-3 fw-bold">Bảng Cỡ</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td>STT</td>
                        <td>Tên thuộc tính</td>
                        <td>
                            <a href="{{route('admin.att.create')}}" class="btn btn-primary">Thêm mới </a>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($size as $item)
                        <tr>
                            <td width="40px">{{ $item->id }} </td>
                            <td>{{ $item->name }} </td>
                            <td>
                                <a href="{{route('admin.att.editSize',$item->id)}}" class="btn btn-warning">Sửa</a>
                                <a href="{{route('admin.att.delSize',$item->id )}}" class="btn btn-danger"> Xóa </a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
