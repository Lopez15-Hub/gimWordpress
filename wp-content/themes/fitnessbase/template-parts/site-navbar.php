<?php 
$fitnessbase_menu_style = get_theme_mod('consultstreet_menu_style', 'sticky');
$fitnessbase_menu_container_size = get_theme_mod('consultstreet_menu_container_size', 'container-full');
$fitnessbase_site_top_header_disabled = get_theme_mod('consultstreet_site_top_header_disabled', true);
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
 ?>
<!-- Classic Header -->
<div class="classic-header <?php if ( is_plugin_active( 'arile-extra/arile-extra.php' ) && $fitnessbase_site_top_header_disabled == true ) {
    echo 'classic-page-header';
} ?>">

    <?php do_action( 'arileextra_consultstreet_top_header', false); ?>
	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg navbar-header-wrap not-sticky navbar-light <?php if($fitnessbase_menu_style == 'sticky'){echo 'header-sticky'; }?>">
		<div class="<?php echo esc_attr($fitnessbase_menu_container_size); ?>">
			<div class="row align-self-center">
			
				<div class="align-self-center">	
					<?php echo esc_html( consultstreet_header_logo() ); ?>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation','fitnessbase'); ?>">
						<span class="navbar-toggler-icon"></span>
					</button>
				</div>
			
						
				<?php
					wp_nav_menu( array(
						 'theme_location'  => 'primary',
						 'container'       => 'div',
						 'container_class' => 'collapse navbar-collapse',
						 'container_id' => 'navbarNavDropdown',
						 'menu_class'      => 'nav navbar-nav m-right-auto',
						 'fallback_cb'     => 'consultstreet_wp_bootstrap_navwalker::fallback',
						 'walker'          => new consultstreet_wp_bootstrap_navwalker()
					) );
					
				?>
					
				
			</div>
		</div>
	</nav>
	<!-- /End of Navbar -->
</div>