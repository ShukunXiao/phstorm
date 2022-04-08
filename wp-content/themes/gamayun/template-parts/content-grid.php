<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Gamayun_01
 */

?><div><article id="post-<?php the_ID(); ?>" <?php post_class('w3-theme-l5'); ?>><?php

//the_post_thumbnail('medium'); ?>
<?php gamayun_01_post_thumbnail(); ?>

<?php if (is_sticky()){
	?><header class="entry-header padd-1 w3-theme-d5"><?php
}
else{
	?><header class="entry-header padd-1 w3-theme-l3"><?php
}

	the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
?></header><!-- .entry-header -->

	<div class="entry-content padd-1">
	<?php echo esc_html(gamayun_excerpt( get_theme_mod('excerpt_length', '20'))); ?>  
	<?php //the_excerpt(); ?>
	</div><!-- .entry-content -->

	<div class="entry-meta padd-1">
	<?php

			// ***** post all categories
                $terms = wp_get_post_terms( get_the_ID(), 'category');
                // d($terms);
                $links ='';
                foreach ($terms as $t) {
                    $tl = is_wp_error( $term_link = get_term_link($t->slug, 'category') ) ? '' : $term_link;
                    $links .= '<a href="' . $tl . '">'.$t->name . '</a>' . '(' .$t->count . ')' . ' ';
                }
                //printf( "<i class='fa fa-folder-open'></i> " . '<span style="font-variant:small-caps;">'. "Categories: " . '</span>' . '<span class="entry-cat">' . '%1$s' . '</span><br />' , wp_kses_post($links));
                printf( "<span class='icon-folder-open'></span> " . '<span style="font-variant:small-caps;">'. "Categories: " . '</span>' . '<span class="entry-cat">' . '%1$s' . '</span><br />' , wp_kses_post($links));
				
            // ***** post all tags
                $terms = wp_get_post_terms( get_the_ID(), 'post_tag');
                $links ='';
                foreach ($terms as $t) {
                    $links .= '<a href="'.get_term_link($t->slug, 'post_tag').'">'.$t->name. '(' .$t->count . ')' . '</a>' . ' ';
                }
                printf( "<span class='icon-price-tag'></span> "  . '<span style="font-variant:small-caps;">'. "Tags: " . '</span>' . '<span class="entry-tag">' . '%1$s' . '</span>' , wp_kses_post($links));
	
			// comment
			?><br /><span class="icon-bubble2"></span> <?php comments_popup_link( 'No comments yet', '1 comment', '% comments', 'comments-link', 'Comments are off for this post');?>
            <br />

<span class="icon-clock"></span> date:  
<!-- Retrieves the permalink for the month archives with year. / get_year_link(); get_month_link; get_day_link -->
<?php 
	$archive_year  = get_the_time('Y'); 
	$archive_month = get_the_time('m'); 
	$archive_day   = get_the_time('d');
?>
<a href="<?php echo esc_url(get_month_link( $archive_year, $archive_month)); ?>"><?php echo get_the_date();?></a>

<?php // Count number of posts of current month - https://wordpress.stackexchange.com/questions/88645/count-number-of-posts-of-current-month
$month = get_the_time('m');
$year_l = get_the_time('Y');
$countposts = get_posts(array(
	'numberposts' => -1,// phpcs:ignore WPThemeReview.CoreFunctionality.PostsPerPage.posts_per_page_numberposts
	'post_type'   => 'post',
	'year' => $year_l,
	'monthnum' => $month
  ));
echo '(' . count($countposts) . ')';
?>

<?php 
global $authordata;
$link_l = get_author_posts_url( $authordata->ID, $authordata->user_nicename );
$link_l = sprintf( '<a href="%1$s" title="%2$s" rel="author">%3$s</a>',
esc_url( add_query_arg('post_type', 'post', $link_l )),
esc_attr( sprintf( 'Posts by %s', get_the_author())),
get_the_author()
) . '(' . count_user_posts( get_the_author_meta('ID'), 'post' ) . ')';
?>
<br /><span class="icon-pencil"></span> author: <?php echo  wp_kses_post($link_l); ?>


	</div><!-- .entry-meta -->

	<footer class="entry-footer">
		<?php //gamayun_01_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> --></div>
