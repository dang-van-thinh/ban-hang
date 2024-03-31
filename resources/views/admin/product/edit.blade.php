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
    <form action="{{ route('admin.product.update', $products[0]->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <h3> {{ $products[0]->id }} </h3>
            <div class="col-md-6">
                <div class="mt-3">
                    <label for="name" class="form-label fw-bold">Tên sản phẩm</label>
                    <input type="text" name="name" id="name" placeholder="Nhập tên sản phẩm" class="form-control"
                        value=" {{ old('name', $products[0]->name) }}">
                </div>
                <div class="mt-3">
                    <label for="price" class="form-label fw-bold">Giá sản phẩm</label>
                    <input type="number" min="1000" name="price" id="price" placeholder="Nhập giá sản phẩm"
                        class="form-control" value="{{ old('price', $products[0]->price) }}">
                </div>
                <div class="mt-3">
                    <label for="price_sale" class="form-label fw-bold">Giá khuyến mãi </label>
                    <input type="number" min="0" name="price_sale" id="price_sale"
                        placeholder="Nhập giá khuyến mãi sản phẩm" class="form-control"
                        value="{{ old('price_sale', $products[0]->price_sale) }}">
                </div>
                <div class="mt-3 attribute">
                    @for ($i = 0; $i < $number_variant; $i++)
                        <div class="row mt-4">
                            <div class="col-4">
                                <label for="color" class="form-label fw-bold">Màu sản phẩm</label>
                                <select name="color[]" id="color" class="form-select">
                                    <option value="">[Chọn màu sản phẩm]</option>
                                    @foreach ($color as $item)
                                        <option {{ $products[$i]->idColor == $item->id ? 'selected' : '' }}
                                            value="{{ $item->id }}">
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
                                        <option {{ $products[$i]->idSize == $item->id ? 'selected' : '' }}
                                            value="{{ $item->id }}">
                                            {{ $item->name }}</option>
                                    @endforeach
                                    <option value="0">Không có</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <label for="quanity" class="form-label fw-bold">Số lượng sản phẩm</label>
                                <input type="number" min="1" name="quanity[]" id="quanity"
                                    placeholder="Nhập số lượng sản phẩm" class="form-control"
                                    value="{{ $products[$i]->quanityProduct }}">
                            </div>
                        </div>
                    @endfor
                </div>
                <a href="" class="btn text-primary mt-3 add-quanity"><i class="fas fa-arrow-down"></i></a>
            </div>
            <div class="col-md-6">
                <div class="mt-3">
                    <label for="category">Danh mục sản phẩm</label>
                    <select name="category_id" id="category" class="form-select" value="{{ old('category_id') }}">
                        <option value="">[Chọn danh mục sản phẩm]</option>
                        @foreach ($category as $item)
                            <option
                                {{ (old('category_id') ? old('category_id') : $products[0]->category_id) == $item->id ? 'selected' : '' }}
                                value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-3">
                    <label for="img" class="form-label fw-bold">Ảnh sản phẩm</label>
                    <img src="{{ asset($products[0]->img) }}" alt="" width="100px">
                    <input type="text" hidden name="img" id="img" value="{{ $products[0]->img }}">
                    <input type="file" name="img2" id="img" class="">
                </div>
                <div class="mt-3">
                    <label for="description">Mô tả sản phẩm</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control"
                        placeholder="Nhập mô tả cho sản phẩm">{{ old('description', $products[0]->description) }}</textarea>
                </div>
            </div>
            <div class="mt-3 input-group">
                <a href="{{ route('admin.product.index') }}" class="btn btn-primary">Quay lại</a>
                <input type="submit" value="Thay đổi" class="btn btn-success">
            </div>
        </div>
    </form>
    <script src="{{ asset('plugins/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('description', {
            height: 450,
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $('.add-quanity').click(function(e) {
            e.preventDefault();
            let html = `
            <div class="row mt-4">
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
                                placeholder="Nhập số lượng sản phẩm" class="form-control" value="">
                        </div>
                    </div>
           `;
            $(".attribute").append(html);
        });
    </script>
@endsection
