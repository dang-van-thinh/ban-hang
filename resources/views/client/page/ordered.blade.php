{{-- <button hidden  type="button" class="btn btn-primary btn_ordered_popup" data-bs-toggle="modal"
    data-bs-target="#orderedPopup"></button>  --}}
    @extends('client.layout.main')
    @section('content')
    <div class="mx-auto" id="orderedPopup" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">

        <div class="box_ordered">
            <div class="card w-75">
                <div class="card-body mx-auto">
                    <img src="{{ asset('img/custom/done.png') }}" alt="" width="400px">
                    <div>
                        <div class="text-center mt-4">
                            <h4 class="mb-2">Cảm ơn quý khách !</h4>
                            <p>Rất hân hạnh được phụ vụ quý khách </p>
                        </div>
                        <div class="d-flex justify-content-evenly my-5">
                            <a href="{{route('bill',$id)}}" class="btn btn-outline-secondary p-3 w-50 mx-2">Xem hóa đơn</a>
                            <a href="{{ route('home') }}" class="btn btn-danger w-75 p-3">Tiếp tục mua hàng</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
