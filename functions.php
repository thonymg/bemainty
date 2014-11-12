<?php

if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'bemainty_setup' ) ) :
function bemainty_setup() {


	load_theme_textdomain( 'bemainty', get_template_directory() . '/languages' );


	add_theme_support( 'post-thumbnails' );
    
    add_image_size('large-thumb', 1280, 580, true);
    add_image_size('index-thumb', 1280, 330, true);
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'bemainty' ),
        'social'  => __( 'Social Media', 'bemainty'),
	) );

    
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );


	add_theme_support( 'post-formats', array(
	) );
	add_theme_support( 'custom-background', apply_filters( 'bemainty_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; 
add_action( 'after_setup_theme', 'bemainty_setup' );

function bemainty_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'bemainty' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'bemainty_widgets_init' );

function bemainty_scripts() {
	wp_enqueue_style( 'bemainty-style', get_stylesheet_uri() );
    
        
    /*Javascripts */
    
    wp_deregister_script( 'bemainty-jquery' );
    $jquery_cdn = '//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js';
    wp_enqueue_script( 'bemainty-jquery', $jquery_cdn, array(), '20130115', true );
    
    
	wp_enqueue_script( 'bemainty-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
    
    wp_enqueue_script( 'bemainty-superfish', get_template_directory_uri() . '/js/superfish.min.js', array(), '20120206', true );
    wp_enqueue_script( 'bemainty-superfish-settings', get_template_directory_uri() . '/js/superfish-settings.js', array(), '20120206', true );

    
    wp_enqueue_script( 'bemainty-hide-search', get_template_directory_uri() . '/js/hide-search.js', array(), '20120206', true );

	wp_enqueue_script( 'bemainty-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
    


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bemainty_scripts' );

require get_template_directory() . '/inc/custom-header.php';

require get_template_directory() . '/inc/template-tags.php';

require get_template_directory() . '/inc/extras.php';

require get_template_directory() . '/inc/customizer.php';

require get_template_directory() . '/inc/jetpack.php';

function bemainty_excerpt_more( $more ) {
	return ' <a class="more-link" href="'. get_permalink( get_the_ID() ) . '">' . __('Read More', 'bemainty') . '<span class="meta-nav">&rarr;</span></a>';
}
add_filter( 'excerpt_more', 'bemainty_excerpt_more' );

$font_url = 'http://fonts.googleapis.com/css?family=Oswald:400,300,700|Open+Sans:400,300italic,300,400italic,600,600italic';
function bemainty_add_editor_styles() {
    add_editor_style( array( 'inc/editor-style.css', str_replace( ',', '%2C', $font_url ) ) );
}
add_action( 'after_setup_theme', 'bemainty_add_editor_styles' );