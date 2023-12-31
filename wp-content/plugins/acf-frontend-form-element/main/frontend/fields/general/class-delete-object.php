<?php
namespace Frontend_Admin\Field_Types;

if ( ! class_exists( 'delete_object' ) ) :

	class delete_object extends Field_Base {

		public $object = false;

		function initialize() {
			 $this->public = false;

			 add_action( 'wp_ajax_frontend_admin/delete_object', array( $this, 'delete_object' ) );
			 add_action( 'wp_ajax_nopriv_frontend_admin/delete_object', array( $this, 'delete_object' ) );
		}

		public function delete_object() {
			if ( ! feadmin_verify_nonce( 'fea_form' ) ) {
				wp_send_json_error( __( 'Nonce Error', 'acf-frontend-form-element' ) );
			}
			// bail ealry if form not submit
			if ( empty( $_POST['_acf_form'] ) ) {
				wp_send_json_error( __( 'No Form Data', 'acf-frontend-form-element' ) );
			}
			// load form
			$form = json_decode( fea_decrypt( $_POST['_acf_form'] ), true );

			$form = wp_kses_post_deep( $form );			

			// bail ealry if form is corrupt
			if ( empty( $form ) ) {
				wp_send_json_error( __( 'No Form Data', 'acf-frontend-form-element' ) );
			}

			if ( empty( $_POST['field'] ) ) {
				wp_send_json_error( __( 'Delete Button Key Not Found', 'acf-frontend-form-element' ) );
			}

			$key = sanitize_key( $_POST['field'] );



			$field = $form['fields'][ $key ];
			if ( ! $field && ! empty( $form['fields'][ $key ] ) ) {
				$field = $form['fields'][ $key ];
			}
			
			error_log( print_r( $field, true ) );

			if ( ! $field ) {                                      
				wp_send_json_error( __( 'Invalid Delete Button', 'acf-frontend-form-element' ) );
			}

			// add global for backwards compatibility
			$GLOBALS['admin_form'] = $form;

			if ( isset( $field['redirect'] ) ) {
				$form['redirect'] = $field['redirect'];
			}
			if ( isset( $field['custom_url'] ) ) {
				$form['custom_url'] = $field['custom_url'];
			}
			$form['message_location'] = 'other';

			$redirect_args = array(
				'redirect'    => fea_instance()->form_submit->get_redirect_url( $field ),
				'form_element' => $form['id'],
				'location'     => $form['message_location'],
				'frontend-form-nonce' => wp_create_nonce( 'frontend-form' ),
				'success_message' => __( 'The object has been deleted', 'acf-frontend-form-element' )
			);

			if ( $field['show_delete_message'] ) {
				if ( ! empty( $field['delete_message'] ) ) {
					$message = $field['delete_message'];
				} else {
					$message = $form['success_message'];
				}
				if ( strpos( $message, '[' ) !== 'false' ) {
					$message = fea_instance()->dynamic_values->get_dynamic_values( $message, $form );
				}
				$redirect_args['success_message']     = $message;
			}

			switch ( $field['type'] ) {
				case 'delete_post':
					if ( ! empty( $_POST['_acf_post'] ) ) {
						$post_id = intval( $_POST['_acf_post'] );
						if ( empty( $field['force_delete'] ) ) {
							$deleted = wp_trash_post( $post_id );
						} else {
							$deleted = wp_delete_post( $post_id, true );
						}
						$form['record']['post'] = $post_id;
					}
					break;
				case 'delete_product':
					if ( ! empty( $_POST['_acf_product'] ) ) {
						$product_id = intval( $_POST['_acf_product'] );
						if ( empty( $field['force_delete'] ) ) {
							$deleted = wp_trash_post( $product_id );
						} else {
							$deleted = wp_delete_post( $product_id, true );
						}
						$form['record']['product'] = $product_id;
					}
					break;
				case 'delete_term':
					if ( ! empty( $_POST['_acf_term'] ) ) {
						$term_id                = intval( $_POST['_acf_term'] );
						$deleted                = wp_delete_term( $term_id, sanitize_title( $_POST['_acf_taxonomy_type'] ) );
						$form['record']['term'] = $term_id;
					}
					break;
				case 'delete_user':
					if ( ! empty( $_POST['_acf_user'] ) ) {
						$user_id                = intval( $_POST['_acf_user'] );
						$deleted                = wp_delete_user( $user_id, $field['reassign_posts'] );
						$form['record']['user'] = $user_id;
					}
					break;
				default:
					wp_send_json_error( __( 'No object found to delete' ) );
			}

			$expiration_time = time() + 600;
			setcookie( 'admin_form_success', json_encode( $redirect_args ), $expiration_time, '/' );

			wp_send_json_success( $redirect_args );
		}


		/*
		*  render_field()
		*
		*  Create the HTML interface for your field
		*
		*  @param    $field - an array holding all the field's data
		*
		*  @type    action
		*  @since    3.6
		*  @date    23/01/13
		*/

		function render_field( $field ) {
			$confirm = ! empty( $field['confirmation_text'] ) ? $field['confirmation_text'] : __( 'Are you sure you want to delete this ' . $this->object . '?', 'acf-frontend-form-element' );

			if ( ! empty( $field['button_icon'] ) ) {
				$field['button_text'] = '<i class="' . $field['button_icon'] . '"></i> ' . $field['button_text'];
			}
			// vars
			$m = '<button type="button" class="fea-delete-button button button-primary" data-confirm="' . $confirm . '" data-state="delete">' . $field['button_text'] . '</button>';

			// wptexturize (improves "quotes")
			$m = wptexturize( $m );

			echo wp_kses_post( $m );
		}


		/*
		*  load_field()
		*
		*  This filter is appied to the $field after it is loaded from the database
		*
		*  @type    filter
		*  @since    3.6
		*  @date    23/01/13
		*
		*  @param    $field - the field array holding all the field options
		*
		*  @return    $field - the field array holding all the field options
		*/
		function load_field( $field ) {
			 // remove name to avoid caching issue
			$field['name'] = '';

			// remove instructions
			$field['instructions'] = '';

			// remove required to avoid JS issues
			$field['required'] = 0;

			// set value other than 'null' to avoid ACF loading / caching issue
			$field['value'] = false;

			$field['field_label_hide'] = 1;

			$field['no_data_collect'] = 1;

			// return
			return $field;
		}

		function prepare_field( $field ) {
			if( ! $this->object ) return $field;
			if ( empty( $GLOBALS['admin_form'][ $this->object . '_id' ] ) || ! is_numeric( $GLOBALS['admin_form'][ $this->object . '_id' ] ) ) {
				return false;
			}
			return $field;
		}

		function render_field_settings( $field ) {
			acf_render_field_setting(
				$field,
				array(
					'label' => __( 'Button Text', 'acf-frontend-form-element' ),
					'type'  => 'text',
					'name'  => 'button_text',
					'class' => 'update-label',
				)
			);
			acf_render_field_setting(
				$field,
				array(
					'label' => __( 'Confirmation Text', 'acf-frontend-form-element' ),
					'type'  => 'text',
					'name'  => 'confirmation_text',
				)
			);

			if ( $this->object == 'user' ) {
				$choices = array();
				if ( $field['reassign_posts'] ) {
					$user = get_user_by( 'id', intval( $field['reassign_posts'] ) );

					if ( isset( $user->ID ) ) {
						$choices = array( $user->ID => $user->user_login );
					}
				}
				acf_render_field_setting(
					$field,
					array(
						'label'       => __( 'Reassign Posts to...', 'acf-frontend-form-element' ),
						'type'        => 'select',
						'ui'          => 1,
						'ajax'        => 1,
						'allow_null'  => 1,
						'choices'     => $choices,
						'ajax_action' => 'acf_frontend/fields/reassign_posts/query',
						'placeholder' => __( 'Delete Posts', 'acf-frontend-form-element' ),
						'name'        => 'reassign_posts',
					)
				);
			}

			if ( $this->object == 'product' || $this->object == 'post' ) {
				acf_render_field_setting(
					$field,
					array(
						'label' => __( 'Skip Trash', 'acf-frontend-form-element' ),
						'type'  => 'true_false',
						'ui'    => 1,
						'name'  => 'force_delete',
					)
				);
			}
			acf_render_field_setting(
				$field,
				array(
					'label' => __( 'Show Delete Message', 'acf-frontend-form-element' ),
					'type'  => 'true_false',
					'ui'    => 1,
					'name'  => 'show_delete_message',
				)
			);
			acf_render_field_setting(
				$field,
				array(
					'label'      => __( 'Delete Message', 'acf-frontend-form-element' ),
					'type'       => 'textarea',
					'name'       => 'delete_message',
					'rows'       => 3,
					'conditions' => array(
						array(
							array(
								'field'    => 'show_delete_message',
								'operator' => '==',
								'value'    => 1,
							),
						),
					),
				)
			);
			acf_render_field_setting(
				$field,
				array(
					'label'        => __( 'Redirect After Delete', 'acf-frontend-form-element' ),
					'instructions' => '',
					'type'         => 'select',
					'name'         => 'redirect',
					'choices'      => array(
						''            => __( 'Form Default', 'acf-frontend-form-element' ),
						'current'     => __( 'Reload Current Url', 'acf-frontend-form-element' ),
						'custom_url'  => __( 'Custom Url', 'acf-frontend-form-element' ),
						'referer_url' => __( 'Referer', 'acf-frontend-form-element' ),
					),
				)
			);
			acf_render_field_setting(
				$field,
				array(
					'label'      => __( 'Custom Url', 'acf-frontend-form-element' ),
					'type'       => 'url',
					'name'       => 'custom_url',
					'conditions' => array(
						array(
							array(
								'field'    => 'redirect',
								'operator' => '==',
								'value'    => 'custom_url',
							),
						),
					),
				)
			);
		}

	}




endif; // class_exists check


