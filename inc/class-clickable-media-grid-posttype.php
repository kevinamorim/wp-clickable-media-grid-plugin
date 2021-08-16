<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class CMG_Media_Grid_Type {

    const GRIDS_OPTION_NAME = 'cmg_grids';

    public function __construct() {
        add_shortcode( 'cmg_display_grid', array( $this, 'display_grid') );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
    }

    public function enqueue_styles() {
        wp_enqueue_style( 'cmg-styles', plugin_dir_url( __FILE__ ) . '../assets/styles.css', array(), '' );
    }

    public function display_grid( $attrs ) {

        ob_start();

        $grid_id = $attrs['id'];

        $options = get_option( self::GRIDS_OPTION_NAME );

        $images_ids = explode( ',', $options[ $grid_id ]['images'] );

        $template_file = 'frontend-template-1.php';

        if ( $template_file ) {
            if ( $theme_file = locate_template( array( $template_file ) ) ) {
                $template_path = $theme_file;
            } else {
                $template_path = dirname( dirname(__FILE__) ) . '/partials/' . $template_file;
            }
            include $template_path;
        }

        $html = ob_get_clean();
        return $html;

    }
}