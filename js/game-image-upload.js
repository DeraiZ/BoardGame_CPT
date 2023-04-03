jQuery(document).ready(function($) {
    $('#game_image_upload_button').click(function(e) {
        e.preventDefault();
        var image = wp.media({
            title: 'Upload Image',
            multiple: false
        }).open().on('select', function(e) {
            var uploaded_image = image.state().get('selection').first();
            var image_url = uploaded_image.toJSON().url;
            $('#game_image').val(image_url);
            $('#game_image_preview').html('<img src="' + image_url + '">');
        });
    });
});