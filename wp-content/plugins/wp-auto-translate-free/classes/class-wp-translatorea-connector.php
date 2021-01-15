<?php

// No direct access to this file
defined( 'ABSPATH' ) or die();

class WP_TranslatorEA_Connector {
  public function load() {
    $this->load_dependencies();
    $this->load_admin();
    $this->enqueue_script();
  }

  private function load_dependencies() {
    require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wp-translatorea-admin.php';
  }

  private function load_admin() {
    $admin = new WP_TranslatorEA_Admin();
    add_action( 'admin_init', array( $admin, 'register_my_setting' ) );
    add_action( 'admin_menu', array( $admin, 'create_nav_page' ) );
  }

  public static function build_translatorea_script() {
    $settings = get_option( 'wp_translatorea' );
    $is_admin = is_admin() || current_user_can('manage_options');
 
    $translatorea_engine = $settings['translatorea_engine'] ? '"'.$settings['translatorea_engine'].'"' : '"google"';
    $translatorea_position = $settings['translatorea_position'] ? '"'.$settings['translatorea_position'].'"' : '"right"';
    $translatorea_langs=array_push($settings['translatorea_langs'], $settings['translatorea_default_lang']);
    $translatorea_langs = $settings['translatorea_langs'] ? $settings['translatorea_langs'] : ['en', 'de', 'fr', 'es', 'pt', 'ru'];
    $translatorea_default_lang = $settings['translatorea_default_lang'] ? '"'.$settings['translatorea_default_lang'].'"' : '0';
    $translatorea_link=$settings['translatorea_link']=='yes'? 1:0  ;
    

    if (!is_array($settings) || (!$is_admin && 'yes' === $settings['only_admin'])) { 
      return;
    }
	  //JS
	  $file_path = plugins_url('assets/js/langs.json', dirname(__FILE__));
    $available_langs=file_get_contents($file_path);
    
      //Set default lang, by page lang
      if($translatorea_default_lang=='0'){
        $page_lang=explode("_", get_locale())[0];
         $translatorea_default_lang;
         $available_langsArray=json_decode($available_langs, true);
         foreach ($available_langsArray as $lang) {
            if( $lang["short"]==$page_lang)
            {
             $default_settings['translatorea_default_lang']=$page_lang;
             break;
            }
         }
      }

	  
		wp_register_script('wp_translatorea_langs', '' );
		wp_add_inline_script( 'wp_translatorea_langs', 'var langs ='.$available_langs.';  var selectedLangs='.json_encode($translatorea_langs ).'; var defaultLang ='.$translatorea_default_lang.'; var translationProvider ='.$translatorea_engine.'; var translatoreaPosition ='.$translatorea_position.'; var translatoreaLink ='.$translatorea_link.';');
		wp_enqueue_script('wp_translatorea_langs');
		wp_register_script('wp_translatorea', plugins_url("assets/js/wp_translatorea.js", dirname(__FILE__) ));
		wp_enqueue_script('wp_translatorea');
		
		//CSS
	  wp_enqueue_style('wp_translatorea', plugins_url("assets/css/wp_translatorea.css", dirname(__FILE__) ));
	  wp_enqueue_style('wp_translatorea-font', 'https://fonts.googleapis.com/css?family=News+Cycle:700');
	  

	 if ('yes' === $settings['translatorea_link']) {
      echo '<a id="page-translator" href="https://euroalphabet.eu/" target="_blank">WP Auto Translate</a>';
	 }
  }

  private function enqueue_script() {
    add_action( 'wp_footer', array($this, 'build_translatorea_script') );
  }
}
?>
