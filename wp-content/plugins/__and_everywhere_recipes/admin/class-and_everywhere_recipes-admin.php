<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://192.168.0.28
 * @since      1.0.0
 *
 * @package    And_everywhere_recipes
 * @subpackage And_everywhere_recipes/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    And_everywhere_recipes
 * @subpackage And_everywhere_recipes/admin
 * @author     Ronak <ronak.lodhari@iflair.com>
 */
class And_everywhere_recipes_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		add_action( 'init',  array($this, 'init') );

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in And_everywhere_recipes_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The And_everywhere_recipes_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/and_everywhere_recipes-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in And_everywhere_recipes_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The And_everywhere_recipes_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/and_everywhere_recipes-admin.js', array( 'jquery' ), $this->version, false );

	}
	public function init()
	{
		/**
		* By default call this function in admin side
		*/

		add_action('admin_menu' , array($this , 'recipes_plugin_setup_menu'));

	}
	public function recipes_plugin_setup_menu()
	{
		add_menu_page(
            __('And Everywhere Recipes', 'Recipes_Admin'),
            __('And Everywhere Recipes', 'Recipes_Admin'),
            'manage_options',
            'And Everywhere Recipes',
            array($this, 'Recipes_Admin'),
          	'dashicons-beer'  	
        );
        add_submenu_page(
            'And Everywhere Recipes',
            __('Recipe Categories', 'Recipe_Categories'),
            __('Recipe Categories', 'Recipe_Categories'),
            'manage_options',
            'Recipe Categories',
            array($this, 'Recipe_Categories'),
        );

	}
	// Callback the function recipe
	public function Recipes_Admin()
	{
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/main-form.php';
	}
	
	public function Recipe_Categories_taxonomies()
	{
		register_taxonomy('recipe', 'andeverywhererecipes', array(
	      'hierarchical' => true,
		  'labels' => array(
	      'name' => _x( 'Recipe', 'taxonomy general name' ),
	      'singular_name' => _x( 'Recipe', 'taxonomy singular name' ),
	      'search_items' =>  __( 'Search Recipe' ),
	      'all_items' => __( 'All Recipe' ),
	      'parent_item' => __( 'Parent Recipe' ),
	      'parent_item_colon' => __( 'Parent Recipe:' ),
	      'edit_item' => __( 'Edit Recipe' ),
	      'update_item' => __( 'Update Recipe' ),
	      'add_new_item' => __( 'Add New Recipe' ),
	      'new_item_name' => __( 'New Recipe Name' ),
	      'menu_name' => __( 'Recipe' ),
    		),
	    	'rewrite' => array(
	      	'slug' => 'recipe',
	      	'with_front' => false, 
	      	'hierarchical' => true 
    		),
  		));
	}
	public function my_custom_post_product() {
	  $labels = array(
	    'name'               => _x( 'And Everywhere Recipes', 'post type general name' ),
	    'singular_name'      => _x( 'And Everywhere Recipes', 'post type singular name' ),
	    'add_new'            => _x( 'Add New', 'book' ),
	    'add_new_item'       => __( 'Add New And Everywhere Recipes' ),
	    'edit_item'          => __( 'Edit And Everywhere Recipes' ),
	    'new_item'           => __( 'New And Everywhere Recipes' ),
	    'all_items'          => __( 'All And Everywhere Recipes' ),
	    'view_item'          => __( 'View And Everywhere Recipes' ),
	    'search_items'       => __( 'Search And Everywhere Recipes' ),
	    'not_found'          => __( 'No products found' ),
	    'not_found_in_trash' => __( 'No products found in the Trash' ), 
	    'menu_name'          => 'And Everywhere Recipes'
	  );
	  $args = array(
	    'labels'        => $labels,
	    'description'   => 'Holds our products and product specific data',
	    'public'        => true,
	    'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
	    'has_archive'   => true,
	  );
	  register_post_type( 'And Everywhere Recipes', $args ); 
	}
	public function add_custom_field_automatically($post_ID) {

		if(!wp_is_post_revision($post_ID)) {
			add_post_meta($post_ID, 'meta_field', '55',true);
		}
	}
}
