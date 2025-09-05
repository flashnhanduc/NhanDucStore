@extends('admin.main')
@section('content')
    <form action="/admin/product/add" enctype="multipart/form-data" method="post">
        <div class="admin-content-main-content-product-add">
            <div class="admin-content-main-content-left">
                <div class="admin-content-main-content-two-input">
                    <input type="text" value="{{ old('name') }}" name="name" placeholder="Tên sản phẩm">
                    <input type="text" value="{{ old('material') }}" name="material" placeholder="Chất liệu">
                </div>
                <div class="admin-content-main-content-two-input">
                    <input type="text" value="{{ old('price_normal') }}" name="price_normal" placeholder="Giá bán ">
                    <input type="text" value="{{ old('price_sale') }}" name="price_sale" placeholder="Giá giảm">
                </div>
                <textarea class="summernote" value="{{ old('description') }}" name="description" placeholder="Đặc điểm nổi bật"></textarea>
                <textarea class="summernote" value="{{ old('content') }}"v name="content" placeholder="Mô tả sản phẩm"></textarea>

                <button type="submit" class="main-btn">Thêm Sản Phẩm</button>
            </div>
            <div class="admin-content-main-content-right">
                <div class="admin-content-main-content-right-image">
                    <label for="file">Ảnh Đại Diện</label>
                    <input style="display: none;" id="file" type="file">
                    <input type="hidden" name="image" id="input-file-img-hiden">
                    <div class="image-show" id="input-file-img">

                    </div>
                </div>
                <div class="admin-content-main-content-right-images">
                    <label for="files">Ảnh Sản phẩm </label>
                    <input style="display: none;" id="files" type="file" multiple>
                    <div class="images-show" id="input-file-imgs">

                    </div>
                </div>
            </div>
        </div>
        @csrf
    </form>
@endsection