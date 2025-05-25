<?php
/**
 * SKT Gravida functions and definitions
 *
 * @package SKT Gravida
 */

if ( ! function_exists( 'gravida_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function gravida_setup() {
	if ( ! isset( $content_width ) )
		$content_width = 640; /* pixels */

	load_theme_textdomain( 'gravida', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support('woocommerce');
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-header' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo', array(
		'height'      => 50,
		'width'       => 250,
		'flex-height' => true,
	) );
	add_image_size('gravida-homepage-thumb',240,145,true);
	register_nav_menus( array(
		'primary' => esc_attr( 'Primary Menu', 'gravida' ),
	) );
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff'
	) );
	add_editor_style( 'editor-style.css' );
}
endif; // gravida_setup
add_action( 'after_setup_theme', 'gravida_setup' );


function gravida_widgets_init() {
	register_sidebar( array(
		'name'          => esc_attr( 'Blog Sidebar', 'gravida' ),
		'description'   => esc_attr( 'Appears on blog page sidebar', 'gravida' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => esc_attr( 'Twitter Widget', 'gravida' ),
		'description'   => esc_attr( 'Appears on footer of the page', 'gravida' ),
		'id'            => 'twitter-wid',
		'before_widget' => '<div class="cols">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>',
	) );
	
	
}
add_action( 'widgets_init', 'gravida_widgets_init' );


function gravida_font_url(){
		$font_url = '';
		
		/* Translators: If there are any character that are
		* not supported by Roboto, translate this to off, do not
		* translate into your own language.
		*/
		$roboto = _x('on', 'Roboto font:on or off','gravida');
		
		/* Translators: If there are any character that are not
		* supported by Oswald, trsnalate this to off, do not
		* translate into your own language.
		*/
		$oswald = _x('on','Oswald:on or off','gravida');
		
		/* Translators: If there has any character that are not supported 
		*  by Scada, translate this to off, do not translate
		*  into your own language.
		*/
		$scada = _x('on','Scada:on or off','gravida');
		
		if('off' !== $roboto || 'off' !== $oswald){
			$font_family = array();
			
			if('off' !== $roboto){
				$font_family[] = 'Roboto:300,400,600,700,800,900';
			}
			if('off' !== $oswald){
				$font_family[] = 'Oswald:300,400,600,700';
			}
			if('off' !== $scada){
				$font_family[] = 'Scada:300,400,600,700';
			}
			$query_args = array(
				'family'	=> urlencode(implode('|',$font_family)),
			);
			
			$font_url = add_query_arg($query_args,'//fonts.googleapis.com/css');
		}
		
	return $font_url;
	}


function gravida_scripts() {
	wp_enqueue_style('gravida-font', gravida_font_url(), array());
	wp_enqueue_style( 'gravida-basic-style', get_stylesheet_uri() );
	wp_enqueue_style( 'gravida-editor-style', get_template_directory_uri()."/editor-style.css" );
	wp_enqueue_style( 'gravida-nivoslider-style', get_template_directory_uri()."/css/nivo-slider.css" );
	wp_enqueue_style( 'gravida-main-style', get_template_directory_uri()."/css/main.css" );		
	wp_enqueue_style( 'gravida-base-style', get_template_directory_uri()."/css/style_base.css" );
	wp_enqueue_script( 'gravida-nivo-script', get_template_directory_uri() . '/js/jquery.nivo.slider.js', array('jquery') );
	wp_enqueue_script( 'gravida-custom_js', get_template_directory_uri() . '/js/custom.js' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'gravida_scripts' );
 
define('SKT_URL','https://www.sktthemes.net','gravida');
define('SKT_THEME_URL','https://www.sktthemes.net/themes','gravida');
define('SKT_THEME_DEMO','http://sktthemesdemo.net/gravida/','gravida');
define('SKT_THEME_URL_DIRECT','https://www.sktthemes.net/shop/gravida-corporate-wordpress-theme/','gravida');
define('SKT_THEME_DOC','http://sktthemesdemo.net/documentation/gravida-documentation/','gravida');
define('SKT_PRO_THEME_URL','https://www.sktthemes.net/shop/gravida-corporate-wordpress-theme/','gravida');
define('SKT_THEME_FEATURED_SET_VIDEO_URL','https://www.youtube.com/watch?v=310YGYtGLIM','gravida');

/**
 * Implement the Custom Header feature.
 */

require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template for about theme.
 */
require get_template_directory() . '/inc/about-themes.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

// get slug by id
function gravida_get_slug_by_id($id) {
	$post_data = get_post($id, ARRAY_A);
	$slug = $post_data['post_name'];
	return $slug; 
}

if ( ! function_exists( 'gravida_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 */
function gravida_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;

require_once get_template_directory() . '/customize-pro/example-1/class-customize.php';