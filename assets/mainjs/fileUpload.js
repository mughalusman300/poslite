$(document).on("click", ".btn-browse", function (e) {
    $(this).parents('.upload-row').find('.attachment-file').click();
});
$(document).on("change", ".attachment-file", function (e) {
	readURL(this);
});
//Image preview chang according extention    
function readURL(input) {
    if (input.files && input.files[0]) {
        var url = input.value;
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();

        var parent = $(input).parents('.upload-row:first');
        if (ext == 'docx' || ext == 'doc') {
            $(parent).find('.img-preview').attr('src', base + 'assets/images/doc.png');
            $(parent).find('.img-preview').show();
            $(parent).find('.remove-img').show();

            $(parent).find('.btn-browse').hide();
        } else if (ext == 'pdf') {
            $(parent).find('.img-preview').attr('src', base + 'assets/images/pdf.png');
            $(parent).find('.img-preview').show();
            $(parent).find('.remove-img').show();

            $(parent).find('.btn-browse').hide();
        } else if (ext == 'xlsx') {
            $(parent).find('.img-preview').attr('src', base + 'assets/images/xlsx.jpg');
            $(parent).find('.img-preview').show();
            $(parent).find('.remove-img').show();

            $(parent).find('.btn-browse').hide();
        } else if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(parent).find('.img-preview').attr('src', e.target.result);
                $(parent).find('.img-preview').show();
                $(parent).find('.remove-img').show();

                $(parent).find('.btn-browse').hide();
            }

            reader.readAsDataURL(input.files[0]);
        } else {
            $(parent).find('.img-preview').attr('src', base + 'assets/images/no-image.png');
            $(parent).find('.img-preview').show();
            $(parent).find('.remove-img').show();

            $(parent).find('.btn-browse').hide();
        }
    }
}