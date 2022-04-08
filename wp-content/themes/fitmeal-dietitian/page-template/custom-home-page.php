<?php
/**
 * Template Name: Custom Home Page
 */
get_header(); ?>

<main id="content">
  <?php if( get_theme_mod('nutrition_diet_slider_arrows') != ''){ ?>
    <section id="slider">
      <span class="design-right"></span>
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel"> 
        <?php
          for ( $i = 1; $i <= 4; $i++ ) {
            $mod =  get_theme_mod( 'nutrition_diet_post_setting' . $i );
            if ( 'page-none-selected' != $mod ) {
              $nutrition_diet_slide_post[] = $mod;
            }
          }
           if( !empty($nutrition_diet_slide_post) ) :
          $args = array(
            'post_type' =>array('post'),
            'post__in' => $nutrition_diet_slide_post
          );
          $query = new WP_Query( $args );
          if ( $query->have_posts() ) :
            $i = 1;
        ?>
        <div class="carousel-inner" role="listbox">
          <?php while ( $query->have_posts() ) : $query->the_post(); ?>
          <div <?php if($i == 1){echo 'class="carousel-item active"';} else{ echo 'class="carousel-item"';}?>>
            <img src="<?php esc_url(the_post_thumbnail_url('full')); ?>"/>
            <div class="carousel-caption text-center text-md-left text-sm-left">
              <?php if( get_theme_mod('nutrition_diet_extra_text') != '' ){ ?>
                <h6><i class="fas fa-star mr-2"></i><?php echo esc_html(get_theme_mod('nutrition_diet_extra_text','')); ?></h6>
              <?php }?>
              <h2 class="slider-title"><?php the_title();?></h2>
              <p class="mb-0"><?php echo esc_html(wp_trim_words(get_the_content(),'20') );?></p>
              <div class="home-btn text-center text-md-left text-sm-left my-4">
                <a href="<?php the_permalink(); ?>"><?php echo esc_html('Book Your Free Slot','fitmeal-dietitian'); ?></a>
              </div>
            </div>
          </div>
          <?php $i++; endwhile;
          wp_reset_postdata();?>
        </div>
        <?php else : ?>
        <div class="no-postfound"></div>
          <?php endif;
        endif;?>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"><i class="fas fa-long-arrow-alt-left"></i></span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"><i class="fas fa-long-arrow-alt-right"></i></span>
          </a>
      </div>
      <div class="clearfix"></div>
    </section>
  <?php }?>

  <section id="about-us" class="py-5 text-center text-md-left">
    <div class="container">
      <div class="row">
        <?php
          $mod = get_theme_mod( 'nutrition_diet_middle_sec_page_settigs' );
          if ( 'page-none-selected' != $mod ) {
            $nutrition_diet_page[] = $mod;
          }
          if( !empty($nutrition_diet_page) ) :
          $args = array(
            'post_type' =>'page',
            'post__in' => $nutrition_diet_page
          );
          $query = new WP_Query( $args );
          if ( $query->have_posts() ) :
        ?>
        <?php  while ( $query->have_posts() ) : $query->the_post(); ?>
          <div class="col-lg-5 col-md-5 col-sm-5">
            <img src="<?php esc_url(the_post_thumbnail_url('full')); ?>"/>
            <div class="calling-box text-center">
              <?php if( get_theme_mod('nutrition_diet_calling_text') != '' ){ ?>
                <p><?php echo esc_html( get_theme_mod('nutrition_diet_calling_text')); ?></p>
              <?php }?>
              <?php if( get_theme_mod('nutrition_diet_calling_number') != '' ){ ?>
                <h5><?php echo esc_html( get_theme_mod('nutrition_diet_calling_number')); ?></h5>
              <?php }?>
            </div>
          </div>
          <div class="col-lg-7 col-md-7 col-sm-7">
            <div class="middle-sec-box pt-md-0 pt-5 pt-lg-5">
              <?php if( get_theme_mod('nutrition_diet_about_title') != '' ){ ?>
                <h6><?php echo esc_html( get_theme_mod('nutrition_diet_about_title')); ?></h6>
              <?php }?>
              <h3><?php the_title();?></h3>
              <p><?php echo esc_html(wp_trim_words(get_the_content(),'80') );?></p>
              <a href="<?php the_permalink(); ?>" class="abt-button-1"><?php esc_html_e('Know More','fitmeal-dietitian'); ?></a>
              <?php if( get_theme_mod('nutrition_diet_about_button_2_link') != '' || get_theme_mod('nutrition_diet_about_button_2_text') != '' ){ ?>
                <a href="<?php echo esc_url( get_theme_mod('nutrition_diet_about_button_2_link')); ?>" class="abt-button-2"><?php echo esc_html( get_theme_mod('nutrition_diet_about_button_2_text')); ?></a>
              <?php }?>
            </div>
          </div>
        <?php endwhile;
        wp_reset_postdata();?>
        <?php else : ?>
        <div class="no-postfound"></div>
          <?php endif;
        endif;?>
      </div>
    </div>
  </section>

  <section id="product" class="py-5 text-center">    
    <div class="container">
      <?php if( get_theme_mod('nutrition_diet_shop_text') != '' ){ ?>
        <h5 class="mb-4"><?php echo esc_html( get_theme_mod('nutrition_diet_shop_text')); ?></h5>
      <?php }?>
      <?php if( get_theme_mod('nutrition_diet_shop_title') != '' ){ ?>
        <h3><?php echo esc_html( get_theme_mod('nutrition_diet_shop_title')); ?></h3>
      <?php }?>
      <div class="row mt-5">
        <?php
        $fitmeal_dietitian_catData = get_theme_mod('fitmeal_dietitian_shop_category');
        $fitmeal_dietitian_count_catData = get_theme_mod('fitmeal_dietitian_shop_number');
        if ( class_exists( 'WooCommerce' ) ) {
        $args = array(
          'post_type' => 'product',
          'posts_per_page' => $fitmeal_dietitian_count_catData,
          'product_cat' => $fitmeal_dietitian_catData,
          'order' => 'ASC'
        );
        $loop = new WP_Query( $args );
        while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
          <div class="col-lg-4 col-md-4 col-sm-4">
            <div class="product-img mb-3">
              <?php if (has_post_thumbnail( $loop->post->ID )) echo get_the_post_thumbnail($loop->post->ID, ''); else echo '<img src="'.esc_url(woocommerce_placeholder_img_src()).'" />'; ?>
              <div class="sale-tag">
                <span><?php woocommerce_show_product_sale_flash( $post, $product ); ?></span>
              </div>
              <div class="product-details mt-3">
                <h4><a href="<?php echo esc_url(get_permalink( $loop->post->ID )); ?>"><?php the_title(); ?></a></h4>
                <span><?php esc_attr( apply_filters( 'woocommerce_product_price_class', '' ) ); ?><?php echo $product->get_price_html(); ?></span>
              </div>
              <div class="box-content-cart my-4">
                <?php if( $product->is_type( 'simple' ) ) { woocommerce_template_loop_add_to_cart(  $loop->post, $product );} ?>
              </div>
            </div>
          </div>
        <?php endwhile; wp_reset_query(); ?>
        <?php } ?>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>