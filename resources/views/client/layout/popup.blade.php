<button hidden type="button" class="btn btn-primary btn_pop_up" data-bs-toggle="modal"
    data-bs-target="#exampleModal"></button>

<div class="modal fade overlay-popup" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="img-popup">
                    <img src="{{ asset('img/custom/done.png') }}" alt="">
                </div>
                <div class="text-center pt-5">
                    <p>Thêm sản phẩm vào giỏ hàng thành công</p>
                </div>
            </div>
            <div class="py-4">
                <div class="text-center">
                    <button type="button" class="btn btn-success w-50" data-bs-dismiss="modal">Oke</button>
                </div>
            </div>

        </div>
    </div>
</div>
