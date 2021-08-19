<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class CMG_Clickable_Media_Grid_Admin_Ajax {

    const GRIDS_OPTION_NAME = 'cmg_grids';

    public function __construct() {
        add_action ('wp_ajax_call_cmg_get_cmg_by_id', array( $this, 'get_cmg_by_id' ) );
    }

    public function get_cmg_by_id( ) {
        $id = $_POST['id'];

        $clickable_media_grids = get_option( self::GRIDS_OPTION_NAME );

        if ( isset( $clickable_media_grids ) &&
            is_array( $clickable_media_grids ) &&
            count( $clickable_media_grids ) > 0 ) {

                if ( array_key_exists( $id, $clickable_media_grids ) ) {

                    $clickable_media_grid_to_edit = $clickable_media_grids[ $id ];

                    $buttons_desktop_items = explode( ',', $clickable_media_grid_to_edit['buttons_desktop'] );
                    $buttons_mobile_items = explode( ',', $clickable_media_grid_to_edit['buttons_mobile'] );

                    $buttons = array(
                        "desktop_texts" => array(),
                        "desktop_targets" => array(),
                        "mobile_texts" => array(),
                        "mobile_targets" => array()
                    );

                    for( $x = 0; $x < count( $buttons_desktop_items ); $x++ ) {
                        if ( $x % 2 == 0 ) {
                            array_push( $buttons["desktop_texts"], $buttons_desktop_items[$x] );
                            array_push( $buttons["mobile_texts"], $buttons_mobile_items[$x] );
                        } else {
                            array_push( $buttons["desktop_targets"], $buttons_desktop_items[$x] );
                            array_push( $buttons["mobile_targets"], $buttons_mobile_items[$x] );
                        }
                    }

                    echo json_encode( array(
                        'layout' => $clickable_media_grid_to_edit['layout'],
                        'images_desktop' => $clickable_media_grid_to_edit['images_desktop'],
                        'images_mobile' => $clickable_media_grid_to_edit['images_mobile'],
                        'buttons' => $buttons
                    ) );

                    die();
                }
            }

            echo 1;
            die();

    }

}

