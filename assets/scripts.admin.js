jQuery( document ).ready( function( $ ) {

    var file_frame;
    // var wp_media_post_id = wp.media.model.settings.post.media;

    jQuery( '.upload_image_button' ).on( 'click', function( event ) {
        event.preventDefault();

        let target = jQuery(this).attr('data-target');

        wp.media.model.settings.post.id = 1;
        
        file_frame = wp.media.frames.file_frame = wp.media({
            title: 'Select images to use.',
            button: {
                text: 'Use this image.'
            },
            multiple: true
        });

        file_frame.on( 'select', function() {
            attachment = file_frame.state().get( 'selection' ).toJSON();

            let selected_ids = '';
            attachment.forEach( function( i, idx, array ) {
                selected_ids += i.id
                if ( idx < array.length - 1) {
                    selected_ids += ',';
                }
            });

            $( '#' + target ).val( selected_ids );
        });

        file_frame.open();

    });

});