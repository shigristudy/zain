<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$safira_opt = get_option( 'safira_opt' );
$safira_single_product_layout = 'sidebar';
if(isset($safira_opt['single_product_layout']) && $safira_opt['single_product_layout']!=''){
	$safira_single_product_layout = $safira_opt['single_product_layout'];
}
if(isset($_GET['layout']) && $_GET['layout']!=''){
	$safira_bloglayout = $_GET['layout'];
}
$singleproductsidebar = 'right';
if(isset($safira_opt['sidebarsingleproduct_pos']) && $safira_opt['sidebarsingleproduct_pos']!=''){
	$singleproductsidebar = $safira_opt['sidebarsingleproduct_pos'];
}
if(isset($_GET['sidebar']) && $_GET['sidebar']!=''){
	$singleproductsidebar = $_GET['sidebar'];
}
if ( !is_active_sidebar( 'sidebar-single_product' ) )  {
	$singleproductsidebar = 'nosidebar';
}
$safira_single_product_main_extra_class = NULl;
if($singleproductsidebar=='left') {
	$safira_single_product_main_extra_class = 'order-lg-last';
}
?>
<?php 
global $post, $woocommerce, $product, $is_IE;
$enable_slider = get_option('yith_wcmg_enableslider') == 'yes' ? true : false;
$attachment_ids = $product->get_gallery_image_ids();
if ( ! empty( $attachment_ids ) && ( $attachment_ids != 0 ) ) {
	$imageclass = 'hasthumb';
} else {
	$imageclass = 'nothumb';
}
?>
<div class="container">
	<?php
		/**
		 * Hook: woocommerce_before_single_product.
		 *
		 * @hooked wc_print_notices - 10
		 */
		do_action( 'woocommerce_before_single_product' );
		 if ( post_password_required() ) {
		 	echo get_the_password_form();
		 	return;
		 }
	?>
</div>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class(); ?>>
	<div class="container">
		<div class="row">
			<div class="page-content col-12 <?php if ( $safira_single_product_layout=='sidebar' && is_active_sidebar( 'sidebar-single_product' ) ) { echo ' col-lg-9 main-column'; } ?> product-content-wrapper <?php echo esc_attr($safira_single_product_main_extra_class);?>">
				<div class="product-content">
					<div class="row">
						<div class="col-12 col-lg-6 col-xl-6">
							<div class="single-product-image <?php echo esc_attr($imageclass); ?> <?php if($enable_slider){ echo 'slider';} else { echo 'noslider';} ?>">
								<?php
									/**
									 * Hook: woocommerce_before_single_product_summary.
									 *
									 * @hooked woocommerce_show_product_sale_flash - 10
									 * @hooked woocommerce_show_product_images - 20
									 */
									do_action( 'woocommerce_before_single_product_summary' );
								?>
							</div>
						</div>
						<div class="col-12 col-lg-6 col-xl-6">
							<div class="summary entry-summary single-product-info">
								<div class="product-nav">
									<div class="next-prev">
										<div class="prev"><?php previous_post_link('%link'); ?></div>
										<div class="next"><?php next_post_link('%link'); ?></div>
									</div>
								</div>
								<?php
									/**
									 * Hook: woocommerce_single_product_summary.
									 *
									 * @hooked woocommerce_template_single_title - 5
									 * @hooked woocommerce_template_single_rating - 10
									 * @hooked woocommerce_template_single_price - 10
									 * @hooked woocommerce_template_single_excerpt - 20
									 * @hooked woocommerce_template_single_add_to_cart - 30
									 * @hooked woocommerce_template_single_meta - 40
									 * @hooked woocommerce_template_single_sharing - 50
									 * @hooked WC_Structured_Data::generate_product_data() - 60
									 */
									do_action( 'woocommerce_single_product_summary' );
								?>
								<?php if(function_exists('safira_product_sharing')) { ?>
									<div class="single-product-sharing">
										<?php safira_product_sharing(); ?>
									</div>
								<?php } ?>
							</div><!-- .summary -->
						</div>
					</div>
				</div>
			</div>
			<?php if ( $safira_single_product_layout=='sidebar' && is_active_sidebar( 'sidebar-single_product' ) ) : ?>
			 	<?php if ($singleproductsidebar=='left') : ?>
		  			<div id="secondary" class="col-12 col-lg-3 order-lg-first">
	  		  			<?php dynamic_sidebar( 'sidebar-single_product' ); ?>
		  			</div>
			 	<?php endif; ?>	
 			 	<?php if ($singleproductsidebar=='right') : ?>
 		  			<div id="secondary" class="col-12 col-lg-3">
 	  		  			<?php dynamic_sidebar( 'sidebar-single_product' ); ?>
 		  			</div>
 			 	<?php endif; ?>	
			<?php endif; ?>	
		</div>
	</div>
	<div class="product-more-details">
			<div class="row">
				<div class="container">
					<?php woocommerce_output_product_data_tabs(); ?>
					<meta itemprop="url" content="<?php the_permalink(); ?>" />
				</div>
			</div>
		</div>
		<div class="related-upsell-products">
			<div class="row">
				<div class="container">
					<?php woocommerce_output_related_products(); ?>
					<?php woocommerce_upsell_display(); ?>
				</div>
			</div>
		</div>
	<?php
		/**
		 * Hook: woocommerce_after_single_product_summary.
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>
</div>
<?php //do_action( 'woocommerce_after_single_product' ); ?>