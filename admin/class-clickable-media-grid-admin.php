<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class CMG_Clickable_Media_Grid_Admin {

    const GRIDS_OPTION_NAME = 'cmg_grids';
    const LAYOUT_CONFIGS = array(
        "1" => array(
            "items" => 7
        ),
        "2" => array(
            "items" => 8
        )
    );

    private $page_slug;
    private $choosed_layout_id;

    public function __construct() {
        $this->page_slug = 'clickable-media-grid-settings';

        if ( isset( $_GET['layout'] ) ) {
            $this->choosed_layout_id = $_GET['layout'];
        } else {
            $this->choosed_layout_id = 1;
        }

        add_action( 'admin_menu', array( $this, 'create_menu_page' ) );
        add_action( 'admin_init', array( $this, 'render_fields' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
    }

    public function enqueue_scripts() {
        wp_enqueue_script( 'cmg-admin-scripts', plugin_dir_url( __FILE__ ) . '../assets/scripts.admin.js', array( 'jquery' ), false, true );
        wp_localize_script( 'cmg-admin-scripts', 'cmg_script', array( 
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            ) 
        );
        wp_set_script_translations( 'cmg-admin-scripts', 'clickable-media-grid' );
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
            isset( $_POST['cmg-button-text-desktop'] ) &&
            isset( $_POST['cmg-button-url-desktop'] ) &&
            isset( $_POST['cmg-button-text-mobile'] ) &&
            isset( $_POST['cmg-button-url-mobile'] ) ) {

            if ( $this->validate_list( $_POST['cmg_images_list_desktop'], self::LAYOUT_CONFIGS[$this->choosed_layout_id]["items"] ) == false ||
                $this->validate_list( $_POST['cmg_images_list_mobile'], self::LAYOUT_CONFIGS[$this->choosed_layout_id]["items"] ) == false ) {
                    $this->form_validation_notice();
            } else {

                $clickable_media_grids = get_option( self::GRIDS_OPTION_NAME );

                $cmg_buttons_list_desktop = $this->convert_buttons_input_to_comma_sep_string( 
                    $_POST['cmg-button-text-desktop'], $_POST['cmg-button-url-desktop'] );

                $cmg_buttons_list_mobile = $this->convert_buttons_input_to_comma_sep_string(
                    $_POST['cmg-button-text-mobile'], $_POST['cmg-button-url-mobile']
                );

                if ( array_key_exists( $_POST['cmg_grid_id'], $clickable_media_grids ) ) {

                    // Update existing.
                    $id = $_POST['cmg_grid_id'];
                    $clickable_media_grids[ $id ]['layout'] = $_POST['cmg_grid_layout'];
                    $clickable_media_grids[ $id ]['images_desktop'] = $_POST['cmg_images_list_desktop'];
                    $clickable_media_grids[ $id ]['images_mobile'] = $_POST['cmg_images_list_mobile'];

                    $clickable_media_grids[ $id ]['buttons_desktop'] = $cmg_buttons_list_desktop;
                    $clickable_media_grids[ $id ]['buttons_mobile'] = $cmg_buttons_list_mobile;

                } else {

                    $new_grid = array( $_POST['cmg_grid_id'] => array(
                        'layout' => $_POST['cmg_grid_layout'],
                        'images_desktop' => $_POST['cmg_images_list_desktop'],
                        'images_mobile' => $_POST['cmg_images_list_mobile'],
                        'buttons_desktop' => $cmg_buttons_list_desktop,
                        'buttons_mobile' => $cmg_buttons_list_mobile,
                    ));
        
                    if ( is_array( $clickable_media_grids ) && 
                        count( $clickable_media_grids ) > 0 ) {
                        $clickable_media_grids = $clickable_media_grids + $new_grid;
                    } else {
                        $clickable_media_grids = $new_grid;
                    }

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
                            <th scope="col">Images Desktop</th>
                            <th scope="col">Images Mobile</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ( isset( $clickable_media_grids ) && 
                            is_array( $clickable_media_grids ) && 
                            count( $clickable_media_grids ) > 0 ): ?>
                            <?php foreach( $clickable_media_grids as $cmg_id => $clickable_media_grid ): ?>
                                <tr>
                                    <td><?php echo $cmg_id ?></td>
                                    <td><?php echo ( isset( $clickable_media_grid['layout'] ) ) ? $clickable_media_grid['layout'] : '-'; ?></td>
                                    <td><?php echo $clickable_media_grid['images_desktop'] ?></td>
                                    <td><?php echo $clickable_media_grid['images_mobile'] ?></td>
                                    <td><a class="button cmg-edit-button" data-id="<?php echo $cmg_id; ?>">Editar</a></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php
    }

    public function grids_section() {

        wp_enqueue_media();

        ?>

        <label class="cmg-settings-label" for="cmg_grid_layout"><?php _e( 'Layout:', 'clickable-media-grid' ) ?></label>
        <select name="cmg_grid_layout" id="cmg_grid_layout" required>
            <option value="1" <?php if ( $this->choosed_layout_id == 1 ): ?> selected="selected" <?php endif; ?>><?php _e( 'Layout 1 (7 images)', 'clickable-media-grid' ); ?>
            <option value="2" <?php if ( $this->choosed_layout_id == 2 ): ?> selected="selected" <?php endif; ?>><?php _e( 'Layout 2 (8 images)', 'clickable-media-grid' ); ?>
        </select>
        <input type="button" class="button" id="cmg-select-layout-btn" value="<?php _e( 'Choose Layout', 'clickable-media-grid' ) ?>" />

        <label class="cmg-settings-label" for="cmg_grid_id"><?php _e( 'ID:', 'clickable-media-grid' ) ?></label>
        <input type="text" name="cmg_grid_id" required/>

        <label class="cmg-settings-label" for="cmg_images_list_desktop"><?php _e( 'Images List (Desktop):', 'clickable-media-grid' ) ?></label>
        <input type="text" name="cmg_images_list_desktop" id="cmg_images_list_desktop" required/>
        <input type="button" class="button upload_image_button" data-target="cmg_images_list_desktop" value="<?php _e( 'Select images', 'clickable-media-grid' ); ?>" />

        <label class="cmg-settings-label" for="cmg_images_list_mobile"><?php _e( 'Images List (Mobile):', 'clickable-media-grid' ) ?></label>
        <input type="text" name="cmg_images_list_mobile" id="cmg_images_list_mobile" required/>
        <input type="button" class="button upload_image_button" data-target="cmg_images_list_mobile" value="<?php _e( 'Select images', 'clickable-media-grid' ); ?>" />

        <!-- DESKTOP -->
        <h3><?php _e( 'DESKTOP BUTTONS', 'clickable-media-grid' ); ?></h3>
        <?php for ( $x = 0; $x < self::LAYOUT_CONFIGS[$this->choosed_layout_id]["items"]; $x++ ): ?>
            
            <div class="row">
                <label 
                    class="cmg-settings-label" 
                    for="cmg-button-text-desktop[<?php echo $x ?>]">
                        <?php echo sprintf( __( 'Button Text (%s)', 'clickable-media-grid' ), $x + 1 ); ?>:
                </label>
                <input type="text" name="cmg-button-text-desktop[<?php echo $x ?>]" id="cmg-button-text-desktop[<?php echo $x ?>]" required />



                <label 
                    class="cmg-settings-label" 
                    for="cmg-button-url-desktop[<?php echo $x ?>]">
                        <?php echo sprintf( __( 'Target URL: (%s)', 'clickable-media-grid' ), $x + 1 ); ?>:
                </label>
                <input style="width:50%;" type="text" name="cmg-button-url-desktop[<?php echo $x ?>]" id="cmg-button-url-desktop[<?php echo $x ?>]" required />
            </div>

        <?php endfor; ?>

        <!-- MOBILE -->
        <h3><?php _e( 'MOBILE BUTTONS', 'clickable-media-grid' ); ?></h3>
        <?php for ( $x = 0; $x < self::LAYOUT_CONFIGS[$this->choosed_layout_id]["items"]; $x++ ): ?>
            
            <div class="row">
                <label 
                    class="cmg-settings-label" 
                    for="cmg-button-text-mobile[<?php echo $x ?>]">
                        <?php echo sprintf( __( 'Button Text (%s)', 'clickable-media-grid' ), $x + 1 ); ?>:
                </label>
                <input type="text" name="cmg-button-text-mobile[<?php echo $x ?>]" id="cmg-button-text-mobile[<?php echo $x ?>]" required />



                <label 
                    class="cmg-settings-label" 
                    for="cmg-button-url-mobile[<?php echo $x ?>]">
                        <?php echo sprintf( __( 'Target URL: (%s)', 'clickable-media-grid' ), $x + 1 ); ?>:
                </label>
                <input style="width:50%;" type="text" name="cmg-button-url-mobile[<?php echo $x ?>]" id="cmg-button-url-mobile[<?php echo $x ?>]" required />
            </div>

        <?php endfor; ?>

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

    private function convert_buttons_input_to_comma_sep_string( $buttons_texts, $buttons_target_urls ) {
        $result = "";
        for ( $x = 0; $x < count( $buttons_texts ); $x++ ) {
            if ( $x == 0 ) {
                $result .= $buttons_texts[$x];
            } else {
                $result .= ',' . $buttons_texts[$x];
            }

            $result .= ',' . $buttons_target_urls[$x];
        }
        return $result;
    }
}