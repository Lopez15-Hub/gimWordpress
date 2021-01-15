<?php

  // No direct access to this file
  defined( 'ABSPATH' ) or die();




  $default_settings = array(
  'translatorea_default_lang'=> '', 
  'translatorea_langs'=> ['en', 'de', 'fr', 'es', 'pt', 'ru'], 
  'translatorea_engine' => 'google', 
  'translatorea_position' => 'right', 
  'only_admin' => 'no',
  'translatorea_link' => 'no');
  
  //$available_langs=file_get_contents('../../assets/js/wp_translatorea.js');
  $file_path = plugins_url('assets/js/langs.json', dirname(__DIR__));
  $available_langs=json_decode(file_get_contents($file_path), true);
  //print_r($available_langs[0]["short"]) ;
  
  //Set default lang, by page lang
$page_lang=explode("_", get_locale())[0];
 $translatorea_default_lang;
 
 foreach ($available_langs as $lang) {
    if( $lang["short"]==$page_lang)
    {
     $default_settings['translatorea_default_lang']=$page_lang;
     break;
    }
 }

  $settings = get_option( 'wp_translatorea' );
  $settings = is_array($settings) ? $settings : $default_settings;
?>
<div id="business-info-wrap" class="wrap">

  <h1 class="wp-heading-inline"><?php esc_html_e( 'WP Auto Translate', 'wp-translatorea' ); ?></h1>

  <hr class="wp-header-end">

  <?php if ( isset( $_GET['settings-updated'] ) ) : ?>

    <div id="message" class="notice notice-success is-dismissible">
      <p><strong><?php esc_html_e( 'Settings saved.' ); ?></strong></p>
    </div>

  <?php endif; ?>

  <p><?php
    $url = 'https://euroalphabet.eu/free-website-translation';
    $link = sprintf( wp_kses( __( 'Do you need a professional website translation? Check out <a href="https://euroalphabet.eu" target="_blank">our offer</a>.', 'wp-translatorea' ), array(  'a' => array( 'href' => array(), 'target' =>  '_blank' ) ) ), esc_url( $url ) );
    echo $link;
  ?></p>

  <form method="post" action="options.php">
    <?php settings_fields( 'wp_translatorea' ); ?>

    <table class="form-table">

      <tbody>

        <tr>

          <th scope="row">
            <label for="wp_translatorea_default_lang"><?php esc_html_e( 'Default language', 'wp-translatorea' ); ?> *</label>
          </th>

          <td>
            <select name="wp_translatorea[translatorea_default_lang]" required>
              <option value=''><?php esc_html_e( 'Select default', 'wp-translatorea' ); ?></option>
              <?php foreach ($available_langs as $lang) {
    echo '<option value="'.$lang["short"].'"'.selected($settings['translatorea_default_lang'], $lang["short"]).'>'.$lang["name"].' ('.$lang["short"].')</option>';
} ?>
              
          

        </select>
        
          </td>

        </tr>
        
         <tr>

          <th scope="row">
            <label for="wp_translatorea_langs"><?php esc_html_e( 'Languages', 'wp-translatorea' ); ?></label>
          </th>

          <td>
            <select multiple name="wp_translatorea[translatorea_langs][]" size="10" style="height: 100%;">
              <?php foreach ($available_langs as $lang) {
    echo '<option value="'.$lang["short"].'"'.( !empty( $settings['translatorea_langs'] ) && in_array( $lang["short"], $settings['translatorea_langs'] ) ? ' selected="selected"' : '' ).'>'.$lang["name"].' ('.$lang["short"].')</option>';
} ?>
              
          

        </select>
        
          </td>

        </tr>
    <tr> 

          <th scope="row">
            <label for="wp_translatorea_engine"><?php esc_html_e( 'Engine', 'wp-translatorea' ); ?></label>
          </th>

          <td>
        <select name="wp_translatorea[translatorea_engine]">
          <option value="google" <?php selected($settings['translatorea_engine'], "google"); ?>><?php esc_html_e( 'Google Translate', 'wp-translatorea' ); ?></option>
          <option value="bing" <?php selected($settings['translatorea_engine'], "bing"); ?>><?php esc_html_e( 'Microsoft Translator', 'wp-translatorea' ); ?></option>
        </select>
            
            
          </td>

        </tr>
        <tr> 

          <th scope="row">
            <label for="wp_translatorea_position"><?php esc_html_e( 'Position', 'wp-translatorea' ); ?></label>
          </th>

          <td>
                         <select name="wp_translatorea[translatorea_position]">
          <option value="left" <?php selected($settings['translatorea_position'], "left"); ?>><?php esc_html_e( 'left', 'wp-translatorea' ); ?></option>
          <option value="right" <?php selected($settings['translatorea_position'], "right"); ?>><?php esc_html_e( 'right', 'wp-translatorea' ); ?></option>
        </select>
            
            
          </td>

        </tr>
        
        
        <tr>

          <th scope="row">
            <label for="wp_translatorea_only_admin"><?php esc_html_e( 'Show only for admin?', 'wp-translatorea' ); ?></label>
          </th>

          <td>
           <select name="wp_translatorea[only_admin]">
          <option value="no" <?php selected($settings['only_admin'], "no"); ?>><?php esc_html_e( 'no', 'wp-translatorea' ); ?></option>
          <option value="yes" <?php selected($settings['only_admin'], "yes"); ?>><?php esc_html_e( 'yes', 'wp-translatorea' ); ?></option>
        </select>
            
          </td>

        </tr>
         <tr>

          <th scope="row">
            <label for="wp_translatorea_translatorea_link"><?php esc_html_e( 'Support us! Show author', 'wp-translatorea' ); ?></label>
          </th>

          <td>
           <select name="wp_translatorea[translatorea_link]">
          <option value="no" <?php selected($settings['translatorea_link'], "no"); ?>><?php esc_html_e( 'no', 'wp-translatorea' ); ?></option>
          <option value="yes" <?php selected($settings['translatorea_link'], "yes"); ?>><?php esc_html_e( 'yes', 'wp-translatorea' ); ?></option>
        </select>
          </td>

        </tr>

      </tbody>

    </table>

    <?php submit_button(); ?>

  </form>

</div>
