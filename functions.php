<?php
/**
 * Product Pulse functions and definitions
 *
 * @package Product Pulse
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 848; /* pixels */
}

if ( ! function_exists( 'product_pulse_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function product_pulse_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Product Pulse, use a find and replace
	 * to change 'product-pulse' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'product-pulse', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'product-pulse' ),
	) );

	// Enable support for Post Formats.
	// add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
//	add_theme_support( 'custom-background', apply_filters( 'product_pulse_custom_background_args', array(
//		'default-color' => 'ffffff',
//		'default-image' => '',
//	) ) );
}
endif; // product_pulse_setup
add_action( 'after_setup_theme', 'product_pulse_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function product_pulse_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'product-pulse' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'product_pulse_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function product_pulse_scripts() {
    if ( is_admin() ) wp_enqueue_style( 'product-pulse', get_stylesheet_uri() );

    if ( !is_admin() ) wp_enqueue_style( 'product-pulse-style', get_stylesheet_directory_uri() . '/css/style.css' );

	wp_enqueue_script( 'product-pulse-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'product-pulse-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

    wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/vendor/js/modernizr.min.js', array(), '', false );

    wp_register_script( 'webshim', get_template_directory_uri() . '/vendor/webshim/js-webshim/minified/polyfiller.js', array('jquery', 'modernizr'), '', true );

    wp_enqueue_script( 'product-pulse', get_template_directory_uri() . '/js/min/product-pulse.min.js', array('jquery', 'webshim'));
}
add_action( 'wp_enqueue_scripts', 'product_pulse_scripts' );

function portfolio_perspectives_bg_size () { ?>
<!--[if lte IE 8]>
<style>
    .site-header, .site-branding h1, .site-branding h2, .bg-size { -ms-behavior: url('<?php echo get_template_directory_uri() . '/vendor/background-size-polyfill/backgroundsize.min.htc' ?>');}
</style>
<script type="text/javascript" src="<?php echo get_template_directory_uri() . '/vendor/respond/dest/respond.min.js' ?>"></script>
<![endif]-->
<?php }
add_action( 'wp_head', 'portfolio_perspectives_bg_size', 100 );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

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
