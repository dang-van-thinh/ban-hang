

$(document).ready(function() {
// hiển thị ảnh cho người dùng xem trước
    $('#img').on('change',function () {
        let img = $('#img_intro');
        img.attr('src',URL.createObjectURL(this.files[0]));
    })
    // let input =  document.querySelector('#img');
    //     let img =  document.querySelector('#img_intro');
    //     input.addEventListener('change',()=>{
    //         img.src = URL.createObjectURL(input.files[0]);
    //     })



    $('.add-quanity').click(function(e) {
        e.preventDefault();
        let html = `
    <div class="row mt-4 att">
                <div class="col-4">
                    <label for="color" class="form-label fw-bold">Màu sản phẩm</label>
                    <select name="color[]" id="color" class="form-select">
                        <option value="">[Chọn màu sản phẩm]</option>
                        @foreach ($color as $item)
                            <option {{ in_array($item->id, old('color', [])) == $item->id ? 'selected' : '' }} value="{{ $item->id }}">
                                {{ $item->name }}</option>
                        @endforeach
                        <option value="0">Không có</option>
                    </select>
                </div>
                <div class="col-4">
                    <label for="size" class="form-label fw-bold">Size sản phẩm</label>
                    <select name="size[]" id="size" class="form-select">
                        <option value="">[Chọn size sản phẩm]</option>
                        @foreach ($size as $item)
                            <option {{ in_array($item->id, old('size', [])) == $item->id ? 'selected' : '' }} value="{{ $item->id }}">
                                {{ $item->name }}</option>
                        @endforeach
                        <option value="0">Không có</option>
                    </select>
                </div>
                <div class="col-4">
                    <label for="quanity" class="form-label fw-bold">Số lượng sản phẩm</label>
                    <input type="number" min="1" name="quanity[]" id="quanity"
                        placeholder="Nhập số lượng sản phẩm" class="form-control" value="{{ in_array($item->id, old('quanity', [])) }}">
                </div>

            <a href="" onclick="deleteAttribute()" class="btn text-danger btn-danger delete_attribute"><i class="fas fa-backspace"></i></a>

            </div>
   `;
        $(".attribute").append(html);


    });

    function deleteAttribute(e) {
        e.preventDefault();
        alert('hhhh')
    }


});