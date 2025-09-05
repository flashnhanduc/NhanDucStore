@extends('admin.main')
@section('content')
    <form action="" enctype="multipart/form-data" method="post">
        <div class="admin-content-main-content-product-add">
            <div class="admin-content-main-content-left">
                <div class="admin-content-main-content-two-input">
                    <input type="text" value="{{ $product->name}}" name="name" placeholder="Tên sản phẩm">
                    <input type="text" value="{{ $product->material}}" name="material" placeholder="Chất liệu">
                </div>
                <div class="admin-content-main-content-two-input">
                    <input type="text" value="{{ $product->price_normal }}" name="price_normal" placeholder="Giá bán ">
                    <input type="text" value="{{ $product->price_sale }}" name="price_sale" placeholder="Giá giảm">
                </div>
                <textarea class="summernote" value="" name="description"
                    placeholder="Đặc điểm nổi bật">{{ $product->description }}</textarea>
                <textarea class="summernote" value="" name="content"
                    placeholder="Mô tả sản phẩm">{{$product->content  }}</textarea>

                <button type="submit" class="main-btn">Cập Nhật Sản Phẩm</button>
            </div>
            <div class="admin-content-main-content-right">
                <div class="admin-content-main-content-right-image">
                    <label for="file">Ảnh Đại Diện</label>
                    <input style="display: none;" id="file" type="file">
                    <input type="hidden" name="image" value="{{$product->image}}" id="input-file-img-hiden">
                    <div class="image-show" id="input-file-img">
                        <img src="{{ asset($product->image) }}" alt="">

                    </div>
                </div>
                <div class="admin-content-main-content-right-images">
                    <label for="files">Ảnh Sản phẩm </label>
                    <input style="display: none;" id="files" type="file" multiple>
                    <div class="images-show" id="input-file-imgs">
                        @php
                            $product_images = explode("#", $product->images);
                           @endphp
                        @foreach ($product_images as $product_image)
                            <img src="{{ asset($product_image) }}" alt="">
                            <input type="hidden" name="images[]" value="{{$product_image}}" id="input-file-img-hiden">
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @csrf
    </form>
@endsection