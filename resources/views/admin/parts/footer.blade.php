<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="{{asset('backend/asset/js/script.js')}}"></script>
<script src="{{ asset('backend/asset/js/product_ajax.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
<script>
   $(document).ready(function () {
    $('.summernote').each(function () {
        $(this).summernote({
            height: 300,                 
            tabsize: 2,
            placeholder: $(this).data('placeholder'), // lấy placeholder từ HTML
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });
});

</script>