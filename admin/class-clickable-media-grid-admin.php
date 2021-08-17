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
            isset( $_POST['cmg_grid_layout'] ) &&
            isset( $_POST['cmg_images_list_desktop'] ) &&
            isset( $_POST['cmg_images_list_mobile'] ) &&
            isset( $_POST['cmg_buttons_list_mobile'] ) &&
            isset( $_POST['cmg_buttons_list_desktop'] ) ) {

            if ( $this->validate_list( $_POST['cmg_images_list_desktop'], 7 ) == false ||
                $this->validate_list( $_POST['cmg_images_list_mobile'], 7 ) == false ||
                $this->validate_list( $_POST['cmg_buttons_list_mobile'], 14 ) == false ||
                $this->validate_list( $_POST['cmg_buttons_list_desktop'], 14 ) == false ) {

                    $this->form_validation_notice();

            } else {

                $clickable_media_grids = get_option( self::GRIDS_OPTION_NAME );

                $new_grid = array( $_POST['cmg_grid_id'] => array(
                    'layout' => $_POST['cmg_grid_layout'],
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

        <?php $clickable_media_grids = get_option( self::GRIDS_OPTION_NAME ); ?>

        
        <div class="row">
            <div class="col-12">
                <table class="table" style="width: 100%; text-align:center;">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Layout</th>
                            <th scope="col">Images Mobile</th>
                            <th scope="col">Images Desktop</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach( $clickable_media_grids as $cmg_id => $clickable_media_grid ): ?>
                            <tr>
                                <td><?php echo $cmg_id ?></td>
                                <td><?php echo ( isset( $clickable_media_grid['layout'] ) ) ? $clickable_media_grid['layout'] : '-'; ?></td>
                                <td><?php echo $clickable_media_grid['images_desktop'] ?></td>
                                <td><?php echo $clickable_media_grid['images_mobile'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php
    }

    public function grids_section() {
        ?>

        <label class="cmg-settings-label" for="cmg_grid_layout"><?php _e( 'Layout:', 'clickable-media-grid' ) ?></label>
        <select name="cmg_grid_layout" required>
            <option value="1"><?php _e( 'Layout 1 (7 images)', 'clickable-media-grid' ); ?>
        </select>

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

    private function form_validation_notice() {
        ?>
        <div class="notice notice-error">
            <p><?php _e( 'Form is invalid! Check if you have the correct number of images and buttons!', 'clickable-media-grid' ); ?></p>
        </div>
        <?php
    }

    private function validate_list( $list_as_string, $expected_count ) {
        if ( isset( $list_as_string ) == false ) return false;
        $converted_to_array = explode( ',', $list_as_string );

        if ( isset( $converted_to_array ) && count( $converted_to_array ) == $expected_count )
            return true;
        return false;
    }
}