<?php
/**
* Plugin Name: WP Auto Translate Free
* Plugin URI: https://euroalphabet.eu/free-website-translation
* Description: Auto Translate website with button using Google or Microsoft Translate.
* Author: Euro Alphabet
* Author URI: https://euroalphabet.eu/kontakt
* Version: 0.0.1
* Text Domain: wp-free-website-translation
* Domain Path: https://euroalphabet.eu/
*
* License: GNU General Public License v3.0
* License URI: http://www.gnu.org/licenses/gpl-3.0.html
*
* @package   WP-Auto-Translate
* @author    Euro Alphabet
* @category  Translation
* @copyright Euro Alphabet
* @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
*/

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly
}

require_once plugin_dir_path( __FILE__ ) . 'classes/class-wp-translatorea-connector.php';

/**
* # WP TranslatorEA Main Plugin Class
*
* ## Plugin Overview
*
* Plugin to add to your site translate button changing settings from wp-admin.
*
*/
class WP_TranslatorEA {
  /** plugin version number */
  public static $version = '1.0.0';

  /** @var string the plugin file */
  public static $plugin_file = __FILE__;

  /** @var string the plugin file */
  public static $plugin_dir;

  /**
  * Initializes the plugin
  *
  * @since 0.0.1
  */
  public static function init() {
    self::$plugin_dir = dirname(__FILE__);

    $connector = new WP_TranslatorEA_Connector();
    $connector->load();

    // Load translation files
    add_action('plugins_loaded', __CLASS__ . '::load_plugin_textdomain');
  }

  /**
  * Load our language settings for internationalization
  *
  * @since 0.0.1
  */
  public static function load_plugin_textdomain() {
    
    load_plugin_textdomain('wp-translatorea', false, basename(self::$plugin_dir) . '/languages');
  }
}

WP_TranslatorEA::init();
