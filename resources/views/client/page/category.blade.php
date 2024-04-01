@extends('client.layout.main')
@section('content')
    <div class="container mt-3">
        <form id="form_filter_product">
            <div class="row">
                <div class="col-2 border-end">
                    <hr>
                    <div class="mt-3">
                        <input type="hidden" name="" id="methodCategory" data-category="{{ $products['category'] }}"
                            data-orderby="{{ $products['orderBy'] }}">
                        <div class="mt-3">
                            <label for="" class="fw-bold form-label">Thương hiệu:</label> <br>
                            <div class="form-check">
                                <input checked type="checkbox" name="" id="" class="form-check-input">
                                <label for="form-check-label">Nike</label>
                            </div>
                        </div>
                        <hr>
                        <div class="mt-3">
                            <label for="" class="fw-bold form-label">Màu:</label> <br>
                            @foreach ($color as $item)
                                <div class="form-check">
                                    <input type="checkbox" name="color" value="{{ $item->id }}"
                                        id="color_{{ $item->id }}" class="form-check-input">
                                    <label class="bg_color" style="background-color: {{ $item->value }}"
                                        for="color_{{ $item->id }}"></label>
                                </div>
                            @endforeach
                        </div>
                        <hr>
                        <div class="mt-3">
                            <label for="rangePrice" class="form-label">Giá </label>
                            <input type="range" name="rangePrice" class="form-range" min="0" max="1000"
                                value="1000" id="rangePrice">
                            <div class="min-max-price">
                                <span class="min-price">0 VNĐ</span>
                                <span class="max-price">
                                    <output name="maxPrice" id="maxPrice">1000</output>
                                    VNĐ
                                </span>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-primary" id="btn_filter_product" type="button">Lọc</button>
                        </div>
                    </div>
                </div>

                <div class="col-10">
                    <div class="d-flex justify-content-between mx-3 mb-3">
                        <div class="input-group">
                            <button class=" dropdown-toggle btn btn-outline-secondary" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Size
                            </button>
                            <div class="dropdown-menu">
                                <div class="d-flex row p-2">
                                    @foreach ($size as $item)
                                        <div class=" col-1 me-2">
                                            <div class="form-check form-check-inline">
                                                <input name="size" class="form-check-input" type="checkbox"
                                                    id="size_{{ $item->id }}" value="{{ $item->id }}">
                                                <label class="form-check-label" for="size_{{ $item->id }}">
                                                    {{ $item->name }} </label>
                                            </div>
                                        </div>
                                        {{-- end size --}}
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <div class="input-group">
                                <label for="" class="fw-bold input-group-text">Sắp xếp :</label>
                                <select name="orderby" id="orderby" class="form-select">
                                    <option value="1">Giá Cao -> Thấp</option>
                                    <option value="2">Giá Thấp -> Cao</option>
                                    <option value="3">Tên A -> Z</option>
                                    <option value="4">Tên Z -> A</option>
                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="border-top mb-3">
                        <div class="row" id="show_product">
                            @foreach ($products['products'] as $product)
                                <div class="col-lg-3 col-md-6 col-sm-6 col-6 mt-3">
                                    <div class="product">
                                        <a href="{{ route('detailProduct', $product->id) }}">
                                            <div class="image_product ">
                                                <img src="{{ asset($product->img) }}" alt="" class="text-center">
                                            </div>
                                            <div class=" des_product ps-3">
                                                <h5 class="fw-medium text-secondary">{{ $product->name }}</h5>
                                                <p class="text-danger fw-bold">
                                                    {{ number_format($product->price, 0, ',', '.') }} <span>VNĐ</span></p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                {{-- end product  --}}
                            @endforeach
                        </div>
                        <div class="mt-4">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    @for ($i = 1; $i <= $numberPage; $i++)
                                        <li class="page-item">
                                            <a class="page-link item-page" data-orderby="{{ $products['orderBy'] }}"
                                                data-category="{{ $products['category'] }}"
                                                data-page="{{ $i }}" data-limit="12" href="#">
                                                {{ $i }} </a>
                                        </li>
                                    @endfor
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#rangePrice').change(() => {
                $('#maxPrice').text($('#rangePrice').val())
            })


            $('.item-page').click(function(e) {
                e.preventDefault()
                let _this = $(this);
                let page = _this.data('page');
                let limit = _this.data('limit');
                let offsets = Number((page - 1) * limit);
                let category = _this.data('category');
                let orderBy = _this.data('orderby');
                console.log(orderBy);
                itemForPage(offsets, limit, category, orderBy);
            });

            function itemForPage(offset, limit, category, orderBy) {
                let data = {
                    offset: offset,
                    limit: limit,
                    category: category,
                    orderBy: orderBy
                };
                let html = '';
                $.ajax({
                    type: "GET",
                    url: "{{ route('ajaxProductOffset') }}",
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        console.log(response);
                        let html = '';
                        response.products.forEach(el => {
                            let price = el.price.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                            html += `
                            <div class="col-lg-3 col-md-6 col-sm-6 col-6 mt-3">
                                    <div class="product">
                                        <a href="{{ asset('detail-product/${el.id}') }}">
                                            <div class="image_product ">
                                                <img src="{{ asset('${el.img}') }}" alt="" class="text-center">
                                            </div>
                                            <div class=" des_product ps-3">
                                                <h5 class="fw-medium text-secondary">${el.name}</h5>
                                                <p class="text-danger fw-bold">
                                                    ${price} <span>VNĐ</span></p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            `;
                        });
                        $('#show_product').html(html)
                    },
                    error: function(er) {
                        console.log('sai');
                    }
                });
            }
            $('#orderby').change(function() {
                // e.preventDefault()
                filterProduct();
            });
            $('#btn_filter_product').click(function(e){
                e.preventDefault();
                filterProduct();
            })

            function filterProduct() {
                let category = $('#methodCategory').data('category');
                let colorChecked = $('input[name=color]:checked');
                let sizeChecked = $('input[name=size]:checked');
                let color = [];
                let size = [];
                // let price = $('#rangePrice').val();
                let price = 5000000;
                let orderby = $('#orderby').val();
                console.log(colorChecked);
                if (colorChecked.length > 0) {
                    for (const item of colorChecked) {
                        color.push(item.value);
                    }
                } else {
                    color = null;
                }

                if (sizeChecked.length > 0) {
                    for (const item of sizeChecked) {
                        size.push(item.value);
                    }
                } else {
                    size = null;
                }

                let data = {
                    color: color,
                    size: size,
                    price: price,
                    orderby: orderby,
                    category: category
                }
                $.ajax({
                    type: "GET",
                    url: "{{ route('ajaxProductFilter') }}",
                    data: data,
                    dataType: "json",
                    success: function(res) {
                        console.log(res.products);
                        let html = '';
                        res.products.forEach(el => {
                            let price = el.price.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                            html += `
                            <div class="col-lg-3 col-md-6 col-sm-6 col-6 mt-3">
                                    <div class="product">
                                        <a href="{{ asset('detail-product/${el.id}') }}">
                                            <div class="image_product ">
                                                <img src="{{ asset('${el.img}') }}" alt="" class="text-center">
                                            </div>
                                            <div class=" des_product ps-3">
                                                <h5 class="fw-medium text-secondary">${el.name}</h5>
                                                <p class="text-danger fw-bold">
                                                    ${price} <span>VNĐ</span></p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            `;
                        });
                        $('#show_product').html(html)
                    }
                });
            }
        });
    </script>
@endsection
