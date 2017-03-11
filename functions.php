<?php
if ( ! isset( $content_width ) ) $content_width = 800;

// canary- setup --------------->
add_action( 'after_setup_theme', 'canary_setup' );
function canary_setup() 
{
	add_theme_support('automatic-feed-links' );
	add_theme_support('title-tag' );
	add_theme_support('post-formats', array( 'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat' ) );
	add_theme_support('html5', array('comment-form', 'comment-list', 'gallery', 'caption'	) );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support('post-thumbnails' );
		set_post_thumbnail_size( 150, 150,true ); 
		add_image_size('canary-post-medium', 400, 250, true );
		add_image_size('canary-post-big', 850,300, true );
		add_image_size('canary-post-single', 800,0, false );
		add_image_size('canary-post-wide', 1200,500, true );

	add_theme_support( 'custom-logo', array(
		'height'      => 36,
		'width'       => 200,
		'flex-height' => true,
	) );
	add_theme_support( "custom-header", array(
		'width'        => 1600,
		'default-image'  => '',
		'height'        => 600,
		'header-text' => true,
		'video'              => true,
		'video-active-callback' => '',
		'default-text-color' => 'FFFFFF',
	));
	add_theme_support( "custom-background",  array(
		'default-color' => 'EFEFEF',
	) );
	add_editor_style(array());

	register_nav_menus( array(
		'primary' => __( 'Primary Menu','canary' ),
		'social'  => __( 'Social Menu','canary' ),
		'footer'  => __( 'Footer Menu','canary' ),
	) );
}// canary_setup

// canary sidebarsetup --------------->
function canary_sidebars(){
	$sidebars=array(
			array(
			'name'          => __( 'Canary Widget Area', 'canary' ),
			'id'            => 'canary_sidebar',
			'description'   => __( 'Add widgets here to appear in your sidebar.', 'canary' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) 	
	);
	return $sidebars;
}
add_action( 'widgets_init', 'canary_widgets_init' );
function  canary_widgets_init() {
	foreach(canary_sidebars() as $sidebar){
		register_sidebar($sidebar);
	}
}


// Customizer settings ----------->
function canary_customize_partial_blogname() {bloginfo( 'name' );}
function canary_customize_partial_blogdescription() {bloginfo( 'description' );}
add_action( 'customize_register', 'canary_customize_register', 11 );
function canary_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) 
	{
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector' => '.site-title a',
			'container_inclusive' => false,
			'render_callback' => 'canary_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector' => '.site-description',
			'container_inclusive' => false,
			'render_callback' => 'canary_customize_partial_blogdescription',
		) );
	
	}
	// Header background color setting and control.
	$wp_customize->add_setting( 'header_background_color', array(
		'default'           => '#e68e00',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_background_color', array(
		'label'       => __( 'Header Background Color', 'canary' ),
		'section'     => 'colors',
	) ) );

	// Footer background color setting and control.
	$wp_customize->add_setting( 'footer_bg_color', array(
		'default'           => '#E0E0E0',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_bg_color', array(
		'label'       => __( 'Footer Background Color', 'canary' ),
		'section'     => 'colors',
	) ) );
	

	// Widget Title Background Color.
	$wp_customize->add_setting( 'wt_bg_color', array(
		'default'           => '#e68e00',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wt_bg_color', array(
		'label'       => __( 'Widget Title Background Color', 'canary' ),
		'section'     => 'colors',
	) ) );
	
	// Button background color.
	$wp_customize->add_setting( 'bt_bg_color', array(
		'default'           => '#555555',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bt_bg_color', array(
		'label'       => __( 'Button background color', 'canary' ),
		'section'     => 'colors',
	) ) );

	// Widget Title Color.
	$wp_customize->add_setting( 'wt_color', array(
		'default'           => '#FFFFFF',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wt_color', array(
		'label'       => __( 'Widget Title Color', 'canary' ),
		'section'     => 'colors',
	) ) );

	// Button color.
	$wp_customize->add_setting( 'bt_color', array(
		'default'           => '#FFFFFF',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'bt_color', array(
		'label'       => __( 'Button color', 'canary' ),
		'section'     => 'colors',
	) ) );
	
	
	// Link color. 
	$wp_customize->add_setting( 'link_color', array(
		'default'           => '#b57000',
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
		'label'       => __( 'Link color', 'canary' ),
		'section'     => 'colors',
	) ) );
	
}




// Adding scripts and CSS --------------->
	add_action( 'wp_enqueue_scripts', 'canary_scripts' );
	function canary_scripts() {
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.css', array(), null,'all');
		wp_enqueue_style( 'canary-style', get_stylesheet_uri(), array() ,null,'all');
		wp_enqueue_style( 'canary-responsive', get_template_directory_uri() . '/assets/css/responsive.css', array(), null,'all');
		if(is_rtl()){
			wp_enqueue_style( 'canary-rtl', get_template_directory_uri() . '/assets/css/rtl.css', array(), null,'all');
		}
		
		if ( is_singular() ) { wp_enqueue_script( "comment-reply" ); }
		wp_enqueue_script( 'html5shiv',get_template_directory_uri().'/assets/js/html5.js', array( 'jquery' ), NULL, false );
    	wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );
		wp_enqueue_script( 'canary-script', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), NULL, false );
	}
	add_action( 'customize_controls_enqueue_scripts', 'canary_customize_control_js' );
	function canary_customize_control_js() {
		wp_enqueue_script( 'canary-color-scheme-control', get_template_directory_uri() . '/assets/js/color-scheme-control.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), NULL, true );
	}
	add_action( 'customize_preview_init', 'canary_customize_preview_js' );
	function canary_customize_preview_js() {
		wp_enqueue_script( 'canary-customize-preview', get_template_directory_uri() . '/assets/js/customize-preview.js', array( 'customize-preview' ), NULL, true );
	}

require (get_template_directory() . '/inc/main-funtions.php');
?>