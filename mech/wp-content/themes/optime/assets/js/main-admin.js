;(function ($) {
    "use strict";
    //-------------------------------Javascript frame addition-------------------------------//
    // Select media image by Tony Pro
    $(document).on('click', '.optime-select-image',  function (e) {
        e.preventDefault();
        var $this = $(this);
        var image = wp.media({
            title: 'Upload image',
            multiple: false
        }).open()
            .on('select', function (e) {
                // This will return the selected image from the Media Uploader, the result is an object
                var uploaded_image = image.state().get('selection').first();
                // We convert uploaded_image to a JSON object to make accessing it easier
                // Output to the console uploaded_image
                console.log(uploaded_image.toJSON());
                var image_url = uploaded_image.toJSON().id;
                // Let's assign the url value to the input field
                $this.parent().find('.hide-image-url').val(image_url);
                $this.parent().find('.optime-show-image').empty();
                $this.parent().find('.optime-show-image').append('<img src = "' + uploaded_image.toJSON().url + '">');
                $this.hide();
                $this.parent().find('.optime-remove-image').show();
                $this.parents('form').find('input[name="savewidget"]').removeAttr('disabled');
            });
    });

    $(document).on('click', '.optime-remove-image', function (e) {
        e.preventDefault();
        var $this = $(this);
        $this.parent().find('.hide-image-url').val('');
        $this.parent().find('.optime-show-image').empty();
        $this.hide();
        $this.parent().find('.optime-select-image').show();
        $this.parents('form').find('input[name="savewidget"]').removeAttr('disabled');
    });
})(jQuery);
