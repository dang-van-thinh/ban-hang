@extends('admin.layout.main')
@section('content')
    <h4></h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="80px">Mã hóa đơn</th>
                <th width="180px">Thời gian</th>
                <th width="200px">Tên khách hàng</th>
                <th width="200px">Email</th>
                <th width="200px">Trạng thái</th>
                <th width="">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bills as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>
                        <select name="status" {{ ($item->status == 5 || $item->status == 0 ? true : false ) ? 'disabled ' : '' }} 
                            class="form-select status"
                            data-url="{{route('ajaxUpdateStatus')}}"
                            data-id="{{$item->id}}">
                            <option {{ $item->status == 0 ? 'selected' : '' }} value="0">Hủy đơn hàng</option>
                            <option {{ $item->status == 1 ? 'selected' : '' }} value="1">Đang xử lý</option>
                            <option {{ $item->status == 2 ? 'selected' : '' }} value="2">Đã xử lý</option>
                            <option {{ $item->status == 3 ? 'selected' : '' }} value="3">Đang vận chuyển</option>
                            <option {{ $item->status == 4 ? 'selected' : '' }} value="4">Đang giao hàng</option>
                            <option {{ $item->status == 5 ? 'selected' : '' }} value="5">Đã giao</option>
                        </select>
                    </td>
                    <td>
                        <button type="button" 
                            data-id_bill="{{ $item->id }}"
                            data-urlimg="{{asset('')}}"
                            data-urldetail="{{ route('ajaxDetail') }}" class="btn btn_detail_bill btn-primary"
                            data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            Xem chi tiết
                        </button>
                        {{-- <a href="" class="btn btn-warning">Sửa</a> --}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            @for ($i = 1; $i <= $numberPage; $i++)
                <li class="page-item"><a class="page-link" href="{{ route('admin.bill.index', $i) }}">
                        {{ $i }} </a></li>
            @endfor
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav> --}}
    
    {{$bills->links()}}

    @include('admin.bill.detail')
@endsection
