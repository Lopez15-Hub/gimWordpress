<?php
/**
 * Getting Started Panel.
 *
 * @package FitnessBase
 */
?>
<div id="getting-started-panel" class="panel-left visible">
    <div class="panel-aside panel-column">
     
	<?php 
	$free_plugins = array(
		'arile-extra' => array(
		    'name'      => 'Arile Extra',
			'slug'     	=> 'arile-extra',
			'filename' 	=> 'arile-extra.php',
		),
	);
	if( !empty( $free_plugins ) ) { ?>
		<div class="recomended-plugin-wrap">
		<?php
		foreach( $free_plugins as $plugin ) {
			$info 		= fitnessbase_call_plugin_api( $plugin['slug'] ); ?>
				
			<h4 title="<?php echo esc_attr( $plugin['name'] ); ?>">
				<?php echo esc_html( $plugin['name'] ); ?>	
			</h4>
			<p class="mt-0"><?php esc_html_e('Arile Extra Plugin requires you to be highly recommended. And after installing it, you will be able to show all the front page features and, all business sections of the FrontPage.', 'fitnessbase'); ?></p>
			<?php 
			echo '<div class="mt-12">';
			echo FitnessBase_Getting_Started_Page_Plugin_Helper::instance()->get_button_html( $plugin['slug'] );
			echo '</div>';
			?>

			</br>
			<?php
		} ?>
		</div>
	<?php
	} ?>
	 
	 
	 
	 
    </div> 
    <div class="panel-aside panel-column">
        <h4><?php esc_html_e( 'Extensive Documentation', 'fitnessbase' ); ?></h4>
        <p><?php esc_html_e( 'Read detailed documentation of the theme. The documentation has all the necessary information to set up the theme. Which will help you set up the theme. So you must read the document carefully before using it.', 'fitnessbase' ); ?></p>
        <a href="//helpdoc.themearile.com/" class="hyperlink" title="<?php esc_attr_e( 'Visit the Support', 'fitnessbase' ); ?>" target="_blank"><?php esc_html_e( 'Documentation', 'fitnessbase' ); ?></a>
    </div>
   <div class="panel-aside panel-column">
        <h4><?php esc_html_e( 'Go to the Customizer', 'fitnessbase' ); ?></h4>
        <p><?php esc_html_e( 'Using the WordPress Customizer you can easily customize every single aspect of the theme. Because this theme provides advanced settings to control the theme layout through the customizer.', 'fitnessbase' ); ?></p>
        <a class="button button-primary" target="_blank" href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" title="<?php esc_attr_e( 'Visit the Support', 'fitnessbase' ); ?>"><?php esc_html_e( 'Go to the Customizer', 'fitnessbase' ); ?></a>
    </div>
</div>