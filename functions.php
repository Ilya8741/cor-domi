<?php
/**
 * cor-domi functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package cor-domi
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.2.7' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function cor_domi_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on cor-domi, use a find and replace
		* to change 'cor-domi' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'cor-domi', get_template_directory() . '/languages' );

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
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'cor-domi' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'cor_domi_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'cor_domi_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function cor_domi_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'cor_domi_content_width', 640 );
}
add_action( 'after_setup_theme', 'cor_domi_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function cor_domi_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'cor-domi' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'cor-domi' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'cor_domi_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function cor_domi_scripts() {

	/**
	 * 1) fonts.css
	 *    /assets/css/fonts.css
	 */
	$fonts_rel  = '/assets/css/fonts.css';
	$fonts_path = get_template_directory() . $fonts_rel;
	$fonts_uri  = get_template_directory_uri() . $fonts_rel;

	wp_enqueue_style(
		'cor-domi-fonts',
		$fonts_uri,
		array(),
		file_exists( $fonts_path ) ? filemtime( $fonts_path ) : _S_VERSION
	);

	/**
	 * 2) custom.css
	 *    /assets/css/custom.css
	 */
	$custom_rel  = '/assets/css/custom.css';
	$custom_path = get_template_directory() . $custom_rel;
	$custom_uri  = get_template_directory_uri() . $custom_rel;

	wp_enqueue_style(
		'cor-domi-custom',
		$custom_uri,
		array( 'cor-domi-fonts' ),
		file_exists( $custom_path ) ? filemtime( $custom_path ) : _S_VERSION
	);

	 // Header menu
	wp_enqueue_script(
		'cor-domi-burger',
		get_template_directory_uri() . '/assets/js/header-menu.js',
		[],
		_S_VERSION,
		true
	);

	/**
	 * 3) Main theme style.css
	 */
	wp_enqueue_style(
		'cor-domi-style',
		get_stylesheet_uri(),
		array( 'cor-domi-custom' ),
		_S_VERSION
	);
	wp_style_add_data( 'cor-domi-style', 'rtl', 'replace' );

	wp_enqueue_style(
	'slick-css',
	'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css',
	[],
	null
);

wp_enqueue_script(
	'slick-js',
	'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js',
	['jquery'],
	null,
	true
);

	/**
	 * 4) Swiper CSS
	 */
	wp_enqueue_style(
		'swiper-css',
		'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
		array(),
		'11.0.0'
	);

	/**
	 * 5) Navigation
	 */
	wp_enqueue_script(
		'cor-domi-navigation',
		get_template_directory_uri() . '/js/navigation.js',
		array(),
		_S_VERSION,
		true
	);

	/**
	 * 6) Swiper JS
	 */
	wp_enqueue_script(
		'swiper-js',
		'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
		array(),
		'11.0.0',
		true
	);

	/**
	 * 7) Swiper init
	 *    /assets/js/swiper-init.js
	 */
	$swiper_init_rel  = '/assets/js/swiper-init.js';
	$swiper_init_path = get_template_directory() . $swiper_init_rel;
	$swiper_init_uri  = get_template_directory_uri() . $swiper_init_rel;

	wp_enqueue_script(
		'cor-domi-swiper-init',
		$swiper_init_uri,
		array( 'swiper-js' ),
		file_exists( $swiper_init_path ) ? filemtime( $swiper_init_path ) : _S_VERSION,
		true
	);

	/**
	 * 8) AOS CSS
	 */
	wp_enqueue_style(
		'aos-css',
		'https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css',
		array(),
		'2.3.4'
	);

	/**
	 * 9) AOS JS
	 */
	wp_enqueue_script(
		'aos-js',
		'https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js',
		array(),
		'2.3.4',
		true
	);

	/**
	 * 10) AOS init
	 */
	wp_add_inline_script(
		'aos-js',
		"document.addEventListener('DOMContentLoaded', function () {
			if (typeof AOS !== 'undefined') {
				AOS.init({
					once: true,
					duration: 600,
					easing: 'ease-out',
					offset: 200
				});
			}
		});"
	);

	/**
	 * 11) Main JS
	 *     /assets/js/main.js
	 */
	$main_js_rel  = '/assets/js/main.js';
	$main_js_path = get_template_directory() . $main_js_rel;
	$main_js_uri  = get_template_directory_uri() . $main_js_rel;

	wp_enqueue_script(
		'cor-domi-main',
		$main_js_uri,
		array( 'swiper-js', 'aos-js' ),
		file_exists( $main_js_path ) ? filemtime( $main_js_path ) : _S_VERSION,
		true
	);

	/**
	 * 12) Comments
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'cor_domi_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * =========================
 * ACF JSON sync
 * =========================
 */
add_filter( 'acf/settings/save_json', function () {
	return get_stylesheet_directory() . '/acf-json';
} );

add_filter( 'acf/settings/load_json', function ( $paths ) {
	$paths[] = get_stylesheet_directory() . '/acf-json';
	return $paths;
} );

if ( function_exists('acf_add_options_page') ) {
	acf_add_options_page([
		'page_title' => 'Theme Settings',
		'menu_title' => 'Theme Settings',
		'menu_slug'  => 'theme-settings',
		'redirect'   => false,
	]);

	acf_add_options_sub_page([
		'page_title'  => 'Header',
		'menu_title'  => 'Header',
		'parent_slug' => 'theme-settings',
		'post_id'     => 'header_options',
	]);

	acf_add_options_sub_page([
		'page_title'  => 'Footer',
		'menu_title'  => 'Footer',
		'parent_slug' => 'theme-settings',
		'post_id'     => 'footer_options',
	]);
}

/**
 * =========================
 * SVG upload support (admin only)
 * =========================
 */
add_filter( 'upload_mimes', function ( $mimes ) {
	if ( current_user_can( 'administrator' ) ) {
		$mimes['svg']  = 'image/svg+xml';
		$mimes['svgz'] = 'image/svg+xml';
	}
	return $mimes;
} );

add_filter( 'wp_check_filetype_and_ext', function ( $data, $file, $filename, $mimes, $real_mime = null ) {
	$ext = strtolower( pathinfo( $filename, PATHINFO_EXTENSION ) );
	if ( in_array( $ext, array( 'svg', 'svgz' ), true ) ) {
		$data['ext']             = 'svg';
		$data['type']            = 'image/svg+xml';
		$data['proper_filename'] = $filename;
	}
	return $data;
}, 10, 5 );


add_action('init', function () {

  // Projects
  register_post_type('project', [
    'label'           => 'Projects',
    'labels'          => [
      'name'               => 'Projects',
      'singular_name'      => 'Project',
      'add_new'            => 'Add Project',
      'add_new_item'       => 'Add Project',
      'edit_item'          => 'Edit Project',
      'new_item'           => 'New Project',
      'view_item'          => 'View Project',
      'search_items'       => 'Search Projects',
      'not_found'          => 'No projects found',
      'not_found_in_trash' => 'No projects in trash',
      'all_items'          => 'All Projects',
    ],
    'public'          => true,
    'has_archive'     => true,
    'rewrite'         => ['slug' => 'projects'],
    'show_in_rest'    => true,
    'menu_icon'       => 'dashicons-building',
    'supports'        => ['title', 'editor', 'thumbnail', 'excerpt', 'revisions'],
    'taxonomies'      => ['category', 'post_tag'],
  ]);

  // Press
  register_post_type('press', [
    'label'           => 'Press',
    'labels'          => [
      'name'               => 'Press',
      'singular_name'      => 'Article',
      'add_new'            => 'Add Article',
      'add_new_item'       => 'Add Article',
      'edit_item'          => 'Edit Article',
      'new_item'           => 'New Article',
      'view_item'          => 'View Article',
      'search_items'       => 'Search Press',
      'not_found'          => 'No articles found',
      'not_found_in_trash' => 'No articles in trash',
      'all_items'          => 'All Press',
    ],
    'public'          => true,
    'has_archive'     => true,
    'rewrite'         => ['slug' => 'press'],
    'show_in_rest'    => true,
    'menu_icon'       => 'dashicons-media-document',
    'supports'        => ['title', 'editor', 'thumbnail', 'excerpt', 'revisions'],
    'taxonomies'      => ['category', 'post_tag'],
  ]);

});

add_filter('big_image_size_threshold', '__return_false');