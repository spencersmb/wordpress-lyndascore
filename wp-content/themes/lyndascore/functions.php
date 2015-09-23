<?php
/**
 * Lyndascore functions and definitions.
 *
 * @link https://codex.wordpress.org/Functions_File_Explained
 *
 * @package Lyndascore
 */

//looks for child theme first
if ( ! function_exists( 'lyndascore_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function lyndascore_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Lyndascore, use a find and replace
	 * to change 'lyndascore' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'lyndascore', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'lyndascore' ),
		'social' => esc_html__( 'Social Menu', 'lyndascore' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside'
    //		'image',
    //		'video',
    //		'quote',
    //		'link',
	) );

	// Set up the WordPress core custom background feature.
    //	add_theme_support( 'custom-background', apply_filters( 'lyndascore_custom_background_args', array(
    //		'default-color' => 'ffffff',
    //		'default-image' => '',
    //	) ) );
}
endif; // lyndascore_setup

add_action( 'after_setup_theme', 'lyndascore_setup' );


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function lyndascore_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'lyndascore_content_width', 600 );
}

add_action( 'after_setup_theme', 'lyndascore_content_width', 0 );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function lyndascore_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'lyndascore' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

    register_sidebar( array(
        'name'          => __( 'Footer Widgets', 'lyndascore' ),
        'description'   => __( 'Footer widgets area appears in the footer of the site.', 'lyndascore' ),
        'id'            => 'sidebar-2',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h1 class="widget-title">',
        'after_title'   => '</h1>',
    ) );
}
add_action( 'widgets_init', 'lyndascore_widgets_init' );


/**
 * Enqueue scripts and styles.
 */
function lyndascore_scripts() {
    //Link to custom fonts
    wp_enqueue_style( 'simone-google-fonts', 'http://fonts.googleapis.com/css?family=PT+Serif:400,700,400italic,700italic|Roboto:400,300,500,100,400italic,700,900,900italic' );

    //Link to font awesome
    wp_enqueue_style( 'simone-font-awesome', 'http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' );

    //Master Style Sheet
	wp_enqueue_style( 'lyndascore-style', get_stylesheet_uri() );

    //Master Js file
	wp_enqueue_script( 'lyndascore-theme-js', get_template_directory_uri() . '/js/theme.js', array('jquery'), '20150913', true );

//	wp_enqueue_script( 'lyndascore-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'lyndascore_scripts' );


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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
