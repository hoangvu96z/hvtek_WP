<?php
//about theme info
add_action( 'admin_menu', 'gravida_abouttheme' );
function gravida_abouttheme() {    	
	add_theme_page( esc_html__('About Theme', 'gravida'), esc_html__('About Theme', 'gravida'), 'edit_theme_options', 'gravida_guide', 'gravida_mostrar_guide');   
} 

//guidline for about theme
function gravida_mostrar_guide() { 
	//custom function about theme customizer
	$return = add_query_arg( array()) ;
?>
<style type="text/css">
@media screen and (min-width: 800px) {
.col-left {float:left; width: 65%; padding: 1%;}
.col-right {float:right; width: 30%; padding:1%; border-left:1px solid #DDDDDD; }
}
</style>

<div class="wrapper-info">
	<div class="col-left">
   		   <div style="font-size:16px; font-weight:bold; padding-bottom:5px; border-bottom:1px solid #ccc;">
			  <?php esc_attr_e('About Theme Info', 'gravida'); ?>
		   </div>
          <p><?php esc_attr_e('SKT Gravida as the name suggests is a responsive corporate multipurpose WordPress theme. It is a responsive theme and is suitable for any kind of industry. So not just Corporate but other industries like business, commercial, industrial, architects, professionals also can use it. Theme options and templates make this theme very easy to use. Compatible with popular plugins like WooCommerce and Contact form 7. Slider and content portions easy to set up and use.','gravida'); ?></p>
		  <a href="<?php echo esc_url(SKT_PRO_THEME_URL); ?>"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/free-vs-pro.png" alt="" /></a>
	</div><!-- .col-left -->
	
	<div class="col-right">			
			<div style="text-align:center; font-weight:bold;">
				<hr />
				<a href="<?php echo esc_url(SKT_THEME_DEMO); ?>" target="_blank"><?php esc_attr_e('Live Demo', 'gravida'); ?></a> | 
				<a href="<?php echo esc_url(SKT_PRO_THEME_URL); ?>"><?php esc_attr_e('Buy Pro', 'gravida'); ?></a> | 
				<a href="<?php echo esc_url(SKT_THEME_DOC); ?>" target="_blank"><?php esc_attr_e('Documentation', 'gravida'); ?></a>
                <div style="height:5px"></div>
				<hr />                
                <a href="<?php echo esc_url(SKT_URL); ?>" target="_blank"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/sktskill.jpg" alt="" /></a>
			</div>		
	</div><!-- .col-right -->
</div><!-- .wrapper-info -->
<?php } ?>