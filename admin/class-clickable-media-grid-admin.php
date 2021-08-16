<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class CMG_Clickable_Media_Grid_Admin {

    const GRIDS_OPTION_NAME = 'cmg_grids';

    private $page_slug;

    public function __construct() {
        $this->page_slug = 'clickable-media-grid-settings';

        add_action( 'admin_menu', array( $this, 'create_menu_page' ) );
        add_action( 'admin_init', array( $this, 'render_fields' ) );
    }

    public function create_menu_page() {
        add_menu_page(
            __( 'Clickable Media Grid', 'clickable-media-grid' ),
            __( 'Clickable Media Grid', 'clickable-media-grid' ),
            'read',
            $this->page_slug,
            array( $this, 'cmg_settings_page' )
        );
    }

    public function render_fields() {
        add_settings_section(
            'grids_section',
            __( 'Grids', 'clickable-media-grid' ),
            array( $this, 'grids_section' ),
            $this->page_slug
        );
    }

    public function cmg_settings_page() {

        if ( isset( $_POST['cmg_grid_id'] ) && 
            isset( $_POST['cmg_images_list_desktop'] ) &&
            isset( $_POST['cmg_images_list_mobile'] ) &&
            isset( $_POST['cmg_buttons_list_mobile'] ) &&
            isset( $_POST['cmg_buttons_list_desktop'] ) ) {

            $clickable_media_grids = get_option( self::GRIDS_OPTION_NAME );

            $new_grid = array( $_POST['cmg_grid_id'] => array(
                'images_desktop' => $_POST['cmg_images_list_desktop'],
                'images_mobile' => $_POST['cmg_images_list_mobile'],
                'buttons_desktop' => $_POST['cmg_buttons_list_desktop'],
                'buttons_mobile' => $_POST['cmg_buttons_list_mobile'],
            ));

            if ( is_array( $clickable_media_grids ) && 
                count( $clickable_media_grids ) > 0 ) {
                $clickable_media_grids = $clickable_media_grids + $new_grid;
            } else {
                $clickable_media_grids = $new_grid;
            }

            update_option( self::GRIDS_OPTION_NAME, $clickable_media_grids );

        }

        ?>

        <div class="row">
            <div class="col-12">
                <form method="post" name="createClickableMediaGrid">

                    <?php do_settings_sections( $this->page_slug ); ?>
                    <hr />

                    <button type="submit" class="btn btn-success cmg-settings-submit-button"><?php _e( 'Save', 'clickable-media-grid' ); ?></button>
                </form>
            </div>
        </div>

        <?php
    }

    public function grids_section() {
        ?>

        <label class="cmg-settings-label" for="cmg_grid_id"><?php _e( 'ID:', 'clickable-media-grid' ) ?></label>
        <input type="text" name="cmg_grid_id" required/>

        <label class="cmg-settings-label" for="cmg_images_list_desktop"><?php _e( 'Images List (Desktop):', 'clickable-media-grid' ) ?></label>
        <input type="text" name="cmg_images_list_desktop" required/>

        <label class="cmg-settings-label" for="cmg_images_list_mobile"><?php _e( 'Images List (Mobile):', 'clickable-media-grid' ) ?></label>
        <input type="text" name="cmg_images_list_mobile" required/>

        <label class="cmg-settings-label" for="cmg_buttons_list_desktop"><?php _e( 'Buttons List (Desktop):', 'clickable-media-grid' ) ?></label>
        <input type="text" name="cmg_buttons_list_desktop" required/>

        <label class="cmg-settings-label" for="cmg_buttons_list_mobile"><?php _e( 'Buttons List (Mobile):', 'clickable-media-grid' ) ?></label>
        <input type="text" name="cmg_buttons_list_mobile" required/>

        <?php
    }
}