<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'fea_instance' ) ) {
	function fea_instance() {
		global $fea_instance;

		if ( ! isset( $fea_instance ) ) {
			$fea_instance = new stdClass();
		}

		return $fea_instance;
	}
}

function feadmin_form_types() {
	 $form_types = array(
		 'general'                                 => __( 'Frontend Form', 'acf-frontend-form-element' ),
		 __( 'Post', 'acf-frontend-form-element' ) => array(
			 'new_post'       => __( 'New Post Form', 'acf-frontend-form-element' ),
			 'edit_post'      => __( 'Edit Post Form', 'acf-frontend-form-element' ),
			 'duplicate_post' => __( 'Duplicate Post Form', 'acf-frontend-form-element' ),
			 'delete_post'    => __( 'Delete Post Button', 'acf-frontend-form-element' ),
			 'status_post'    => __( 'Post Status Button', 'acf-frontend-form-element' ),
		 ),
		 __( 'User', 'acf-frontend-form-element' ) => array(
			 'new_user'    => __( 'New User Form', 'acf-frontend-form-element' ),
			 'edit_user'   => __( 'Edit User Form', 'acf-frontend-form-element' ),
			 'delete_user' => __( 'Delete User Button', 'acf-frontend-form-element' ),
		 ),
		 __( 'Term', 'acf-frontend-form-element' ) => array(
			 'new_term'    => __( 'New Term Form', 'acf-frontend-form-element' ),
			 'edit_term'   => __( 'Edit Term Form', 'acf-frontend-form-element' ),
			 'delete_term' => __( 'Delete Term Button', 'acf-frontend-form-element' ),
		 ),
	 );
	 $form_types = apply_filters( 'frontend_admin/forms/form_types', $form_types );

	 return $form_types;
}

function feadmin_user_exists( $id ) {
	global $wpdb;

	$count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) FROM $wpdb->users WHERE ID = %d", $id ) );

	if ( $count == 1 ) {
		return true;
	}

	return false;

}

function feadmin_get_field_data( $type = null, $form_fields = false ) {
	 $field_types = array();
	if ( ! $form_fields ) {
		$GLOBALS['only_acf_field_groups'] = 1;
	}
	$acf_field_groups                 = acf_get_field_groups();
	$GLOBALS['only_acf_field_groups'] = 0;
	// bail early if no field groups
	if ( empty( $acf_field_groups ) ) {
		die();
	}
	// loop through array and add to field 'choices'
	if ( $acf_field_groups ) {
		foreach ( $acf_field_groups as $field_group ) {
			if ( ! empty( $field_group['frontend_admin_group'] ) ) {
				continue;
			}
			$field_group_fields = acf_get_fields( $field_group['key'] );
			if ( is_array( $field_group_fields ) ) {
				foreach ( $field_group_fields as $acf_field ) {
					if ( $type ) {
						if ( ( is_array( $type ) && in_array( $acf_field['type'], $type, true ) ) || ( ! is_array( $type ) && $acf_field['type'] == $type ) ) {
							$field_types[ $acf_field['key'] ] = $acf_field['label'];
						}
					} else {
						$field_types[ $acf_field['key'] ]['type']  = $acf_field['type'];
						$field_types[ $acf_field['key'] ]['label'] = $acf_field['label'];
						$field_types[ $acf_field['key'] ]['name']  = $acf_field['name'];
					}
				}
			}
		}
	}
	return $field_types;
}

function feadmin_user_id_fields() {
	 $fields = feadmin_get_acf_field_choices( array( 'type' => 'user' ) );
	$keys    = array_merge( array( '[author]' => __( 'Post Author', 'acf-frontend-form-element' ) ), $fields );
	return $keys;
}

function feadmin_get_user_roles( $exceptions = array(), $all = false ) {
	if ( ! current_user_can( 'administrator' ) ) {
		$exceptions[] = 'administrator';
	}

	$user_roles = array();

	if ( $all ) {
		$user_roles['all'] = __( 'All', 'acf-frontend-form-element' );
	}
	global $wp_roles;
	// loop through array and add to field 'choices'
	foreach ( $wp_roles->roles as $role => $settings ) {
		if ( ! in_array( strtolower( $role ), $exceptions ) ) {
			$user_roles[ $role ] = $settings['name'];
		}
	}
	return $user_roles;
}
function feadmin_get_user_caps( $exceptions = array(), $all = false ) {
	 $user_caps = array();

	$data = get_userdata( get_current_user_id() );

	if ( is_object( $data ) ) {
		$current_user_caps = $data->allcaps;
		foreach ( $current_user_caps as $cap => $true ) {
			if ( ! in_array( strtolower( $cap ), $exceptions ) ) {
				$user_caps[ $cap ] = $cap;
			}
		}
	}

	return $user_caps;
}

function feadmin_get_acf_group_choices() {
	$field_group_choices = array();
	$acf_field_groups    = acf_get_field_groups();
	// loop through array and add to field 'choices'
	if ( is_array( $acf_field_groups ) ) {
		foreach ( $acf_field_groups as $field_group ) {
			if ( is_array( $field_group ) && ! isset( $field_group['frontend_admin_group'] ) ) {
				$field_group_choices[ $field_group['key'] ] = $field_group['title'];
			}
		}
	}
	return $field_group_choices;
}

/*
 add_filter('acf/get_fields', function( $fields, $parent ){
	$group = explode( 'acfef_', $parent['key'] );

	if( empty( $group[1] ) ) return $fields;

	return array();
}, 5, 2);
 */

function feadmin_get_acf_field_choices( $filter = array(), $return = 'label' ) {
	$all_fields = array();
	if ( isset( $filter['groups'] ) ) {
		$acf_field_groups = $filter['groups'];
	} else {
		$acf_field_groups = acf_get_field_groups( $filter );
	}

	// bail early if no field groups
	if ( empty( $acf_field_groups ) ) {
		return array();
	}

	foreach ( $acf_field_groups as $group ) {
		if ( ! is_array( $group ) ) {
			$group = acf_get_field_group( $group );
		}
		if ( ! empty( $field_group['frontend_admin_group'] ) ) {
			continue;
		}

		$group_fields = acf_get_fields( $group );

		if ( is_array( $group_fields ) ) {
			foreach ( $group_fields as $acf_field ) {
				if ( ! is_array( $acf_field ) ) {
					continue;
				}

				$acf_field_key = $acf_field['type'] == 'clone' ? $acf_field['__key'] : $acf_field['key'];
				if ( ! empty( $filter['type'] ) && $filter['type'] == $acf_field['type'] ) {
					$all_fields[ $acf_field['name'] ] = $acf_field[ $return ];
				} else {
					if ( isset( $filter['groups'] ) ) {
						$all_fields[ $acf_field_key ] = $acf_field[ $return ];
					} else {
						$all_fields[ $acf_field_key ] = $acf_field[ $return ];
					}
				}
			}
		}
	}

	return $all_fields;
}

function feadmin_get_post_type_choices() {
	$post_type_choices = array();
	$args              = array();
	$output            = 'names'; // names or objects, note names is the default
	$operator          = 'and'; // 'and' or 'or'
	$post_types        = get_post_types( $args, $output, $operator );
	// loop through array and add to field 'choices'
	if ( is_array( $post_types ) ) {
		foreach ( $post_types as $post_type ) {
			$post_type_choices[ $post_type ] = str_replace( '_', ' ', ucfirst( $post_type ) );
		}
	}
	return $post_type_choices;
}

function feadmin_get_random_string( $length = 15 ) {
	$characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$charactersLength = strlen( $characters );
	$randomString     = '';
	for ( $i = 0; $i < $length; $i++ ) {
		$randomString .= $characters[ rand( 0, $charactersLength - 1 ) ];
	}
	return $randomString;
}


function feadmin_get_client_ip() {
	$server_ip_keys = array(
		'HTTP_CLIENT_IP',
		'HTTP_X_FORWARDED_FOR',
		'HTTP_X_FORWARDED',
		'HTTP_X_CLUSTER_CLIENT_IP',
		'HTTP_FORWARDED_FOR',
		'HTTP_FORWARDED',
		'REMOTE_ADDR',
	);

	foreach ( $server_ip_keys as $key ) {
		if ( isset( $_SERVER[ $key ] ) && filter_var( $_SERVER[ $key ], FILTER_VALIDATE_IP ) ) {
			return esc_html( $_SERVER[ $key ] );
		}
	}

	// Fallback local ip.
	return '127.0.0.1';
}

function feadmin_get_site_domain() {
	return str_ireplace( 'www.', '', parse_url( home_url(), PHP_URL_HOST ) );
}



function feadmin_duplicate_slug( $prefix = '' ) {
	static $i;
	if ( null === $i ) {
		$i = 2;
	} else {
		$i ++;
	}
	$new_slug = sprintf( '%s_copy%s', $prefix, $i );
	if ( ! feadmin_slug_exists( $new_slug ) ) {
		return $new_slug;
	} else {
		return feadmin_duplicate_slug( $prefix );
	}
}

function feadmin_slug_exists( $post_name ) {
	global $wpdb;
	if ( $wpdb->get_row( "SELECT post_name FROM $wpdb->posts WHERE post_name = '$post_name'", 'ARRAY_A' ) ) {
		return true;
	} else {
		return false;
	}
}

function feadmin_sanitize_input ( $data = false ) {
	if( ! $data ) return $data;
	if( is_array( $data ) ){
		return feadmin_sanitize_array( $data );
	}else{
		return wp_kses_post( $data );
	}
}
function feadmin_sanitize_array ($data = array()) {
		if (!is_array($data) || !count($data)) {
		return array();
	}

	foreach ($data as $k => $v) {
		if (!is_array($v) && !is_object($v)) {
			$v = str_replace( [ '<[', ']>' ], [ '{-', '-}' ], $v ); 
			$v = wp_kses_post($v);
			$v = str_replace( [ '{-', '-}' ], [ '<[', ']>' ], $v ); 
			$data[$k] = $v;
		}
		if (is_array($v)) {
			$data[$k] = feadmin_sanitize_array($v);
		}
	}

	return $data;
}

function feadmin_parse_args( $args, $defaults ) {
	$new_args = (array) $defaults;

	if ( ! is_array( $args ) ) {
		return $defaults;
	}
	foreach ( $args as $key => $value ) {
		if ( is_array( $value ) && isset( $new_args[ $key ] ) ) {
			$new_args[ $key ] = feadmin_parse_args( $value, $new_args[ $key ] );
		} else {
			$new_args[ $key ] = $value;
		}
	}

	return $new_args;
}

function feadmin_edit_mode() {
	$edit_mode = false;

	if ( ! empty( fea_instance()->elementor ) ) {
		$edit_mode = \Elementor\Plugin::$instance->editor->is_edit_mode();
	}

	if ( ! empty( $GLOBALS['admin_form']['preview_mode'] ) ) {
		$edit_mode = true;
	}
    
    $current_screen = get_current_screen();
    if ( $current_screen instanceof WP_Screen && ! empty( $current_screen->is_block_editor ) ) {
        $edit_mode = true;
    }

	return $edit_mode;
}

function feadmin_get_product_object() {
	if ( isset( $GLOBALS['admin_form']['save_to_product'] ) ) {
		$form = $GLOBALS['admin_form'];

		if ( $form['save_to_product'] == 'edit_product' ) {
			return wc_get_product( $form['product_id'] );
		}
	}
	return false;
}

function feadmin_get_field_type_groups( $type = 'all' ) {
	$fields = array();
	if ( $type == 'all' ) {
		$fields['acf']    = array(
			'label'   => __( 'ACF Field', 'acf-frontend-form-element' ),
			'options' => array(
				'ACF_fields'       => __( 'ACF Fields', 'acf-frontend-form-element' ),
				'ACF_field_groups' => __( 'ACF Field Groups', 'acf-frontend-form-element' ),
			),
		);
		$fields['layout'] = array(
			'label'   => __( 'Layout', 'acf-frontend-form-element' ),
			'options' => array(
				'message' => __( 'Message', 'acf-frontend-form-element' ),
				'column'  => __( 'Column', 'acf-frontend-form-element' ),
			// 'tab'  => __( 'Tab', 'acf-frontend-form-element' ),
			),
		);
	}
	if ( $type == 'all' || $type == 'post' ) {
		$fields['post'] = array(
			'label'   => __( 'Post' ),
			'options' => array(
				'title'          => __( 'Post Title', 'acf-frontend-form-element' ),
				'slug'           => __( 'Slug', 'acf-frontend-form-element' ),
				'content'        => __( 'Post Content', 'acf-frontend-form-element' ),
				'featured_image' => __( 'Featured Image', 'acf-frontend-form-element' ),
				'excerpt'        => __( 'Post Excerpt', 'acf-frontend-form-element' ),
				'categories'     => __( 'Categories', 'acf-frontend-form-element' ),
				'tags'           => __( 'Tags', 'acf-frontend-form-element' ),
				'author'         => __( 'Post Author', 'acf-frontend-form-element' ),
				'published_on'   => __( 'Published On', 'acf-frontend-form-element' ),
				'post_type'      => __( 'Post Type', 'acf-frontend-form-element' ),
				'menu_order'     => __( 'Menu Order', 'acf-frontend-form-element' ),
				'allow_comments' => __( 'Allow Comments', 'acf-frontend-form-element' ),
				'taxonomy'       => __( 'Custom Taxonomy', 'acf-frontend-form-element' ),
			),
		);
	}
	if ( $type == 'all' || $type == 'user' ) {
		$fields['user'] = array(
			'label'   => __( 'User', 'acf-frontend-form-element' ),
			'options' => array(
				'username'         => __( 'Username', 'acf-frontend-form-element' ),
				'password'         => __( 'Password', 'acf-frontend-form-element' ),
				'confirm_password' => __( 'Confirm Password', 'acf-frontend-form-element' ),
				'email'            => __( 'Email', 'acf-frontend-form-element' ),
				'first_name'       => __( 'First Name', 'acf-frontend-form-element' ),
				'last_name'        => __( 'Last Name', 'acf-frontend-form-element' ),
				'nickname'         => __( 'Nickname', 'acf-frontend-form-element' ),
				'display_name'     => __( 'Display Name', 'acf-frontend-form-element' ),
				'bio'              => __( 'Biography', 'acf-frontend-form-element' ),
				'role'             => __( 'Role', 'acf-frontend-form-element' ),
			),
		);
	}
	if ( $type == 'all' || $type == 'term' ) {

		$fields['term'] = array(
			'label'   => __( 'Term', 'acf-frontend-form-element' ),
			'options' => array(
				'term_name'        => __( 'Term Name', 'acf-frontend-form-element' ),
				'term_slug'        => __( 'Term Slug', 'acf-frontend-form-element' ),
				'term_description' => __( 'Term Description', 'acf-frontend-form-element' ),
			),
		);
	}

	$fields = apply_filters( 'frontend_admin/form/elementor/field_select_options', $fields, $type );

	return $fields;
}


/*
*  get_selected_field
*
*  This function will return the label for a given clone choice
*
*  @type    function
*  @date    17/06/2016
*  @since   5.3.8
*
*  @param   $selector (mixed)
*  @return  (string)
*/

function feadmin_get_selected_field( $selector = '', $type = '' ) {
	// bail early no selector
	if ( ! $selector ) {
		return '';
	}

	if ( is_numeric( $selector ) ) {
		return get_post_field( 'post_title', $selector );
	}
	// ajax_fields
	if ( isset( $_POST['fields'][ $selector ] ) ) {
		$selector = sanitize_text_field( $_POST['fields'][ $selector ] );
		return feadmin_field_choice( $selector );

	}

	// field
	if ( acf_is_field_key( $selector ) ) {

		return feadmin_field_choice( acf_get_field( $selector ) );

	}

	// group
	if ( acf_is_field_group_key( $selector ) ) {

		return feadmin_group_choice( acf_get_field_group( $selector ) );

	}
	if ( feadmin_is_admin_form_key( $selector ) ) {

		return feadmin_group_choice( fea_instance()->form_display->get_form( $selector ) );

	}

	// return
	return $selector;

}
/*
*  feadmin_field_choice
*
*  This function will return the text for a field choice
*
*  @type    function
*  @date    20/07/2016
*  @since   5.4.0
*
*  @param   $field (array)
*  @return  (string)
*/

function feadmin_field_choice( $field ) {
	// bail early if no field
	if ( ! $field ) {
		return __( 'Unknown field', 'acf' );
	}

	// title
	$title = $field['label'] ? $field['label'] : __( '(no title)', 'acf' );

	// append type
	$title .= ' (' . $field['type'] . ')';

	// ancestors
	// - allow for AJAX to send through ancestors count
	$ancestors = isset( $field['ancestors'] ) ? $field['ancestors'] : count( acf_get_field_ancestors( $field ) );
	$title     = str_repeat( '- ', $ancestors ) . $title;

	// return
	return $title;

}


/*
*  feadmin_group_choice
*
*  This function will return the text for a group choice
*
*  @type    function
*  @date    20/07/2016
*  @since   5.4.0
*
*  @param   $field_group (array)
*  @return  (string)
*/

function feadmin_group_choice( $field_group ) {
	// bail early if no field group
	if ( ! $field_group ) {
		return __( 'Unknown field group', 'acf' );
	}

	// return
	return sprintf( __( 'All fields from %s', 'acf-frontend-form-element' ), $field_group['title'] );

}

/*
*  get_selected_fields
*
*  This function will return an array of choices data for Select2
*
*  @type    function
*  @date    17/06/2016
*  @since   5.3.8
*
*  @param   $value (mixed)
*  @return  (array)
*/

function feadmin_get_selected_fields( $value, $choices = array() ) {
	// bail early if no $value
	if ( empty( $value ) ) {
		return $choices;
	}

	// force value to array
	$value = acf_get_array( $value );

	// loop
	foreach ( $value as $v ) {

		$choices[ $v ] = feadmin_get_selected_field( $v );

	}

	// return
	return $choices;

}
function feadmin_is_admin_form_key( $id ) {
	if ( is_string( $id ) && substr( $id, 0, 5 ) === 'form_' ) {
		return true;
	}
	return false;
}

function feadmin_form_choices( $choices = array() ) {
	$args = array(
		'post_type'      => 'admin_form',
		'posts_per_page' => '-1',
		'post_status'    => 'any',
	);

	$forms = get_posts( $args );

	if ( empty( $forms ) ) {
		return $choices;
	}

	foreach ( $forms as $form ) {
		$choices[ $form->ID ] = $form->post_title;
	}

	return $choices;
}

/*
* fea_encrypt
*
*  This function will encrypt an array using PHP
*  https://bhoover.com/using-php-openssl_encrypt-openssl_decrypt-encrypt-decrypt-data/
*
*  @type    function
*  @date    02/11/22
*  @since   3.9.11
*
*  @param   $data (array)
*  @return  (string)
*/
function fea_encrypt( $data = array() ) {
	if ( empty( $data ) ) {
		return false;
	}

	$data = json_encode( $data );

	// bail early if no encrypt function
	if ( ! function_exists( 'openssl_encrypt' ) ) {
		return base64_encode( $data );
	}

	// generate a key
	$key = wp_hash( 'fea_encrypt' );

	// Generate an initialization vector
	$iv = openssl_random_pseudo_bytes( openssl_cipher_iv_length( 'aes-256-cbc' ) );

	// Encrypt the data using AES 256 encryption in CBC mode using our encryption key and initialization vector.
	$encrypted_data = openssl_encrypt( $data, 'aes-256-cbc', $key, 0, $iv );

	// The $iv is just as important as the key for decrypting, so save it with our encrypted data using a unique separator (::)
	return base64_encode( $encrypted_data . '::' . $iv );

}

/*
*  fea_decrypt
*
*  This function will decrypt an encrypted string using PHP
*  https://bhoover.com/using-php-openssl_encrypt-openssl_decrypt-encrypt-decrypt-data/
*
*  @type    function
*  @date    02/11/22
*  @since   3.9.11
*
*  @param   $data (string)
*  @return  (array)
*/

function fea_decrypt( $data = '' ) {
	if ( empty( $data ) ) {
		return false;
	}

	// bail early if no decrypt function
	if ( ! function_exists( 'openssl_decrypt' ) ) {
		return json_decode( base64_decode( $data ), true );
	}

	// generate a key
	$key = wp_hash( 'fea_encrypt' );

	// To decrypt, split the encrypted data from our IV - our unique separator used was "::"
	list($encrypted_data, $iv) = explode( '::', base64_decode( $data ), 2 );

	// decrypt
	$data = openssl_decrypt( $encrypted_data, 'aes-256-cbc', $key, 0, $iv );

	return json_decode( $data, true );

}

/**
 * feadmin_get_time_input
 *
 * Returns the HTML of a text input.
 *
 * @date  3/02/2014
 * @since 5.0.0
 *
 * @param  array $attrs The array of attrs.
 * @return string
 */
function feadmin_get_time_input( $attrs = array() ) {
	$attrs = wp_parse_args(
		$attrs,
		array(
			'type' => 'time',
		)
	);
	if ( isset( $attrs['value'] ) && is_string( $attrs['value'] ) ) {
		$attrs['value'] = htmlspecialchars( $attrs['value'] );
	}
	return sprintf( '<input %s/>', feadmin_get_esc_attrs( $attrs ) );
}

/**
 * Determine whether the current user can edit a given user.
 *
 * Only administrators and users with the 'frontend_admin_manager' metadata field set to the current user's ID can edit a user.
 *
 * @param int $user_id The ID of the user to check.
 * @param array $form_args Additional arguments passed to the function.
 * @return int|bool The user ID if the user can edit it, or false if they cannot.
 */
function feadmin_can_edit_user( $user_id, $form_args ) {
    // Get the current user object
    $active_user = wp_get_current_user();
    $can_edit = false;

    // Check if the user is logged in and the user ID is set
    if ( isset( $user_id ) && is_user_logged_in() ) {
        // Check if the current user has the 'administrator' role
        if ( is_array( $active_user->roles ) ) {
            if ( in_array( 'administrator', $active_user->roles ) ) {
                $can_edit = $user_id;
            }
        }

        // Check if the current user is the user being edited, or if the 'frontend_admin_manager' metadata field is set to the current user's ID
        if ( $active_user->ID == $user_id || get_user_meta( $user_id, 'frontend_admin_manager', true ) == $active_user->ID ) {
            $can_edit = $user_id;
        }
    }

    // Return the user ID if the user can edit it, or false if they cannot
    return $can_edit;
}

/**
 * Determine whether the current user can edit a given post.
 *
 * Only administrators and the post author can edit a post.
 *
 * @param int $post_id The ID of the post to check.
 * @param array $form_args Additional arguments passed to the function.
 * @return int|bool The post ID if the user can edit it, or false if they cannot.
 */
function feadmin_can_edit_post( $post_id, $form_args ) {
    // Get the current user object
    $current_user = wp_get_current_user();
    $can_edit    = false;

    // Check if the user is logged in and the post ID is set
    if ( isset( $post_id ) && is_user_logged_in() ) {
        // Get the post object for the given post ID
        $edited_post = get_post( $post_id );

        // Check if the current user has the 'administrator' role
        if ( is_array( $current_user->roles ) ) {
            if ( in_array( 'administrator', $current_user->roles ) ) {
                $can_edit = $post_id;
            } else {
                // If the user is not an administrator, check if they are the author of the post
                if ( $current_user->ID == $edited_post->post_author ) {
                    $can_edit = $post_id;
                }
            }
        }
    }

    // Return the post ID if the user can edit it, or false if they cannot
    return $can_edit;
}

/*
*  feadmin_verify_nonce
*
*  This function will look at the $_POST['_acf_nonce'] value and return true or false
*
*  @type    function
*  @date    15/10/13
*  @since   3.12
*
*  @param   $nonce (string)
*  @return  (boolean)
*/

function feadmin_verify_nonce( $value ) {

	// vars
	$nonce = acf_maybe_get_POST( '_acf_nonce' );

	// bail early nonce does not match (post|user|comment|term)
	if ( ! $nonce || ! wp_verify_nonce( $nonce, $value ) ) {
		return false;
	}

	// reset nonce (only allow 1 save)
	$_POST['_acf_nonce'] = false;

	// return
	return true;

}


/*
*  feadmin_verify_ajax
*
*  This function will return true if the current AJAX request is valid
*  It's action will also allow WPML to set the lang and avoid AJAX get_posts issues
*
*  @type    function
*  @date    7/08/2015
*  @since   5.2.3
*
*  @param   n/a
*  @return  (boolean)
*/

function feadmin_verify_ajax() {

	// bail early if not acf nonce
	if ( empty( $_REQUEST['nonce'] ) || ! wp_verify_nonce( $_REQUEST['nonce'], 'fea_nonce' ) ) {
		return false;
	}

	// action for 3rd party customization
	do_action( 'frontend_admin/verify_ajax' );

	// return
	return true;
}

/**
 * feadmin_get_esc_attrs
 *
 * Generated valid HTML from an array of attrs.
 *
 * @date    11/6/19
 * @since   5.8.1
 *
 * @param   array $attrs The array of attrs.
 * @return  string
 */
function feadmin_get_esc_attrs( $attrs ) {
	$html = '';

	// Loop over attrs and validate data types.
	foreach ( $attrs as $k => $v ) {

		// String (but don't trim value).
		if ( is_string( $v ) && ( $k !== 'value' ) ) {
			$v = trim( $v );

			// Boolean
		} elseif ( is_bool( $v ) ) {
			$v = $v ? 1 : 0;

			// Object
		} elseif ( is_array( $v ) || is_object( $v ) ) {
			$v = json_encode( $v );
		}

		// Generate HTML.
		$html .= sprintf( ' %s="%s"', esc_attr( $k ), esc_attr( $v ) );
	}

	// Return trimmed.
	return trim( $html );
}
