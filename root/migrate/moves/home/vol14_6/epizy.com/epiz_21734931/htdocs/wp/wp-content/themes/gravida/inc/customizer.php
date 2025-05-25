<?php
/**
 * SKT Gravida Theme Customizer
 *
 * @package SKT Gravida
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function gravida_customize_register( $wp_customize ) {
	
	//Add a class for titles
    class gravida_Info extends WP_Customize_Control {
        public $type = 'info';
        public $label = '';
        public function render_content() {
        ?>
			<h3 style="text-decoration: underline; color: #DA4141; text-transform: uppercase;"><?php echo esc_html( $this->label ); ?></h3>
        <?php
        }
    }
	
	class WP_Customize_Textarea_Control extends WP_Customize_Control {
    public $type = 'textarea';
 
    public function render_content() {
        ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
            </label>
        <?php
    }
}
	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->remove_control('header_textcolor');
	$wp_customize->remove_control('display_header_text');
	
	$wp_customize->add_setting('color_scheme',array(
			'default'	=> '#0ec7ab',
			'sanitize_callback'	=> 'sanitize_hex_color'
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'color_scheme',array(
			'label' => esc_html__('Color Scheme','gravida'),
			 'description' => sprintf( esc_html__( 'More color options in PRO Version', 'gravida')),			
			'section' => 'colors',
			'settings' => 'color_scheme'
		))
	);
	
	$wp_customize->add_section('footer_text',array(
			'title'	=> esc_html__('Footer Text','gravida'),
			'priority'	=> null,
	));
	
	$wp_customize->add_setting('footer_right',array(
			'default'	=> null,
			'sanitize_callback'	=> 'wp_kses'
	));
	
	$wp_customize->add_control(
		new WP_Customize_Textarea_Control(
			$wp_customize,
			'footer_right',
			array(
				'label'	=> esc_html__('Footer right text','gravida'),
				'section'	=> 'footer_text',
				'setting'	=> 'footer_right'
			)
		)
	);
	
	$wp_customize->add_section('slider_section',array(
		'title'	=> esc_html__('Slider Settings','gravida'),
		 'description' => sprintf( esc_html__( 'Featured Image Size Should be ( 1400x446 ) More slider settings available in PRO Version', 'gravida' )),	
		'priority'		=> null
	));
	
	// Slide Image 1
	$wp_customize->add_setting('slide_image1',array(
		'default'	=> null,
		'sanitize_callback'	=> 'esc_url_raw',
	));
	
	$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'slide_image1',
        array(
            'label' => esc_html__('Slide Image 1 (1400x446)','gravida'),
            'section' => 'slider_section',
            'settings' => 'slide_image1'
        )
    )
);

	$wp_customize->add_setting('slide_title1',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('slide_title1',array(
		'label'	=> esc_html__('Slider title 1','gravida'),
		'setting'	=> 'slide_title1',
		'section'	=> 'slider_section'
	));
	
	$wp_customize->add_setting('slide_desc1',array(
		'default'	=> null,
		'sanitize_callback'	=> 'wp_htmledit_pre'	
	));
	
	$wp_customize->add_control(
		new WP_Customize_Textarea_Control(
			$wp_customize,
			'slide_desc1',
			array(
				'label'	=> esc_html__('Slider description  1','gravida'),
				'setting'	=> 'slide_desc1',
				'section'	=> 'slider_section'
			)
		)
	);
	
	$wp_customize->add_setting('slide_link1',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('slide_link1',array(
			'label'	=> esc_html__('Slide link 1','gravida'),
			'setting'	=> 'slide_link1',
			'section'	=> 'slider_section'
	));
	
	$wp_customize->add_setting('slide_image2',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'slide_image2',
			array(
				'label'	=> esc_html__('Slide image 2','gravida'),
				'setting'	=> 'slide_image2',
				'section'	=> 'slider_section'
			)
		)
	);
	
	$wp_customize->add_setting('slide_title2',array(
			'default'	=> null,
			'sanitize_callback'		=> 'sanitize_text_field',
	));
	
	$wp_customize->add_control('slide_title2',array(
			'label'	=> esc_html__('Slide title 2','gravida'),
			'setting'	=> 'slide_title2',
			'section'	=> 'slider_section'
	));
	
	$wp_customize->add_setting('slide_desc2',array(
			'default'	=> null,
			'sanitize_callback'	=> 'wp_htmledit_pre'
	));
	
	$wp_customize->add_control(
		new WP_Customize_Textarea_Control(
			$wp_customize,
			'slide_desc2',
			array(
				'label'	=> esc_html__('Slide description 2','gravida'),
				'setting'	=> 'slide_desc2',
				'section'	=> 'slider_section'
			)
		)
	);
	
	$wp_customize->add_setting('slide_link2',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('slide_link2',array(
		'label'	=> esc_html__('Slide link 2','gravida'),
		'setting'	=> 'slide_link2',
		'section'	=> 'slider_section'
	));
	
	$wp_customize->add_setting('slide_image3',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'slide_image3',
			array(
				'label'	=> esc_html__('Slide Image 3','gravida'),
				'setting'	=> 'slide_image3',
				'section'	=> 'slider_section'
			)
		)
	);
	
	$wp_customize->add_setting('slide_title3',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('slide_title3',array(
			'label'	=> esc_html__('Slide title 3','gravida'),
			'setting'	=> 'slide_image3',
			'section'	=> 'slider_section'
	));
	
	$wp_customize->add_setting('slide_desc3',array(
			'default'	=> null,
			'sanitize_callback'	=> 'wp_htmledit_pre'
	));
	
	$wp_customize->add_control(
		new WP_Customize_Textarea_Control(
			$wp_customize,
			'slide_desc3',
			array(
				'label'	=> esc_html__('Slide Description 3','gravida'),
				'setting'	=> 'slide_desc3',
				'section'	=> 'slider_section'
			)
		)
	);
	
	$wp_customize->add_setting('slide_link3',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('slide_link3',array(
			'label'	=> esc_html__('Slide link 3','gravida'),
			'setting'	=> 'slide_link3',
			'section'	=> 'slider_section'
	));
	
	$wp_customize->add_setting('slide_image4',array(
			'default'	=> null,
			'sanitize_callback'	=> 'wp_htmledit_pre'
	));
	
	$wp_customize->add_control(
	 	new WP_Customize_Image_Control(
			$wp_customize,
			'slide_image4',
			array(
				'label'	=> esc_html__('Slide Image 4','gravida'),
				'setting'	=> 'slide_image4',
				'section'	=> 'slider_section'
			)
		)
	);
	
	$wp_customize->add_setting('slide_title4',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('slide_title4',array(
			'label'	=> esc_html__('Slide title 4','gravida'),
			'setting'	=> 'slide_title4',
			'section'	=> 'slider_section'
	));
	
	$wp_customize->add_setting('slide_desc4',array(
			'default'	=> null,
			'sanitize_callback'	=> 'wp_htmledit_pre'
	));
	
	$wp_customize->add_control(
		new WP_Customize_Textarea_Control(
			$wp_customize,
			'slide_desc4',
			array(
				'label'	=> esc_html__('Slide description 4','gravida'),
				'setting'	=> 'slide_desc4',
				'section'	=> 'slider_section'
			)
		)
	);
	
	$wp_customize->add_setting('slide_link4',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'
	));	
	
	$wp_customize->add_control('slide_link4',array(
			'label'	=> esc_html__('Slide link 4','gravida'),
			'setting'	=> 'slide_link4',
			'section'	=> 'slider_section'
	));
	
	$wp_customize->add_setting('slide_image5',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'slide_image5',
			array(
				'label'	=> esc_html__('Slide image 5','gravida'),
				'setting'	=> 'slide_image5',
				'section'	=> 'slider_section'
			)
		)
	);
	
	$wp_customize->add_setting('slide_title5',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('slide_title5',array(
			'label'	=> esc_html__('Slide title 5','gravida'),
			'setting'	=> 'slide_title5',
			'section'	=> 'slider_section'
	));
	
	$wp_customize->add_setting('slide_desc5',array(
			'default'	=> null,
			'sanitize_callback'	=> 'wp_htmledit_pre'
	));
	
	$wp_customize->add_control(
		new WP_Customize_Textarea_Control(
			$wp_customize,
			'slide_desc5',
			array(
				'label'	=> esc_html__('Slide description 5','gravida'),
				'setting'	=> 'slide_desc5',
				'section'	=> 'slider_section'
			)
		)
	);
	
	$wp_customize->add_setting('slide_link5',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('slide_link5',array(
			'label'	=> esc_html__('Slide link 5','gravida'),
			'setting'	=> 'slide_link5',
			'section'	=> 'slider_section'
	));
	
	$wp_customize->add_section('page_boxes',array(
		'title'	=> esc_html__('Homepage Boxes','gravida'),
			/* translators: %s: page boxes description */ 
 			'description' => sprintf( esc_html__( 'Featured Image Dimensions : ( 58 X 58 ) Select Featured Image for these pages  How to set featured image %s', 'gravida' ), sprintf( '<a href="%1$s" target="_blank">%2$s</a>', esc_url( '"'.SKT_THEME_FEATURED_SET_VIDEO_URL.'"' ), esc_html__( 'Click Here ?', 'gravida' )
						)
					),
		'priority'	=> null
	));
	
	$wp_customize->add_setting(
    'page-setting1',
		array(
			'default' => '0',
			'capability' => 'edit_theme_options',		
			'sanitize_callback' => 'gravida_sanitize_integer',
		)
	);
 
	$wp_customize->add_control(
		'page-setting1',
		array(
			'type' => 'dropdown-pages',
			'label' => esc_html__('Choose a page for box one:','gravida'),
			'section' => 'page_boxes',
		)
	);
	
	$wp_customize->add_setting('page-setting2',array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback'	=> 'gravida_sanitize_integer'
	));
	
	$wp_customize->add_control('page-setting2',array(
			'type'	=> 'dropdown-pages',
			'label'	=> esc_html__('Choose a page for box two:','gravida'),
			'section'	=> 'page_boxes'	
	));
	
	$wp_customize->add_setting('page-setting3',array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback'	=> 'gravida_sanitize_integer'
	));
	
	$wp_customize->add_control('page-setting3',array(
			'type'	=> 'dropdown-pages',
			'label'	=> esc_html__('Choose a page for box three:','gravida'),
			'section'	=> 'page_boxes'
	));
	
	$wp_customize->add_setting('page-setting4',array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback'	=> 'gravida_sanitize_integer'
	));
	
	$wp_customize->add_control('page-setting4',array(
			'type'	=> 'dropdown-pages',
			'label'	=> esc_html__('Choose a page for box four:','gravida'),
			'section'	=> 'page_boxes'
	));
	
	$wp_customize->add_section('social_sec',array(
			'title'	=> esc_html__('Social Settings','gravida'),
			'description' => sprintf( esc_html__( 'More social icon available in PRO Version', 'gravida' )),	
			'priority'		=> null
	));
	
	
	$wp_customize->add_setting('social_heading',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'	
	));
	
	$wp_customize->add_control('social_heading',array(
			'label'	=> esc_html__('Add social heading here','gravida'),
			'setting'	=> 'social_heading',
			'section'	=> 'social_sec'
	));	
	
	$wp_customize->add_setting('fb_link',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'	
	));
	
	$wp_customize->add_control('fb_link',array(
			'label'	=> esc_html__('Add facebook link here','gravida'),
			'setting'	=> 'fb_link',
			'section'	=> 'social_sec'
	));
	
	$wp_customize->add_setting('twitt_link',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('twitt_link',array(
			'label'	=> esc_html__('Add twitter link here','gravida'),
			'setting'	=> 'twitt_link',
			'section'	=> 'social_sec'
	));
	
	$wp_customize->add_setting('gplus_link',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('gplus_link',array(
			'label'	=> esc_html__('Add google plus link here','gravida'),
			'setting'	=> 'gplus_link',
			'section'	=> 'social_sec'
	));
	
	$wp_customize->add_setting('linked_link',array(
			'default'	=> null,
			'sanitize_callback'	=> 'esc_url_raw'
	));
	
	$wp_customize->add_control('linked_link',array(
			'label'	=> esc_html__('Add linkedin link here','gravida'),
			'setting'	=> 'linked_link',
			'section'	=> 'social_sec'
	));
	
	$wp_customize->add_section('contact_sec',array(
			'title'	=> esc_html__('Contact Details','gravida'),
			'description'	=> esc_html__('Add you contact details here','gravida'),
			'priority'	=> null
	));
	
	$wp_customize->add_setting('contact_title',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('contact_title',array(
			'label'	=> esc_html__('Add contact title here','gravida'),
			'setting'	=> 'contact_title',
			'section'	=> 'contact_sec'
	));
	
	$wp_customize->add_setting('contact_desc',array(
			'default'	=> null,
			'sanitize_callback'	=> 'wp_htmledit_pre'
	));
	
	$wp_customize->add_control(
		new WP_Customize_Textarea_Control(
			$wp_customize,
			'contact_desc',
			array(
				'label'	=> esc_html__('Add contact description here','gravida'),
				'setting'	=> 'contact_desc',
				'section'	=> 'contact_sec'
			)
		)
	);
	
	$wp_customize->add_setting('contact_add',array(
			'default'	=> null,
			'sanitize_callback'	=> 'wp_htmledit_pre'
	));
	
	$wp_customize->add_control(
		new WP_Customize_Textarea_Control(
			$wp_customize,
			'contact_add',
			array(
				'label'	=> esc_html__('Add contact address here','gravida'),
				'setting'	=> 'contact_add',
				'section'	=> 'contact_sec'
			)
		)
	);
	
	$wp_customize->add_setting('contact_no',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_text_field'
	));
	
	$wp_customize->add_control('contact_no',array(
			'label'	=> esc_html__('Add contact number here.','gravida'),
			'setting'	=> 'contact_no',
			'section'	=> 'contact_sec'
	));
	
	$wp_customize->add_setting('contact_mail',array(
			'default'	=> null,
			'sanitize_callback'	=> 'sanitize_email'
	));
	
	$wp_customize->add_control('contact_mail',array(
			'label'	=> esc_html__('Add you email here','gravida'),
			'setting'	=> 'contact_mail',
			'section'	=> 'contact_sec'
	));

}
add_action( 'customize_register', 'gravida_customize_register' );
 
//Integer
function gravida_sanitize_integer( $input ) {
    if( is_numeric( $input ) ) {
        return intval( $input );
    }
}

function gravida_custom_css(){
		?>
        	<style type="text/css">
					.logo h2::first-letter, 
					#content h1.entry-title::first-letter,
					.feature-box a,
					.latest-blog span a,
					.postmeta a:hover, 
					a, 
					#footer .widget-column a:hover, 
					#copyright a:hover,
					.blog-post-repeat .entry-summary a, 
					.entry-content a,
					#sidebar aside h3.widget-title,
					.blog-post-repeat .blog-title a{
						color:<?php echo esc_attr(get_theme_mod('color_scheme','#0ec7ab')); ?>;
					}
					.site-nav li:hover a, 
					.site-nav li.current_page_item a,
					.nivo-caption h1 a,
					.site-nav li:hover ul li:hover, 
					.site-nav li:hover ul li.current-page-item,
					.site-nav li:hover ul li,
					p.form-submit input[type="submit"],
					#sidebar aside.widget_search input[type="submit"], 
					.wpcf7 input[type="submit"], 
					.add-icon, 
					.phone-icon, 
					.mail-icon,
					.pagination ul li .current, .pagination ul li a:hover{
						background-color:<?php echo esc_attr(get_theme_mod('color_scheme','#0ec7ab')); ?>;
					}
			</style>
<?php }
add_action('wp_head','gravida_custom_css');	

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
 
function gravida_customize_preview_js() {
	wp_enqueue_script( 'gravida_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'gravida_customize_preview_js' );