@extends('admin.layout.main')
@section('content')
    <h4></h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="40px">STT</th>
                <th>Tên sản phẩm</th>
                <th>Giá sản phẩm</th>
                <th>Số lượng</th>
                <th>Size</th>
                <th>Color</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($product as $items)
                <tr>
                    <td>{{ $items->id }}</td>
                    <td>{{ $items->name }}</td>
                    <td>{{ $items->price }}</td>
                    {{-- @foreach ($items->quanity as $quanity_item)
                        <td>{{ $quanity_item->quanity }}</td>
                    @endforeach --}}
                    @foreach ( $productVariant->getProductVariant($items->product_id) as $productVariantItem)
                    @php
                        $id_color = $productVariantItem->color_id;
                        $id_size = $productVariantItem->size_id;
                        $id_product = $items->product_id;
                    @endphp
                        <td> {{ $productVariant->getSizeWithProduct($id_size) }}</td>
                        <td> {{ $productVariant->getColorWithProduct($id_color) }}</td>
                        <td> {{ $productVariant->getQuanityWithProduct($id_color,$id_size,$id_product) }} </td>
                    @endforeach
                    <td>
                        <a href="del-product/{{ $items->id }}" class="btn btn-danger">Xóa</a>
                        <a href="{{ route('admin.product.edit', $items->id ) }}" class="btn btn-warning">Sửa</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
