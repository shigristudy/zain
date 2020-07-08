<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.0
 */
 $shoplayout = 'sidebar';
if(isset($safira_opt['shop_layout']) && $safira_opt['shop_layout']!=''){
	$shoplayout = $safira_opt['shop_layout'];
}
if(isset($_GET['layout']) && $_GET['layout']!=''){
	$shoplayout = $_GET['layout'];
}
if ( !is_active_sidebar( 'sidebar-shop' ) )  {
	$shoplayout = 'fullwidth';
}
 $safira_viewmode = Safira_Class::safira_show_view_mode();
?>
<div class="shop-products products row <?php echo esc_attr($safira_viewmode);?> <?php echo esc_attr($shoplayout);?>">