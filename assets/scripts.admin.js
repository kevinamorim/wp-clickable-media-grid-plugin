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

    jQuery('.cmg-edit-button').on( 'click', function( event ) {

        let id = jQuery(this).attr('data-id');

        $.ajax({
            type: 'POST',
            url: cmg_script.ajax_url,
            data: {
                action: 'call_cmg_get_cmg_by_id',
                id: id
            },
            dataType: 'json'
        }).done( function( data ) {

            console.log(data);
            for( let i = 0; i < data.buttons.desktop_targets.length; i++ ) {
                jQuery( "input[name='cmg-button-text-desktop[" + i + "]" ).val( data.buttons.desktop_texts[i] );
                jQuery( "input[name='cmg-button-url-desktop[" + i + "]" ).val( data.buttons.desktop_targets[i] );
                jQuery( "input[name='cmg-button-text-mobile[" + i + "]" ).val( data.buttons.mobile_texts[i] );
                jQuery( "input[name='cmg-button-url-mobile[" + i + "]" ).val( data.buttons.mobile_targets[i] );
            } 
            
            jQuery( "input[name='cmg_grid_id']" ).val( id );
            jQuery( "select[name='cmg_grid_layout']" ).val( data.layout );
            jQuery( "input[name='cmg_images_list_desktop']" ).val( data.images_desktop );
            jQuery( "input[name='cmg_images_list_mobile']" ).val( data.images_mobile );
            jQuery( "input[name='cmg_buttons_list_desktop']" ).val( data.buttons_desktop );
            jQuery( "input[name='cmg_buttons_list_mobile']" ).val( data.buttons_mobile );
        });
    });

});