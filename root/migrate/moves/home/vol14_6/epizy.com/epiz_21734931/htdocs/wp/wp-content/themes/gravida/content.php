<?php
/**
 * @package SKT Gravida
 */
?>
<div class="blog-post-repeat">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
        	<div class="post-thumb"><?php the_post_thumbnail(); ?>
            </div><!-- post-thumb -->
            <div class="blog-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></div>
            <?php if ( 'post' == get_post_type() ) : ?>
                <div class="postmeta">
                    <div class="post-date"><?php echo get_the_date(); ?></div><!-- post-date -->
                    <div class="post-comment"> &nbsp;|&nbsp; <a href="<?php comments_link(); ?>"><?php comments_number(); ?></a></div>
                    <div class="post-categories"> &nbsp;|&nbsp; <?php the_category( esc_attr__( ', ', 'gravida' )); ?></div>
                    <div class="clear"></div>
                </div><!-- postmeta -->
            <?php endif; ?>
        </header><!-- .entry-header -->
    
        <?php if ( is_search() || !is_single() ) : // Only display Excerpts for Search ?>
        <div class="entry-summary">
           	<?php the_excerpt(); ?>
            <p class="read-more"><a href="<?php the_permalink(); ?>"><?php esc_html_e('Read More &raquo;','gravida'); ?></a></p>
        </div><!-- .entry-summary -->
        <?php else : ?>
        <div class="entry-content">
            <?php the_content( esc_html__( 'Continue reading <span class="meta-nav">&rarr;</span>', 'gravida' ) ); ?>
            <?php
                wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_attr__( 'Pages:', 'gravida' ),
                    'after'  => '</div>',
                ) );
            ?>
        </div><!-- .entry-content -->
        <?php endif; ?>
    <!-- .entry-meta -->
    </article><!-- #post-## -->
</div><!-- blog-post-repeat -->