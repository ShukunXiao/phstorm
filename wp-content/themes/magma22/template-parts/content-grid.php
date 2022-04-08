<?php
/**
* The template part columns:
* The template part for displaying content
 *
 * @package WordPress
 * @subpackage danica
 */
?>

<div><article id="post-<?php the_ID(); ?>" <?php post_class('grid w3-theme-l5'); ?>>

	<?php gamayun_01_post_thumbnail(); ?>

	<header class="entry-header">
		<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
			<span class="sticky-post"><?php esc_html_e( 'Featured', 'magma22' ); ?></span>
		<?php endif; ?>
		</header><!-- .entry-header -->

	<div class="w3-dropdown-hover">
		<?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
	<div class="w3-dropdown-content w3-container w3-card-4 w3-pale-blue w3-text-grey w3-border entry-meta" style="width:250px; left:10px;">
		<?php magma22_entrymeta(); ?>
	</div><!-- .entry-meta1 -->
	</div>

	<div class="entry-meta">
		<?php magma22_date(); ?>
	</div><!-- .entry-meta -->

	<div class="entry-content">
	<?php //the_excerpt(); ?>
	<?php echo esc_html(gamayun_excerpt(get_theme_mod('excerpt_length', '15'))); ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> --></div>

