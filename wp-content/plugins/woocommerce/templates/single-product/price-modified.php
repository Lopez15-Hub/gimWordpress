<?php
/**
 * Single Product Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

?>

<?php 
/*
Obtengo y muestro el precio

*/?>
<?php if ($price_html  = $product-> get_price() ) : ?>

<h1 class="">Precio</h1>
<hr>
<h1 class="price"><?php echo wc_price($price_html);?></h1>

<?php endif;	?>


<?php 
/*
Aplico y muestro el descuento

*/?>


<?php if ($price_html  = $product-> get_price() ) : ?>

<h2 class="">Precio Con descuento:</h2>
<p class="price"><?php echo wc_price($price_html - descuento($price_html));?></p>
<span class="spandto">AHORRÁS:$<?php echo descuento($price_html)?></span>

<?php endif;	?>



<?php 
/*
Función descuento

*/?>
<?php 
function descuento($precio){
$descuento = ($precio*20)/100;
return $descuento;
}
?>
