$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('#file').on('change', () => {
    var formData = new FormData();
    var file = $('#file')[0].files[0];
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
    formData.append('file', file);

    $.ajax({
        url: '/upload',
        processData: false, // tránh lỗi illegal invocation
        dataType: 'json',
        data: formData,
        method: 'POST',
        contentType: false, // không hiển thị preview
        success: function(result) {
            // console.log(result)
            if (result.success == true) {
                html = '';
                html += '<img src="' + result.path + '" alt="">';
                $('#input-file-img').html(html);
                $('#input-file-img-hiden').val(result.path);
            }
        }
    });
});

// THÊM ẢNH SẢN PHẨM
$('#files').on('change', () => {
    var formData = new FormData();
    var files = $('#files')[0].files;
    for (let index = 0; index < files.length; index++) {
        formData.append('files[]', files[index]);
    }

    $.ajax({
        url: '/uploads',
        method: 'POST',
        dataType: 'JSON',
        data: formData,
        contentType: false,
        processData: false,
        success: function(result) {
            // console.log(result)
            if (result.success == true)
            {
                html =''
                for (let index = 0; index < result.paths.length; index++) {
                    html+='<img src = "'+result.paths[index] + '"alt =""><input type ="hidden" value="'+result.paths[index]+'" class="product-images" name ="images[]">'
                    $('#input-file-imgs').html(html)
                }
                    
            }
        }
    })
})
function removeRow(product_id, url) {
    if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) {
        $.ajax({
            url: url,
            method: 'DELETE', 
            data: { 
                _token: $('meta[name="csrf-token"]').attr('content') 
            },
            dataType: 'JSON',
            success: function (res) {
                if(res.success == true) {
                    location.reload();
                } else {
                    alert('Lỗi: Không thể xóa sản phẩm này!');
                }
            },
            error: function (xhr) {
                alert('Có lỗi hệ thống xảy ra. Vui lòng kiểm tra lại F12.');
            }
        });
    }
}





