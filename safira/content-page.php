<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Safira_Theme
 * @since Safira 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'safira' ), 'after' => '</div>', 'pagelink' => '<span>%</span>' ) ); ?>
	</div>
</article>