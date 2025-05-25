<?php
/**
 * The template for displaying home page.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package Gravida
 */
get_header(); ?>
<?php if (!is_home() && is_front_page()) { ?>
<section id="home_slider">
  <?php
$sldimages = ''; ?>
  <?php
$slAr = array();
$m = 0;
for ($i=1; $i<6; $i++) {
	if ( get_theme_mod('slide_image'.$i, !empty($sldimages[$i])) != "" ) {
		$imgSrc 	= get_theme_mod('slide_image'.$i, !empty($sldimages[$i]));
		$imgTitle	= get_theme_mod('slide_title'.$i);
		$imgDesc	= get_theme_mod('slide_desc'.$i);
		$imgLink	= get_theme_mod('slide_link'.$i);
		if ( strlen($imgSrc) > 3 ) {
			$slAr[$m]['image_src'] = get_theme_mod('slide_image'.$i, !empty($sldimages[$i]));
			$slAr[$m]['image_title'] = get_theme_mod('slide_title'.$i);
			$slAr[$m]['image_desc'] = get_theme_mod('slide_desc'.$i);
			$slAr[$m]['image_link'] = get_theme_mod('slide_link'.$i);
			$m++;
		}
	}
}
$slideno = array();
if( $slAr > 0 ){
	$n = 0;?>
  <div class="slider-wrapper theme-default">
    <div id="slider" class="nivoSlider">
      <?php 
	foreach( $slAr as $sv ){
		$n++; ?>
      <img src="<?php echo esc_url($sv['image_src']); ?>" alt="<?php echo esc_attr($sv['image_title']);?>" title="<?php echo esc_attr('#slidecaption'.$n) ; ?>" />
      <?php
		$slideno[] = $n;
	}
	?>
    </div>
    <?php
	foreach( $slideno as $sln ){ ?>
    <div id="slidecaption<?php echo esc_attr($sln); ?>" class="nivo-html-caption">
      <div class="slide_info">
        <h1><a href="<?php echo esc_url(get_theme_mod('slide_link'.$sln)); ?>"><?php echo esc_attr(get_theme_mod('slide_title'.$sln)); ?></a></h1>
        <p><?php echo esc_attr(get_theme_mod('slide_desc'.$sln)); ?></p>
      </div>
    </div>
    <?php 
	} ?>
  </div>
  <div class="clear"></div>
  <?php 
}
?>
</section>
<?php } ?>
<?php if (!is_home() && is_front_page()) { ?>
<div class="feature-box-main site-aligner">
  <?php for($f=1; $f<5; $f++) { ?>
  <?php if( get_theme_mod('page-setting'.$f)) { ?>
  <?php $queryvar = new WP_query('page_id='.get_theme_mod('page-setting'.$f,true)); ?>
  <?php while( $queryvar->have_posts() ) : $queryvar->the_post(); ?>
  <a href="<?php the_permalink(); ?>">
  <div class="feature-box <?php if($f%4==0){ ?>last<?php } ?>">
    <?php the_post_thumbnail(); ?>
    <div class="feature-title">
      <?php the_title(); ?>
    </div>
    <!-- feature-title -->
    <div class="feature-content"><?php the_excerpt(); ?></div>
    <?php esc_html_e('Read More >','gravida'); ?>
  </div>
  </a><!-- feature-box -->
  <?php if($f%4==0) { ?>
  <div class="clear"></div>
  <?php } ?>
  <?php endwhile; ?>
  <?php } ?>
  <?php } ?>
</div>
<?php } ?>
<div class="clear"></div>
<div id="content">
  <div class="site-aligner">
    <?php 
	if ( 'posts' == get_option( 'show_on_front' ) ) {
    ?>
    <section class="site-main" id="sitemain">
      <div>
      <div class="section-title"><?php esc_html_e('Latest Blog','gravida'); ?></div>
        <div>
                            <?php $k = 0; ?>
							<?php global $wp_query; ?>
                            	<?php while( $wp_query->have_posts() ) : $wp_query->the_post(); ?>                                	<?php $k++; ?>
                            	<div class="one_fourth <?php if($k%4==0){?>last_column<?php } ?>">
                                		<p><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
                                        	<?php if( has_post_thumbnail() ) { ?>
												<?php the_post_thumbnail(); ?>
                                            <?php } else {  ?>
                                            	<img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/img_404.png" />
                                            <?php } ?>
                                            </a>
                                        </p>
				<div class="recent-post-title">
                		<a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </div>
				<div class="recent-meta"><?php echo get_the_date(); ?> | <?php comments_number(); ?></div>
				<?php the_excerpt(); ?>
<span class="rcmore"><a href="<?php the_permalink(); ?>"><?php esc_html_e('Read More','gravida'); ?></a></span>
			</div><?php if($k%4==0){?><div class="clear"></div><?php } ?>
            	<?php endwhile; the_posts_pagination(); ?>
                
            		</div>
      </div>
      <!-- blog-post --> 
    </section>
    <?php
} else {
    ?>
    <section class="site-main" id="sitemain">
      <div class="frontcontent">
        <?php
                    if ( have_posts() ) :
                        // Start the Loop.
                        while ( have_posts() ) : the_post();
                            /*
                             * Include the post format-specific template for the content. If you want to
                             * use this in a child theme, then include a file called called content-___.php
                             * (where ___ is the post format) and that will be used instead.
                             */
							 ?>
        <header class="entry-header">
          <h1>
            <?php the_title(); ?>
          </h1>
        </header>
        <?php 
			the_content();
                    
            endwhile;
                        // Previous/next post navigation.
						the_posts_pagination( array(
							'mid_size' => 2,
							'prev_text' => esc_html__( 'Back', 'gravida' ),
							'next_text' => esc_html__( 'Next', 'gravida' ),
						) );
                    
                    else :
                        // If no content, include the "No posts found" template.
                         get_template_part( 'no-results', 'index' );
                    
                    endif;
                    ?>
      </div>
      <!-- blog-post --> 
    </section>
    <?php } ?>
    <!-- sidebar_right -->
    <div class="clear"></div>
  </div>
  <!-- site-aligner --> 
</div>
<?php get_footer(); ?>