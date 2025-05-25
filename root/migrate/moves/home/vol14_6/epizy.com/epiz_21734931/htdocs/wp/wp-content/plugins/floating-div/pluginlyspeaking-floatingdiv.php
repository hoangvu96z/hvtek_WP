<?php 
/**
 * Plugin Name: PluginlySpeaking FloatingDiv
 * Plugin URI: http://pluginlyspeaking.com/plugins/floating-div/
 * Description: Sticky container, Floating Div is arguably the simplest way to show any type of content on a side of the screen that will remain visible as the user scrolls
 * Author: PluginlySpeaking
 * Version: 3.0
 * Author URI: http://www.pluginlyspeaking.com
 * License: GPL2
 */

  // Check for the PRO version
add_action( 'admin_init', 'psfd_free_pro_check' );
function psfd_free_pro_check() {
    if (is_plugin_active('pluginlyspeaking-floatingdiv-pro/pluginlyspeaking-floatingdiv-pro.php')) {

        function my_admin_notice(){
        echo '<div class="updated">
                <p>Floating Div <strong>PRO</strong> version is activated.</p>
				<p>Floating Div <strong>FREE</strong> version is desactivated.</p>
              </div>';
        }
        add_action('admin_notices', 'my_admin_notice');

        deactivate_plugins(__FILE__);
    }
}
 
 add_action( 'wp_enqueue_scripts', 'psfd_add_script' );

function psfd_add_script() {
	wp_enqueue_style( 'psfd_css', plugins_url('css/psfd.css', __FILE__));
	wp_enqueue_script('jquery');	
	wp_enqueue_script('jquery-effects-fold');
	wp_enqueue_script('jquery-effects-slide');
	wp_enqueue_script('jquery-effects-fade');
	wp_enqueue_script('jquery-effects-explode');
	wp_enqueue_script('jquery-effects-clip');
}

// Enqueue admin styles
add_action( 'admin_enqueue_scripts', 'psfd_add_admin_style' );
function psfd_add_admin_style() {
	wp_enqueue_style( 'psfd_admin_css', plugins_url('css/psfd_admin.css', __FILE__));
	wp_enqueue_script('jquery-effects-pulsate');
}

function psfd_create_type() {
  register_post_type( 'floating_div_ps',
    array(
      'labels' => array(
        'name' => 'Floating Div',
        'singular_name' => 'Floating Div'
      ),
      'public' => true,
      'has_archive' => false,
      'hierarchical' => false,
      'supports'           => array( 'title' ),
      'menu_icon'    => 'dashicons-plus',
    )
  );
}

add_action( 'init', 'psfd_create_type' );


function psfd_admin_css() {
    global $post_type;
    $post_types = array( 
                        'floating_div_ps',
                  );
    if(in_array($post_type, $post_types))
    echo '<style type="text/css">#edit-slug-box, #post-preview, #view-post-btn{display: none;}</style>';
}

function psfd_remove_view_link( $action ) {

    unset ($action['view']);
    return $action;
}

add_filter( 'post_row_actions', 'psfd_remove_view_link' );
add_action( 'admin_head-post-new.php', 'psfd_admin_css' );
add_action( 'admin_head-post.php', 'psfd_admin_css' );

function psfd_check($cible,$test){
  if($test == $cible){return ' checked="checked" ';}
}

add_action('add_meta_boxes','psfd_init_settings_metabox');

function psfd_init_settings_metabox(){
  add_meta_box('psfd_settings_metabox', 'Settings', 'psfd_add_settings_metabox', 'floating_div_ps', 'side', 'high');
}

function psfd_add_settings_metabox($post){
	
	$prefix = '_floating_div_';
	
	$width = get_post_meta($post->ID, $prefix.'width',true);
	if($width == '')
		$width = "260px";

	$all_pages  = get_post_meta($post->ID, $prefix.'all_pages',true);		
	?>
	<table class="psfd_table_settings">
		<tr class="psfd_pro_features">
			<td colspan="2"><label for="collapsible">Do you want a collapsible content ? </label>
				<select name="collapsible" class="psfd_select_100" disabled >
					<option value="no">No</option>
					<option value="yes">Yes</option>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2"><label for="width">Width of content : </label>
				<select name="width" class="psfd_select_100">
					<option <?php selected( $width, "160px"); ?> value="160px">Tiny</option>
					<option <?php selected( $width, "210px");  ?> value="210px">Small</option>
					<option <?php selected( $width, "260px"); ?> value="260px">Medium</option>
					<option <?php selected( $width, "310px");  ?> value="310px">Large</option>
					<option <?php selected( $width, "360px");  ?> value="360px">Huge</option>
				</select>
			</td>
		</tr>
		<tr>
			<td><label for="all_pages">Show on all pages : </label></td>
			<td><input type="radio" id="all_pages_yes" name="all_pages" value="yes" <?php echo (empty($all_pages)) ? '' : psfd_check($all_pages,'yes'); ?>> Yes <input type="radio" id="all_pages_no" name="all_pages" value="no" <?php echo (empty($all_pages)) ? 'checked="checked"' : psfd_check($all_pages,'no'); ?>> No<br></td>
		</tr>
		<tr class="psfd_pro_features">
			<td><label for="force_font">Force original font : </label></td>
			<td><input type="radio" name="force_font" value="yes" disabled> Yes <input type="radio" name="force_font" value="no" disabled > No<br></td>
		</tr>
		<tr class="psfd_pro_features">
			<td><label for="">Device Restriction : </label></td>
			<td>
				<input type="checkbox" name="device_restrict_no_mobile" value="psfd_no_mobile" disabled /> Hide on Mobile 
				<br /><input type="checkbox" name="device_restrict_no_tablet" value="psfd_no_tablet" disabled /> Hide on Tablet
				<br /><input type="checkbox" name="device_restrict_no_desktop" value="psfd_no_desktop" disabled /> Hide on Desktop
			</td>
		</tr>
		<tr class="psfd_pro_features">
			<td colspan="2"><label for="user_restrict">User Restriction : </label>
				<select name="user_restrict" class="psfd_select_100" disabled>
					<option value="all">All</option>
					<option value="logged_in">Logged In</option>
					<option value="guest">Guest</option>
				</select>
			</td>
		</tr>
	</table>	
	<?php 
	
}

add_action('add_meta_boxes','psfd_init_advert_metabox');

function psfd_init_advert_metabox(){
  add_meta_box('psfd_advert_metabox', 'Upgrade to PRO Version', 'psfd_add_advert_metabox', 'floating_div_ps', 'side', 'low');
}

function psfd_add_advert_metabox($post){	
	?>
	
	<ul style="list-style-type:disc;padding-left:20px;margin-bottom:25px;">
		<li>Get a collapsible content</li>
		<li>Reveal your div after some time</li>
		<li>Hide your div after some time</li>
		<li>Fix your div after scrolling</li>
		<li>Container location</li>
		<li>Use your theme's font</li>
		<li>Device restriction</li>
		<li>User restriction</li>
		<li>And more...</li>
	</ul>
	
		<label for="pro_features" style="font-size:10pt;font-weight:bold;color:#33b690;" >Show all PRO features : </label>
		<input type="radio" id="pro_features_yes" name="pro_features" value="yes" > Yes 
		<input type="radio" id="pro_features_no" name="pro_features" value="no" checked="checked" > No
	
	<a style="margin-top:30px;text-decoration: none;display:inline-block; background:#33b690; padding:8px 25px 8px; border-bottom:3px solid #33a583; border-radius:3px; color:white;" target="_blank" href="http://pluginlyspeaking.com/plugins/floating-div/">Go to the PRO version</a>
	<span style="display:block;margin-top:14px; font-size:13px; color:#0073AA; line-height:20px;">
		<span class="dashicons dashicons-tickets"></span> Code <strong>FD10OFF</strong> (10% OFF)
	</span>
	
	<script type="text/javascript">
		$=jQuery.noConflict();
		jQuery(document).ready( function($) {
			$('input[name=pro_features]').live('change', function(){
				if($('#pro_features_yes').is(':checked')) {
					$('.psfd_pro_features').show("pulsate", {times:2}, 2000);
				} 
				if($('#pro_features_no').is(':checked')) {
					$('.psfd_pro_features').hide("pulsate", {times:2}, 2000);
				} 
			});
		});
	</script>
	
	<?php 
	
}

add_action('add_meta_boxes','psfd_init_content_metabox');

function psfd_init_content_metabox(){
  add_meta_box('psfd_content_metabox', 'Build your Floating Div', 'psfd_add_content_metabox', 'floating_div_ps', 'normal');
}

function psfd_add_content_metabox($post){
	$prefix = '_floating_div_';

	$content = get_post_meta($post->ID, $prefix.'content',true);
	$position = get_post_meta($post->ID, $prefix.'position',true);
	$margin_top = get_post_meta($post->ID, $prefix.'margin_top',true);
	$margin_bottom = get_post_meta($post->ID, $prefix.'margin_bottom',true);
	$margin_right = get_post_meta($post->ID, $prefix.'margin_right',true);
	$margin_left = get_post_meta($post->ID, $prefix.'margin_left',true);
	$borders = get_post_meta($post->ID, $prefix.'borders',true);	
	$border_color = get_post_meta($post->ID, $prefix.'border_color',true);	
	$corners = get_post_meta($post->ID, $prefix.'corners',true);
	$background = get_post_meta($post->ID, $prefix.'background',true);
	$background_color = get_post_meta($post->ID, $prefix.'background_color',true);
	$image = get_post_meta($post->ID, $prefix.'image',true);
	
	$settings = array( 'textarea_name' => 'content' );	
	wp_editor( htmlspecialchars_decode($content), 'psfd_content', $settings);
	
	?>
	
	<h2 class="psfd_admin_title">Position</h2>
	
		<table class="psfd_table_100">
			<tr>
				<td class="psfd_table_100_label">
					<label for="position">Choose your floating div position : </label>
				</td>
				<td class="psfd_table_100_input">	
					<select name="position" class="psfd_select_125p">
						<option <?php selected( $position, "top_right"); ?> id="psfd_position_top_right" value="top_right">Top Right</option>
						<option <?php selected( $position, "top");  ?> id="psfd_position_top" value="top">Top</option>
						<option <?php selected( $position, "top_left"); ?> id="psfd_position_top_left" value="top_left">Top Left</option>
						<option <?php selected( $position, "bottom_right");  ?> id="psfd_position_bottom_right" value="bottom_right">Bottom Right</option>
						<option <?php selected( $position, "bottom");  ?> id="psfd_position_bottom" value="bottom">Bottom</option>
						<option <?php selected( $position, "bottom_left");  ?> id="psfd_position_bottom_left" value="bottom_left">Bottom Left</option>
					</select>
				</td>
				<td class="psfd_table_100_label">
					<div class="psfd_div_margins psfd_div_margin_top">
						<label for="margin_top" class="psfd_label_margins" >Specify a margin Top : </label>
					</div>
					<div class="psfd_div_margins psfd_div_margin_bottom">
						<label for="margin_bottom" class="psfd_label_margins" >Specify a margin Bottom : </label>
					</div>
					<div class="psfd_div_margins psfd_div_margin_right">
						<label for="margin_right" class="psfd_label_margins" >Specify a margin Right : </label>
					</div>
					<div class="psfd_div_margins psfd_div_margin_left">
						<label for="margin_left" class="psfd_label_margins" >Specify a margin Left : </label>
					</div>
				</td>
				<td class="psfd_table_100_input">
					<div class="psfd_div_margins psfd_div_margin_top">
						<input type="text" id="psfd_margin_top" class="psfd_input_align_right psfd_input_small_width" name="margin_top" value="<?php echo $margin_top; ?>" /> px
					</div>
					<div class="psfd_div_margins psfd_div_margin_bottom">
						<input type="text" id="psfd_margin_bottom" class="psfd_input_align_right psfd_input_small_width" name="margin_bottom" value="<?php echo $margin_bottom; ?>" /> px
					</div>
					<div class="psfd_div_margins psfd_div_margin_right">
						<input type="text" id="psfd_margin_right" class="psfd_input_align_right psfd_input_small_width" name="margin_right" value="<?php echo $margin_right; ?>" /> px
					</div>
					<div class="psfd_div_margins psfd_div_margin_left">
						<input type="text" id="psfd_margin_left" class="psfd_input_align_right psfd_input_small_width" name="margin_left" value="<?php echo $margin_left; ?>" /> px
					</div>
				</td>
				<td>
				</td>
			</tr>
		</table>
	<h2 class="psfd_admin_title">Style</h2>
		

		<table class="psfd_table_100">
			<tr>
				<td class="psfd_table_100_label">
					<label for="corners">Do you want rounded corners ? </label>
				</td>
				<td class="psfd_table_100_input">
					<input type="radio" id="corners_yes" name="corners" class="psfd_radio_pright" value="25px" <?php echo (empty($corners)) ? '' : psfd_check($corners,'25px'); ?>> Yes 
					<input type="radio" id="corners_no" name="corners" class="psfd_radio_pright psfd_radio_pleft" value="2px" <?php echo (empty($corners)) ? 'checked="checked"' : psfd_check($corners,'2px'); ?>> No	
				</td>
				<td>
				</td>
				<td>
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<td class="psfd_table_100_label">
					<label for="borders">Do you want a border ? </label>
				</td>
				<td class="psfd_table_100_input">
					<input type="radio" id="psfd_borders_yes" name="borders" class="psfd_radio_pright" value="yes" <?php echo (empty($borders)) ? 'checked="checked"' : psfd_check($borders,'yes'); ?>> Yes 
					<input type="radio" id="psfd_borders_no" name="borders" class="psfd_radio_pright psfd_radio_pleft" value="no" <?php echo (empty($borders)) ? '' : psfd_check($borders,'no'); ?>> No
				</td>
				<td class="psfd_table_100_label">
					<div class="psfd_border_color">
						<label for="border_color" class="psfd_label_colorpicker" >Choose your Border Color : </label>
					</div>
				</td>
				<td class="psfd_table_100_input">
					<div class="psfd_border_color">
						<input id="border_color" name="border_color" type="text" value="<?php echo (empty($border_color)) ? '#000000' : $border_color; ?>" class="psfd_colorpicker" />
					</div>
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<td class="psfd_table_100_label" >
					<label for="background">Choose your background type : </label>
				</td>
				<td class="psfd_table_100_input">
					<select name="background" class="psfd_select_125p">
						<option <?php selected( $background, "color"); ?> id="psfd_background_color" value="color">Color</option>
						<option <?php selected( $background, "image");  ?> id="psfd_background_image" value="image">Image</option>
					</select>
				</td>
				<td class="psfd_table_100_label">
					<div class="psfd_div_background_color">
						<label for="background_color" class="psfd_label_colorpicker">Choose your Background Color : </label>
					</div>					
					<div class="psfd_div_background_image">
						<label for="image" class="psfd_back_image">Choose your Background Image : </label>
					</div>
				</td>
				<td class="psfd_table_100_input">
					<div class="psfd_div_background_color">
						<input id="background_color" name="background_color" type="text" value="<?php echo (empty($background_color)) ? '#FFFFFF' : $background_color; ?>" class="psfd_colorpicker" />
					</div>					
					<div class="psfd_div_background_image">
						<input type="text" name="image" id="psfd_media_background_image" value="<?php echo $image; ?>" />
						<input type="button" class="button background-image-button" value="Choose an image" />
					</div>
				</td>
				<td>
				</td>
			</tr>
		</table>	
		
	<div id="psfd_collapsible_settings" class="psfd_pro_features">
		<h2 class="psfd_admin_title">Collapsible Effect</h2>
	
		<table class="psfd_table_100">
			<tr>
				<td class="psfd_table_100_label">
					<label for="speed">Choose your effect speed : </label>
				</td>
				<td class="psfd_table_100_input">
					<select name="speed" class="psfd_select_125p" disabled>
						<option value="1">Instant</option>
						<option value="300">Fast</option>
						<option value="600">Medium</option>
						<option value="900">Slow</option>
					</select>
				</td>
				<td class="psfd_table_100_label">
					<label for="position_start">In which position your collapsible element should start ? </label>
				</td>
				<td class="psfd_table_100_input">
					<input type="radio" name="position_start" value="collapsed" disabled> Collapsed 
					<input type="radio" name="position_start" value="expanded" disabled> Expanded
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<td class="psfd_table_100_label">
					<label for="button_image" >Button Image to <strong>expand</strong> your content : </label>
				</td>
				<td class="psfd_table_100_input">
					<input type="text" name="button_image" id="psfd_media_button_image" value="" disabled />
					<input type="button" class="button button-image-button" value="Choose an image" disabled />
				</td>
				<td class="psfd_table_100_label">
					<label for="button_image_collapse" >Button Image to <strong>collapse</strong> your content : </label>
				</td>
				<td class="psfd_table_100_input">
					<input type="text" name="button_image_collapse" id="psfd_media_button_image_collapse" value="" disabled />
					<input type="button" class="button button-image-collapse-button" value="Choose an image" disabled />
				</td>
				<td>
				</td>
			</tr>
		</table>	
	</div>
	
	<div id="psfd_stop_on_scroll" class="psfd_pro_features">
		<h2 class="psfd_admin_title">Stop Scrolling</h2>
	
		<table class="psfd_table_100">
			<tr>
				<td class="psfd_table_100_label">
					<label for="stop_scroll">Stop Scrolling at a certain point : </label>
				</td>
				<td class="psfd_table_100_input">
					<select name="stop_scroll" class="psfd_select_125p" disabled >
						<option id="psfd_stop_scroll_yes" value="yes">Enable</option>
						<option id="psfd_stop_scroll_no" value="no">Disable</option>						
					</select>
				</td>
				<td class="psfd_table_100_label psfd_if_stop_scroll">
					<label for="stop_scroll_distance">How far would the user have to scroll ? </label>
				</td>
				<td class=" psfd_table_100_input psfd_if_stop_scroll">
					<input type="text" class="psfd_input_align_right psfd_input_small_width" name="stop_scroll_distance" value="" disabled /> px
				</td>
				<td>
				</td>
			</tr>
		</table>	
	</div>
	
	<div id="psfd_appearing_settings" class="psfd_pro_features">
		<h2 class="psfd_admin_title">Appearing Effect</h2>
	
		<table class="psfd_table_100">
			<tr>
				<td class="psfd_table_100_label">
					<label for="appearing_active">Do you want an Appearing Effect : </label>
				</td>
				<td class="psfd_table_100_input">
					<select name="appearing_active" class="psfd_select_125p" disabled>
						<option id="psfd_appearing_active_yes" value="yes">Enable</option>
						<option id="psfd_appearing_active_no" value="no">Disable</option>						
					</select>
				</td>
				<td class="psfd_table_100_label">
					<div class="psfd_if_appearing_active">
						<label for="appear_cond_time">How long before revealing the content ? </label>
					</div>
				</td>
				<td class="psfd_table_100_input">
					<div class="psfd_if_appearing_active">
						<input type="text" class="psfd_input_align_right psfd_input_small_width" name="appear_cond_time" value="" disabled /> ms
					</div>
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<td class="psfd_table_100_label psfd_if_appearing_active">
					<label for="appearing_effect">Choose your Appearing Effect : </label>
				</td>
				<td class="psfd_table_100_input psfd_if_appearing_active">
					<select name="appearing_effect" class="psfd_select_125p" disabled >
						<option class="psfd_appear_slide_or_clip_no" value="fade">Fade In</option>
						<option class="psfd_appear_slide_or_clip_yes" id="psfd_appear_slide_effect" value="slide">Slide In</option>
						<option class="psfd_appear_slide_or_clip_no" value="fold">Unfold</option>
						<option class="psfd_appear_slide_or_clip_no" value="explode">Assemble</option>
						<option class="psfd_appear_slide_or_clip_yes" id="psfd_appear_clip_effect"value="clip">Clip In</option>
					</select>
				</td>
				<td class="psfd_table_100_label psfd_appear_slide_or_clip">
					<label for="appear_slide_direction">Choose the effect direction : </label>
				</td>
				<td class="psfd_table_100_input psfd_appear_slide_or_clip">
					<div id="psfd_appear_slide_direction_div">
						<select name="appear_slide_direction" class="psfd_select_125p" disabled >
							<option value="up">Up</option>
							<option value="down">Down</option>
							<option value="left">Left</option>
							<option value="right">Right</option>
						</select>
					</div>
				</td>
				<td>
				</td>
			</tr>
		</table>	
	</div>
	
	<div id="psfd_disappearing_settings" class="psfd_pro_features">
		<h2 class="psfd_admin_title">Disappearing Effect</h2>
	
		<table class="psfd_table_100">
			<tr>
				<td class="psfd_table_100_label">
					<label for="disappearing_active">Do you want a Disappearing Effect : </label>
				</td>
				<td class="psfd_table_100_input">
					<select name="disappearing_active" class="psfd_select_125p" disabled >
						<option id="psfd_disappearing_active_yes" value="yes">Enable</option>
						<option id="psfd_disappearing_active_no" value="no">Disable</option>
					</select>
				</td>
				<td class="psfd_table_100_label">
					<div class="psfd_if_disappearing_active">
						<label for="disappear_cond_time">How long before hiding the content ? </label>
					</div>
				</td>	
				<td class="psfd_table_100_input">
					<div class="psfd_if_disappearing_active">
						<input type="text" class="psfd_input_align_right psfd_input_small_width" name="disappear_cond_time" value="" disabled /> ms
					</div>
				</td>
				<td>
				</td>
			</tr>
			<tr>
				<td class="psfd_table_100_label psfd_if_disappearing_active">
					<label for="disappearing_effect">Choose your Disappearing Effect : </label>
				</td>
				<td class="psfd_table_100_input psfd_if_disappearing_active">
					<select name="disappearing_effect" class="psfd_select_125p" disabled >
						<option class="psfd_disappear_slide_or_clip_no" value="fade">Fade Out</option>
						<option class="psfd_disappear_slide_or_clip_yes" id="psfd_disappear_slide_effect" value="slide">Slide Out</option>
						<option class="psfd_disappear_slide_or_clip_no" value="fold">Fold</option>
						<option class="psfd_disappear_slide_or_clip_no" value="explode">Explode</option>
						<option class="psfd_disappear_slide_or_clip_yes" id="psfd_disappear_clip_effect" value="clip">Clip Out</option>
					</select>
				</td>
				<td class="psfd_table_100_label psfd_disappear_slide_or_clip">
					<label for="disappear_slide_direction">Choose the effect direction : </label>
				</td>
				<td class="psfd_table_100_input psfd_disappear_slide_or_clip">
					<div id="psfd_disappear_slide_direction_div" >
						<select name="disappear_slide_direction" class="psfd_select_125p" disabled>
							<option value="down">Down</option>
							<option value="left">Left</option>
							<option value="right">Right</option>
						</select>
					</div>
				</td>
				<td>
				</td>				
			</tr>
		</table>	
	</div>
	
	<script type="text/javascript">
		$=jQuery.noConflict();
		jQuery(document).ready( function($) {
			
			if($('#psfd_position_top_right').is(':selected')) {
				$('.psfd_div_margin_top').show();
				$('.psfd_div_margin_bottom').hide();
				$('.psfd_div_margin_right').show();
				$('.psfd_div_margin_left').hide();
			} 
			if($('#psfd_position_top').is(':selected')) {
				$('.psfd_div_margin_top').show();
				$('.psfd_div_margin_bottom').hide();
				$('.psfd_div_margin_right').hide();
				$('.psfd_div_margin_left').hide();
			} 
			if($('#psfd_position_top_left').is(':selected')) {
				$('.psfd_div_margin_top').show();
				$('.psfd_div_margin_bottom').hide();
				$('.psfd_div_margin_right').hide();
				$('.psfd_div_margin_left').show();
			} 
			if($('#psfd_position_bottom_right').is(':selected')) {
				$('.psfd_div_margin_top').hide();
				$('.psfd_div_margin_bottom').show();
				$('.psfd_div_margin_right').show();
				$('.psfd_div_margin_left').hide();
			} 
			if($('#psfd_position_bottom').is(':selected')) {
				$('.psfd_div_margin_top').hide();
				$('.psfd_div_margin_bottom').show();
				$('.psfd_div_margin_right').hide();
				$('.psfd_div_margin_left').hide();
			} 
			if($('#psfd_position_bottom_left').is(':selected')) {
				$('.psfd_div_margin_top').hide();
				$('.psfd_div_margin_bottom').show();
				$('.psfd_div_margin_right').hide();
				$('.psfd_div_margin_left').show();
			} 
			
			$('select[name=position]').live('change', function(){
				if($('#psfd_position_top_right').is(':selected')) {
					$('.psfd_div_margin_top').show();
					$('.psfd_div_margin_bottom').hide();
					$('.psfd_div_margin_right').show();
					$('.psfd_div_margin_left').hide();
				} 
				if($('#psfd_position_top').is(':selected')) {
					$('.psfd_div_margin_top').show();
					$('.psfd_div_margin_bottom').hide();
					$('.psfd_div_margin_right').hide();
					$('.psfd_div_margin_left').hide();
				} 
				if($('#psfd_position_top_left').is(':selected')) {
					$('.psfd_div_margin_top').show();
					$('.psfd_div_margin_bottom').hide();
					$('.psfd_div_margin_right').hide();
					$('.psfd_div_margin_left').show();
				} 
				if($('#psfd_position_bottom_right').is(':selected')) {
					$('.psfd_div_margin_top').hide();
					$('.psfd_div_margin_bottom').show();
					$('.psfd_div_margin_right').show();
					$('.psfd_div_margin_left').hide();
				} 
				if($('#psfd_position_bottom').is(':selected')) {
					$('.psfd_div_margin_top').hide();
					$('.psfd_div_margin_bottom').show();
					$('.psfd_div_margin_right').hide();
					$('.psfd_div_margin_left').hide();
				} 
				if($('#psfd_position_bottom_left').is(':selected')) {
					$('.psfd_div_margin_top').hide();
					$('.psfd_div_margin_bottom').show();
					$('.psfd_div_margin_right').hide();
					$('.psfd_div_margin_left').show();
				} 
			});						
			
			if($('#psfd_background_color').is(':selected')) {
				$('.psfd_div_background_color').show();
				$('.psfd_div_background_image').hide();
			} 
			if($('#psfd_background_image').is(':selected')) {
				$('.psfd_div_background_color').hide();
				$('.psfd_div_background_image').show();
			} 
			
			$('select[name=background]').live('change', function(){
				if($('#psfd_background_color').is(':selected')) {
					$('.psfd_div_background_color').show();
					$('.psfd_div_background_image').hide();
				} 
				if($('#psfd_background_image').is(':selected')) {
					$('.psfd_div_background_color').hide();
					$('.psfd_div_background_image').show();
				} 
			});
			
			if($('#psfd_borders_yes').is(':checked')) {
				$('.psfd_border_color').show();
			} 
			if($('#psfd_borders_no').is(':checked')) {
				$('.psfd_border_color').hide();
			} 
			
			$('input[name=borders]').live('change', function(){
				if($('#psfd_borders_yes').is(':checked')) {
					$('.psfd_border_color').show();
				} 
				if($('#psfd_borders_no').is(':checked')) {
					$('.psfd_border_color').hide();
				} 
			});
		});
	</script>
	
	<?php


}

function psfd_colorpicker_enqueue() {
    global $typenow;
    if( $typenow == 'floating_div_ps' ) {
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'psfd_colorpicker', plugin_dir_url( __FILE__ ) . 'js/psfd_colorpicker.js', array( 'wp-color-picker' ) );
    }
}
add_action( 'admin_enqueue_scripts', 'psfd_colorpicker_enqueue' );	

add_action( 'admin_enqueue_scripts', 'psfd_image_file_enqueue' );
function psfd_image_file_enqueue() {
	global $typenow;
	if( $typenow == 'floating_div_ps' ) {
		wp_enqueue_media();
 
		// Registers and enqueues the required javascript.
		wp_register_script( 'psfd_media_cover-js', plugin_dir_url( __FILE__ ) . 'js/psfd_media_cover.js', array( 'jquery' ) );
		wp_localize_script( 'psfd_media_cover-js', 'psfd_media_cover_js',
			array(
				'title' => __( 'Choose or Upload an image'),
				'button' => __( 'Use this file'),
			)
		);
		wp_enqueue_script( 'psfd_media_cover-js' );
	}
}

add_action('save_post','psfd_save_metabox');
function psfd_save_metabox($post_id){
	
	$prefix = '_floating_div_';
	
	//Metabox Settings
	if(isset($_POST['width'])){
		update_post_meta($post_id, $prefix.'width', sanitize_text_field($_POST['width']));
	}
	if(isset($_POST['all_pages'])){
		update_post_meta($post_id, $prefix.'all_pages', sanitize_text_field($_POST['all_pages']));
	}

	if(isset($_POST['content'])){
		update_post_meta($post_id, $prefix.'content', $_POST['content']);
	}	
	if(isset($_POST['position'])){
		update_post_meta($post_id, $prefix.'position', sanitize_text_field($_POST['position']));
	}	
	if(isset($_POST['margin_top'])){
		update_post_meta($post_id, $prefix.'margin_top', sanitize_text_field($_POST['margin_top']));
	}
	if(isset($_POST['margin_bottom'])){
		update_post_meta($post_id, $prefix.'margin_bottom', sanitize_text_field($_POST['margin_bottom']));
	}
	if(isset($_POST['margin_left'])){
		update_post_meta($post_id, $prefix.'margin_left', sanitize_text_field($_POST['margin_left']));
	}
	if(isset($_POST['margin_right'])){
		update_post_meta($post_id, $prefix.'margin_right', sanitize_text_field($_POST['margin_right']));
	}
	if(isset($_POST['corners'])){
		update_post_meta($post_id, $prefix.'corners', sanitize_text_field($_POST['corners']));
	}
	if(isset($_POST['borders'])){
		update_post_meta($post_id, $prefix.'borders', sanitize_text_field($_POST['borders']));
	}
	if(isset($_POST['border_color'])){
		update_post_meta($post_id, $prefix.'border_color', sanitize_text_field($_POST['border_color']));
	}
	if(isset($_POST['background'])){
		update_post_meta($post_id, $prefix.'background', sanitize_text_field($_POST['background']));
	}
	if(isset($_POST['background_color'])){
		update_post_meta($post_id, $prefix.'background_color', sanitize_text_field($_POST['background_color']));
	}
	if(isset($_POST['image'])){
		update_post_meta($post_id, $prefix.'image', sanitize_text_field($_POST['image']));
	}
}

add_action( 'manage_floating_div_ps_posts_custom_column' , 'psfd_custom_columns_pro', 10, 2 );

function psfd_custom_columns_pro( $column, $post_id ) {
    switch ( $column ) {
	case 'shortcode' :
		global $post;
		$pre_slug = '' ;
		$pre_slug = $post->post_title;
		$slug = sanitize_title($pre_slug);
    	$shortcode = '<span style="border: solid 3px lightgray; background:white; padding:7px; font-size:17px; line-height:40px;">[floating_div_ps name="'.$slug.'"]</strong>';
	    echo $shortcode; 
	    break;
    }
}

function psfd_add_columns($columns) {
    return array_merge($columns, 
              array('shortcode' => __('Shortcode'),
                    ));
}
add_filter('manage_floating_div_ps_posts_columns' , 'psfd_add_columns');

function psfd_get_wysiwyg_output_pro( $meta_key, $post_id = 0 ) {
    global $wp_embed;

    $post_id = $post_id ? $post_id : get_the_id();

    $content = get_post_meta( $post_id, $meta_key, 1 );
    $content = $wp_embed->autoembed( $content );
    $content = $wp_embed->run_shortcode( $content );
    $content = do_shortcode( $content );
    $content = wpautop( $content );

    return $content;
}

function psfd_shortcode($atts) {
	extract(shortcode_atts(array(
		"name" => ''
	), $atts));
		
	global $post;
    $args = array('post_type' => 'floating_div_ps', 'numberposts'=>-1);
    $custom_posts = get_posts($args);
	$output = '';
	foreach($custom_posts as $post) : setup_postdata($post);
	$sanitize_title = sanitize_title($post->post_title);
	if ($sanitize_title == $name)
	{
	$prefix = '_floating_div_';
	$all_pages = get_post_meta( get_the_id(), $prefix.'all_pages',true);
	if ($all_pages == '')
		$all_pages = 'no';
	
	if($all_pages == "no")
	{
		$div_content = get_post_meta( get_the_id(), $prefix . 'content', true );
		$div_width = get_post_meta( get_the_id(), $prefix . 'width', true );
		if ($div_width == '')
			$div_width = '260px';
		$div_width_class = "psfd_width_".$div_width;

		$div_corners = get_post_meta( get_the_id(), $prefix . 'corners', true );
		$div_position = get_post_meta( get_the_id(), $prefix . 'position', true );
		if ($div_position == '')
			$div_position = 'top_right';
		if (in_array($div_position, array('top_right', 'top', 'top_left'), true))
		{
			$div_margin_top = get_post_meta( get_the_id(), $prefix . 'margin_top', true );
			if ($div_margin_top == "")
				$div_margin_top = 0;
		}
		if (in_array($div_position, array('top_right', 'bottom_right'), true))
		{
			$div_margin_right = get_post_meta( get_the_id(), $prefix . 'margin_right', true );
			if ($div_margin_right == "")
				$div_margin_right = 0;
		}
		if (in_array($div_position, array('top_left', 'bottom_left'), true))
		{
			$div_margin_left = get_post_meta( get_the_id(), $prefix . 'margin_left', true );
			if ($div_margin_left == "")
				$div_margin_left = 0;
		}
		if (in_array($div_position, array('bottom_right', 'bottom', 'bottom_left'), true))
		{
			$div_margin_bottom = get_post_meta( get_the_id(), $prefix . 'margin_bottom', true );
			if ($div_margin_bottom == "")
				$div_margin_bottom = 0;
		}
		
		$div_borders = get_post_meta( get_the_id(), $prefix.'borders',true);
		$div_border_color = get_post_meta( get_the_id(), $prefix . 'border_color', true );
		if($div_border_color == "")
			$div_border_color = '#000000';
		
		if($div_borders == "yes" || $div_borders == "")
			$border_class = 'border:2px solid '.$div_border_color.'';
		
		if($div_borders == "no")
			$border_class = "border-style:none";

		$div_background = get_post_meta( get_the_id(), $prefix . 'background', true );

		if ($div_background == '')
			$div_background = 'color';
		$background = 'background:#FFFFFF';
		if ($div_background == 'color')
		{
			$div_background_color = get_post_meta( get_the_id(), $prefix . 'background_color', true );
			if($div_background_color == "")
				$div_background_color = '#FFFFFF';
			$background = 'background:'.$div_background_color.'';
		}
		
		if ($div_background == 'image')
		{
			$div_image = get_post_meta( get_the_id(), $prefix.'image',true);
			$background = 'background-image:url('.esc_attr($div_image).')';
		}
			
		$postid = get_the_ID();
		
		$css_position = '';
		switch ($div_position) {
		case 'top_right':
			$css_position .= 'right:'.$div_margin_right.'px;';   
			$css_position .= 'top:'.$div_margin_top.'px;';  
			break;
		case 'top':
			$css_position .= 'top:'.$div_margin_top.'px;';  
			$css_position .= 'left:50%;margin-left:-'. $div_width / 2 . 'px;'; 
			break;
		case 'top_left':
			$css_position .= 'left:'.$div_margin_left.'px;';  
			$css_position .= 'top:'.$div_margin_top.'px;';  
			break;
		case 'bottom_right':
			$css_position .= 'right:'.$div_margin_right.'px;';   
			$css_position .= 'bottom:'.$div_margin_bottom.'px;';  
			break;
		case 'bottom':
			$css_position .= 'bottom:'.$div_margin_bottom.'px;';  
			$css_position .= 'left:50%;margin-left:-'. $div_width / 2 . 'px;'; 
			break;
		case 'bottom_left':
			$css_position .= 'left:'.$div_margin_left.'px;';   
			$css_position .= 'bottom:'.$div_margin_bottom.'px;';  
			break;
		default:
			$css_position .= 'right:10px;';    
			$css_position .= 'top:10px;';  
		}
		$output = '';
		
		$output .= '<div id="floatdiv_'.$postid.'" class="exp_floatdiv_content_pro '.$device_restrict_no_tablet.' '.$device_restrict_no_desktop.' '.$device_restrict_no_mobile.' '.$force_font_class.' '.$div_width_class.'" style="'.$css_position.';border-radius:'.esc_attr( $div_corners).';'.$background.';">';
		$output .= '<div class="exp_floatdiv_content_padding_pro" style="'.$border_class.';border-radius:'.esc_attr( $div_corners).';">';
		$output .= ''. psfd_get_wysiwyg_output_pro( $prefix . 'content', get_the_ID() )  .'';
		$output .= '</div>';
		$output .= '</div>';
		
		$output .= '<script type="text/javascript">';
		$output .= '$j=jQuery.noConflict();';
		$output .= '$j(document).ready(function()';
		$output .= '{';					
		$output .= '$j("#floatdiv_'.$postid.'").appendTo("body");';
		$output .= 'var height = $j("#floatdiv_'.$postid.'").height();';
		$output .= '$j("#floatdiv_'.$postid.'").height(height);';		
		$output .= '})';	
		$output .= '</script>';
	}
    
	}
	endforeach; wp_reset_query();
	return $output;
}
add_shortcode( 'floating_div_ps', 'psfd_shortcode' );

function psfd_footer() {
	global $post;
    $args = array('post_type' => 'floating_div_ps', 'numberposts'=>-1);
    $custom_posts = get_posts($args);
	$output = '';
	foreach($custom_posts as $post) : setup_postdata($post);

	$prefix = '_floating_div_';
	$all_pages = get_post_meta( get_the_id(), $prefix.'all_pages',true);
	if ($all_pages == '')
		$all_pages = 'no';
	
	if($all_pages == "yes")
	{
		$div_content = get_post_meta( get_the_id(), $prefix . 'content', true );
		$div_width = get_post_meta( get_the_id(), $prefix . 'width', true );
		if ($div_width == '')
			$div_width = '260px';
		$div_width_class = "psfd_width_".$div_width;

		$div_corners = get_post_meta( get_the_id(), $prefix . 'corners', true );
		$div_position = get_post_meta( get_the_id(), $prefix . 'position', true );
		if ($div_position == '')
			$div_position = 'top_right';
		if (in_array($div_position, array('top_right', 'top', 'top_left'), true))
		{
			$div_margin_top = get_post_meta( get_the_id(), $prefix . 'margin_top', true );
			if ($div_margin_top == "")
				$div_margin_top = 0;
		}
		if (in_array($div_position, array('top_right', 'bottom_right'), true))
		{
			$div_margin_right = get_post_meta( get_the_id(), $prefix . 'margin_right', true );
			if ($div_margin_right == "")
				$div_margin_right = 0;
		}
		if (in_array($div_position, array('top_left', 'bottom_left'), true))
		{
			$div_margin_left = get_post_meta( get_the_id(), $prefix . 'margin_left', true );
			if ($div_margin_left == "")
				$div_margin_left = 0;
		}
		if (in_array($div_position, array('bottom_right', 'bottom', 'bottom_left'), true))
		{
			$div_margin_bottom = get_post_meta( get_the_id(), $prefix . 'margin_bottom', true );
			if ($div_margin_bottom == "")
				$div_margin_bottom = 0;
		}	
		
		$div_borders = get_post_meta( get_the_id(), $prefix.'borders',true);
		$div_border_color = get_post_meta( get_the_id(), $prefix . 'border_color', true );
		if($div_border_color == "")
			$div_border_color = '#000000';
		
		if($div_borders == "yes" || $div_borders == "")
			$border_class = 'border:2px solid '.$div_border_color.'';
		
		if($div_borders == "no")
			$border_class = "border-style:none";

		$div_background = get_post_meta( get_the_id(), $prefix . 'background', true );

		if ($div_background == '')
			$div_background = 'color';
		$background = 'background:#FFFFFF';
		if ($div_background == 'color')
		{
			$div_background_color = get_post_meta( get_the_id(), $prefix . 'background_color', true );
			if($div_background_color == "")
				$div_background_color = '#FFFFFF';
			$background = 'background:'.$div_background_color.'';
		}
		
		if ($div_background == 'image')
		{
			$div_image = get_post_meta( get_the_id(), $prefix.'image',true);
			$background = 'background-image:url('.esc_attr($div_image).')';
		}
			
		$postid = get_the_ID();
		
		$css_position = '';
		switch ($div_position) {
		case 'top_right':
			$css_position .= 'right:'.$div_margin_right.'px;';   
			$css_position .= 'top:'.$div_margin_top.'px;';  
			break;
		case 'top':
			$css_position .= 'top:'.$div_margin_top.'px;';  
			$css_position .= 'left:50%;margin-left:-'. $div_width / 2 . 'px;'; 
			break;
		case 'top_left':
			$css_position .= 'left:'.$div_margin_left.'px;';  
			$css_position .= 'top:'.$div_margin_top.'px;';  
			break;
		case 'bottom_right':
			$css_position .= 'right:'.$div_margin_right.'px;';   
			$css_position .= 'bottom:'.$div_margin_bottom.'px;';  
			break;
		case 'bottom':
			$css_position .= 'bottom:'.$div_margin_bottom.'px;';  
			$css_position .= 'left:50%;margin-left:-'. $div_width / 2 . 'px;'; 
			break;
		case 'bottom_left':
			$css_position .= 'left:'.$div_margin_left.'px;';   
			$css_position .= 'bottom:'.$div_margin_bottom.'px;';  
			break;
		default:
			$css_position .= 'right:10px;';    
			$css_position .= 'top:10px;';  
		}

		$output = '';
		
		$output .= '<div id="floatdiv_'.$postid.'" class="exp_floatdiv_content_pro '.$div_width_class.'" style="'.$css_position.';border-radius:'.esc_attr( $div_corners).';'.$background.';">';
		$output .= '<div class="exp_floatdiv_content_padding_pro" style="'.$border_class.';border-radius:'.esc_attr( $div_corners).';">';
		$output .= ''. psfd_get_wysiwyg_output_pro( $prefix . 'content', get_the_ID() )  .'';
		$output .= '</div>';
		$output .= '</div>';
		
		$output .= '<script type="text/javascript">';
		$output .= '$j=jQuery.noConflict();';
		$output .= '$j(document).ready(function()';
		$output .= '{';					
		$output .= '$j("#floatdiv_'.$postid.'").appendTo("body");';
		$output .= 'var height = $j("#floatdiv_'.$postid.'").height();';
		$output .= '$j("#floatdiv_'.$postid.'").height(height);';
		
		$output .= '})';	
		$output .= '</script>';

	}
    
	endforeach; wp_reset_query();
	echo $output;
}
add_action( 'wp_footer', 'psfd_footer' );


	
?>