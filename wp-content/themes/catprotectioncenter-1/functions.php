<?php
/**
 * catprotectioncenter-1 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package catprotectioncenter-1
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function catprotectioncenter_1_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on catprotectioncenter-1, use a find and replace
		* to change 'catprotectioncenter-1' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'catprotectioncenter-1', get_template_directory() . '/languages' );

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

 		add_image_size( 'post-thumbnail size', 800, 350 );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'catprotectioncenter-1' ),
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
			'catprotectioncenter_1_custom_background_args',
			array(
				'default-color' => 'ffffff',
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
add_action( 'after_setup_theme', 'catprotectioncenter_1_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function catprotectioncenter_1_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'catprotectioncenter_1_content_width', 640 );
}
add_action( 'after_setup_theme', 'catprotectioncenter_1_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function catprotectioncenter_1_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'catprotectioncenter-1' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'catprotectioncenter-1' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'catprotectioncenter_1_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function catprotectioncenter_1_scripts() {
	wp_enqueue_style( 'catprotectioncenter-1-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'catprotectioncenter-1-style', 'rtl', 'replace' );

	wp_enqueue_script( 'catprotectioncenter-1-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'catprotectioncenter_1_scripts' );

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


// Add the custom menu


function register_html5_menu(){
     register_nav_menus(array( 
         'footer-1' => __('Footer Menu 1', 'theme_translation_domain'),
     ));
}

add_action('init', 'register_html5_menu');

// Add Css and js
function enqueue_my_styles() {
    wp_enqueue_style( 'style', get_stylesheet_directory_uri() . "/css/custom.css");
    wp_enqueue_style( 'font-awesome', get_stylesheet_directory_uri() . "/css/font-awesome.css");
    wp_enqueue_style( 'slick', get_stylesheet_directory_uri() . "/css/slick.css");
    wp_enqueue_style( 'slick-theme', get_stylesheet_directory_uri() . "/css/slick-theme.css");


    
    wp_enqueue_script('jquery-3', get_template_directory_uri() . '/js/jquery-3.js');
    wp_enqueue_script('slick-min', get_template_directory_uri() . '/js/slick-min.js');
    wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.js');
    wp_localize_script( 'custom', 'ajax_posts', array(
    'ajaxurl' => admin_url( 'admin-ajax.php' ),
    'redirecturl' => home_url()));

    /* Vue Js */
    wp_enqueue_script('vue-js', get_template_directory_uri() . '/js/vue.js');
    wp_enqueue_script('vue-resource-js', get_template_directory_uri() . '/js/vue-resource.js');
    wp_enqueue_script('vue-router-js', get_template_directory_uri() . '/js/vue-router.js');
    wp_enqueue_script('app-js', get_template_directory_uri() . '/js/app.js');

    
}
add_action( 'wp_enqueue_scripts', 'enqueue_my_styles' );

// ACF option page
if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page();
	
}

// Add the custom Post type 
function my_custom_post_Testimonial() {
  $labels = array(
    'name'               => _x( 'Testimonials', 'post type general name' ),
    'singular_name'      => _x( 'Testimonial', 'post type singular name' ),
    'add_new'            => _x( 'Add New', 'book' ),
    'add_new_item'       => __( 'Add New Testimonial'),
    'edit_item'          => __( 'Edit Testimonial' ),
    'new_item'           => __( 'New Testimonial' ),
    'all_items'          => __( 'All Testimonials' ),
    'view_item'          => __( 'View Testimonial' ),
    'search_items'       => __( 'Search Testimonials' ),
    'not_found'          => __( 'No Testimonials found' ),
    'not_found_in_trash' => __( 'No Testimonials found in the Trash' ), 
    'menu_name'          => 'Testimonial'
  );
  $args = array(
    'labels'        => $labels,
    'description'   => 'Holds our Testimonials and Testimonial specific data',
    'public'        => true,
    'menu_position' => 5,
    'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
    'has_archive'   => true,
    'show_in_rest'       => true,
  );
  register_post_type( 'testimonial', $args ); 
}
add_action( 'init', 'my_custom_post_Testimonial');

//create a custom taxonomy name it subjects for your posts
  
function create_subjects_hierarchical_taxonomy() {
  $labels = array(
    'name'              => _x( 'Subjects', 'taxonomy general name' ),
    'singular_name'     => _x( 'Subject', 'taxonomy singular name' ),
    'id'				=> __('subjects_1'),
    'search_items'      => __( 'Search Subjects' ),
    'add_new'            => _x( 'Add New', 'book' ),
    'all_items'         => __( 'All Subjects' ),
    'parent_item'       => __( 'Parent Subject' ),
    'parent_item_colon' => __( 'Parent Subject:' ),
    'edit_item'    		=> __( 'Edit Subject' ), 
    'update_item' 		=> __( 'Update Subject' ),
    'add_new_item' 		=> __( 'Add New Subject' ),
    'new_item_name' 	=> __( 'New Subject Name' ),
    'menu_name' 		=>  'Subjects',
  );    

// Now register the taxonomy
  register_taxonomy('subjects',array('testimonial'), 
  	array(
    'hierarchical' 		=> true,
    'labels' 			=> $labels,
    'show_ui' 			=> true,
    'show_in_rest' 		=> true,
    'show_admin_column' => true,
    'query_var' 		=> true,
    'supports'      	=> array( 'title', 'editor', 'thumbnail', 'excerpt' ),
    'rewrite' 			=> array( 'slug' => 'subject' ),
    'has_archive'   	=> true
  ));
}
add_action( 'init', 'create_subjects_hierarchical_taxonomy', 0 );


function add_custom_taxonomies() {
  // Add new "Locations" taxonomy to Posts
  register_taxonomy('location', 'recipes', array(
    // Hierarchical taxonomy (like categories)
    'hierarchical' => true,
    // This array of options controls the labels displayed in the WordPress Admin UI
    'labels' => array(
      'name' => _x( 'Locations', 'taxonomy general name' ),
      'singular_name' => _x( 'Location', 'taxonomy singular name' ),
      'search_items' =>  __( 'Search Locations' ),
      'all_items' => __( 'All Locations' ),
      'parent_item' => __( 'Parent Location' ),
      'parent_item_colon' => __( 'Parent Location:' ),
      'edit_item' => __( 'Edit Location' ),
      'update_item' => __( 'Update Location' ),
      'add_new_item' => __( 'Add New Location' ),
      'new_item_name' => __( 'New Location Name' ),
      'menu_name' => __( 'Locations' ),
    ),
    // Control the slugs used for this taxonomy
    'rewrite' => array(
      'slug' => 'locations', // This controls the base slug that will display before each term
      'with_front' => false, // Don't display the category base before "/locations/"
      'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
    ),
  ));
}
add_action( 'init', 'add_custom_taxonomies', 0 );

function pagebuilder($builder = 'page_builder', $option = false) {

	
	if (true === $option) {
	  if( have_rows($builder, 'option') ) : 
		while ( have_rows($builder, 'option') ) : the_row();
		  get_template_part('modules/'.get_row_layout());
		endwhile;
	  endif;
	} else {
	  if( have_rows($builder) ) : 
		while ( have_rows($builder) ) : the_row();
		  get_template_part('modules/'.get_row_layout());
		endwhile;
	  endif;
	}
}


add_action( 'wp_ajax_user_add_form', 'user_add_form' );
add_action( 'wp_ajax_nopriv_user_add_form', 'user_add_form' );
function user_add_form() {

    $target = ABSPATH.'wp-content/uploads/' . basename($_FILES['file-upload']['name']);
        if($fileupl = move_uploaded_file($_FILES['file-upload']['tmp_name'], $target)) {
            $fp = fopen($target, "r");
        }
    $fname  = ($_POST["vb_firstname"]);
    $lname  = ($_POST["vb_lastname"]);
    $email  = ($_POST["vb_email"]);
    $phn    = ($_POST["vb_phone"]);
    // $file_upld = ($_FILES["file-upload"]["name"]);
    global $wpdb;

    $table_name = $wpdb->prefix . "wp_user_data";
    $insert_row = $wpdb->insert( 
        'wp_user_data',
            array( 
            'firstname' => $fname, 
            'lastname' => $lname, 
            'email' => $email, 
            'phone' => $phn,
            'profilepicture'=> $_FILES['file-upload']['name'],
        )
    );
    
    // if row inserted in table
    if($insert_row){
        $msg = json_encode(array('res'=>true, 'message'=>__('New row has been inserted.')));
    }else{
        $msg = json_encode(array('res'=>false, 'message'=>__('Something went wrong. Please try again later.')));
    }
    echo $msg;
   wp_die();
}



add_action( 'rest_api_init', 'wp_api_add_posts_endpoints' );
function wp_api_add_posts_endpoints() {
  register_rest_route( 'addPost', '/v2', array(
        'methods' => 'POST',
        'callback' => 'addPosts_callback',
    ));
}
function addPosts_callback( $request_data ) {
  global $wpdb;
  $data = array();
  $table        = 'wp_posts';

  // Fetching values from API
  $parameters = $request_data->get_params();
  $user_id = $parameters['user_id'];
  $post_type = $parameters['post_type'];
  $post_title = $parameters['post_title'];
  $the_content = $parameters['the_content'];
  $cats = $parameters['cats'];
  $the_excerpt = $parameters['the_excerpt'];
  $feature_img = $parameters['featured_image'];

  // custom meta values
  $contact_no = $parameters['contact_no'];
  $email = $parameters['email'];
  $hotel_url = $parameters['hotel_url'];


  if($post_type!='' && $post_title!=''){

      // Create post object
      $my_post = array(
        'post_title' => wp_strip_all_tags( $post_title),
        'post_content' => $the_content,
        'post_author' => '',
        'post_excerpt' => $the_excerpt,
        'post_status' => 'publish',
        'post_type' => $post_type,
      );
      $new_post_id = wp_insert_post( $my_post );


      function wp_api_encode_acf($data,$post,$context){
          $customMeta = (array) get_fields($post['ID']);

           $data['meta'] = array_merge($data['meta'], $customMeta );
          return $data;
      }

      if( function_exists('get_fields') ){
          add_filter('json_prepare_post', 'wp_api_encode_acf', 10, 3);
      }


      // Set post categories
      $catss = explode(',', $cats);
      if (!empty($catss)) {
        if ($post_type == 'post') {
          wp_set_object_terms( $new_post_id, $catss, 'category', false );
        }
        else{
          wp_set_object_terms( $new_post_id, $catss, 'Categories', false );   // Executes if posttype is other
        }
      }

      // Set Custom Metabox
      if ($post_type != 'post') {
        update_post_meta($new_post_id, 'contact-no', $contact_no);
        update_post_meta($new_post_id, 'email', $email);
        update_post_meta($new_post_id, 'hotel-url', $hotel_url);
      }

      // Set featured Image
      $url = $feature_img;
      $path = parse_url($url, PHP_URL_PATH);
      $filename = basename($path);

      $uploaddir = wp_upload_dir();
      $uploadfile = $uploaddir['path'] . '/' . $filename;

      $contents= file_get_contents($feature_img);
      $savefile = fopen($uploadfile, 'w');
      chmod($uploadfile, 0777);
      fwrite($savefile, $contents);
      fclose($savefile);

      $wp_filetype = wp_check_filetype(basename($filename), null );

      $attachment = array(
          'post_mime_type' => $wp_filetype['type'],
          'post_title' => $filename,
          'post_content' => '',
          'post_status' => 'inherit'
      );

      $attach_id = wp_insert_attachment( $attachment, $uploadfile );

      if ($attach_id) {
        set_post_thumbnail( $new_post_id, $attach_id );
      }

      if ($new_post_id) {
          $data['status']='Post added Successfully.';  
      }
      else{
        $data['status']='post failed..';
      }

  }else{
      $data['status']=' Please provide correct post details.';
  }

  return ($data);
}

if( function_exists( 'ctdb_breadcrumb_navigation' ) ) {
 remove_action( 'ctdb_do_breadcrumb', 'ctdb_breadcrumb_navigation' );
 add_action( 'ctdb_child_do_breadcrumb', 'ctdb_breadcrumb_navigation' );
}

add_filter( 'auto_update_theme', '__return_false' );
add_filter( 'auto_update_plugin', '__return_false' );


add_action( 'admin_init', 'mathiregister_allow_uploads' );

function mathiregister_allow_uploads() {
    $contributor = get_role( 'contributor' );
    $contributor->add_cap('upload_files');
}

add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {

  global $wp_version;
  if ( $wp_version !== '4.7.1' ) {
     return $data;
  }

  $filetype = wp_check_filetype( $filename, $mimes );

  return [
      'ext'             => $filetype['ext'],
      'type'            => $filetype['type'],
      'proper_filename' => $data['proper_filename']
  ];

}, 10, 4 );

function cc_mime_types( $mimes ){
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );

function fix_svg() {
  echo '<style type="text/css">
        .attachment-266x266, .thumbnail img {
             width: 100% !important;
             height: auto !important;
        }
        </style>';
}
add_action( 'admin_head', 'fix_svg' );