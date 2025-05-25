<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package SKT Gravida
 */

get_header(); ?>

<div id="content">
    <div class="site-aligner">
        <section class="site-main content-left" id="sitemain">
			<?php if ( have_posts() ) : ?>
                <header class="page-header">
                    <?php the_archive_title( '<h1 class="entry-title">', '</h1>' ); 
						  the_archive_description( '<div class="taxonomy-description">', '</div>' );
                    ?>
                </header><!-- .page-header -->
				<div class="blog-post">
					<?php /* Start the Loop */ ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'content', get_post_format() ); ?>
                    <?php endwhile; ?>
                </div>
                <?php  
				// Previous/next post navigation.
				the_posts_pagination( array(
							'mid_size' => 2,
							'prev_text' => esc_html__( 'Back', 'gravida' ),
							'next_text' => esc_html__( 'Next', 'gravida' ),
							'screen_reader_text' => esc_html__( 'Posts navigation', 'gravida' )
				) );
			    ?>
            <?php else : ?>
                <?php get_template_part( 'no-results'); ?>
            <?php endif; ?>
        </section>
        <div class="sidebar_right">
        <?php get_sidebar();?>
        </div><!-- sidebar_right -->
        <div class="clear"></div>
    </div><!-- site-aligner -->
</div><!-- content -->	
<?php get_footer(); ?>