<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package SKT Gravida
 */
?>
<footer id="footer">
	<div class="site-aligner">
    		<div class="widget-column">
            <div class="cols">
            <?php $contact_title = get_theme_mod('contact_title'); ?>  
            <?php if (!empty($contact_title)){  ?>
            <h2><?php echo esc_html($contact_title); ?></h2>
            <?php } ?>
            
                 <?php $contact_desc = get_theme_mod('contact_desc'); ?> 
                 <?php if (!empty($contact_desc)){  ?>
                    <p><?php echo wp_kses_post($contact_desc); ?></p>
                <?php } ?>
                
                <?php $contact_add = get_theme_mod('contact_add'); ?> 
                <?php if(!empty($contact_add)){?>
                    <div class="add-icon"></div><!-- add-icon --><div class="add-content"><?php echo wp_kses_post($contact_add); ?></div><!-- add-content --><div class="clear"></div>
                <?php } ?>
                
                <?php $contact_no = get_theme_mod('contact_no'); ?> 
                	<?php if(!empty($contact_no)){?>
                    <div class="phone-icon"></div><!-- phone-icon --><div class="phone-content"><?php echo esc_html($contact_no); ?></div><!-- phone-content --><div class="clear"></div>
                <?php } ?>
                
                               <?php $contact_mail = get_theme_mod('contact_mail'); ?>          
               <?php if(!empty($contact_mail)){ ?>
                    <div class="mail-icon"></div><!-- mail-icon --><div class="mail-content"><a href="mailto:<?php echo esc_attr( antispambot(sanitize_email( $contact_mail ) )); ?>"><?php echo esc_html( antispambot( $contact_mail ) ); ?></a></div><!-- mail-content --><div class="clear"></div>
                <?php } ?>
            </div><!-- cols -->
       </div><!-- widget-column -->
       <div class="widget-column">
       		<?php if(!dynamic_sidebar('twitter-wid')) : ?>
                <div class="cols"><h2><?php esc_html_e('Recent Tweets','gravida'); ?></h2>
                   <p><?php esc_html_e('Use twitter widget for twitter feed.','gravida'); ?></p>
                </div><!-- cols -->
            <?php endif; ?>
        </div><!-- widget-column -->
        <div class="widget-column">
            <div class="cols"><h2><?php esc_html_e('Recent Posts','gravida'); ?></h2>
            	
	<?php $args = array( 'posts_per_page' => 4, 'post__not_in' => get_option('sticky_posts'), 'orderby' => 'date', 'order' => 'desc' );
			query_posts( $args ); ?>
				<ul>
					<?php while ( have_posts() ) :  the_post(); ?>
                    		<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                    <?php endwhile; ?>
                </ul>
                </div><!-- cols -->
        </div><!-- widget-column -->
        <div class="widget-column last">
            <div class="cols">
            <?php $social_heading = get_theme_mod('social_heading'); ?>
					<?php if (!empty($social_heading)) { ?>
                    <h2><?php echo esc_html($social_heading); ?></h2>
                    <?php } ?>
            		<div class="social">
                        <?php $fb_link = get_theme_mod('fb_link'); ?>
                        <?php if (!empty($fb_link)) { ?>
                         <a target="_blank" href="<?php echo esc_url($fb_link); ?>" title="Facebook" ><div class="fb icon"></div><span><?php esc_html_e('Facebook','gravida'); ?></span></a>
 						<?php } ?>

                        <?php $twitt_link = get_theme_mod('twitt_link'); ?>
                        <?php if (!empty($twitt_link)) { ?>
                         <a target="_blank" href="<?php echo esc_url($twitt_link); ?>" title="Twitter" ><div class="twitt icon"></div><span><?php esc_html_e('Twitter','gravida'); ?></span></a>
                         <?php } ?>
                         
                        <?php $gplus_link = get_theme_mod('gplus_link'); ?>
                        <?php if (!empty($gplus_link)) { ?>
                         <a target="_blank" href="<?php echo esc_url($twitt_link); ?>" title="Google Plus" ><div class="gplus icon"></div><span><?php esc_html_e('Google +','gravida'); ?></span></a>
                         <?php } ?>
                         
                        <?php $linked_link = get_theme_mod('linked_link'); ?>
                        <?php if (!empty($linked_link)) { ?>
                         <a target="_blank" href="<?php echo esc_url($linked_link); ?>" title="Linkedin"><div class="linkedin icon"></div><span><?php esc_html_e('Linkedin','gravida'); ?></span></a>
                         <?php } ?>
                         
                </div><!-- social -->
            </div><!-- cols -->
        </div><!-- widget-column --><div class="clear"></div>
	</div><!-- site-aligner -->
</footer>
<div id="copyright">
	<div class="site-aligner">
    	<div class="left"><?php printf('<a target="_blank" href="'.esc_url(SKT_URL).'" rel="nofollow">Gravida</a>' ); ?></div>
    	<div class="right"><?php $footerrights = get_theme_mod('footer_right'); echo esc_html($footerrights); ?></div>
        <div class="clear"></div>
    </div>
</div><!-- copyright -->
</div><!-- wrapper -->
<?php wp_footer(); ?>
</body>
</html>