<?php

// No direct access to this file
defined( 'ABSPATH' ) or die();

class WP_TranslatorEA_Admin {
  public function create_nav_page() {
    add_menu_page(
      esc_html__( 'WP Auto Translate', 'wp-translatorea' ), 
      esc_html__( 'WP Auto Translate', 'wp-translatorea' ), 
      'manage_options',
      'wp_translatorea_settings',
      'WP_TranslatorEA_Admin::build_view',
      'dashicons-translation'
    );
  }

  public function register_my_setting() {
    register_setting( 'wp_translatorea', 'wp_translatorea' );
  }

  public static function build_view() {
    require_once plugin_dir_path( __FILE__ ) . 'views/wp-translatorea-view.php';
  }
}
?>
