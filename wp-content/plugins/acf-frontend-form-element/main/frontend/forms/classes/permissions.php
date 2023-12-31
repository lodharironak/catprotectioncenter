<?php
namespace Frontend_Admin\Classes;

use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use ElementorPro\Modules\QueryControl\Module as Query_Module;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


class PermissionsTab {


	public function register_permissions_section( $widget, $form = false ) {
		$section_settings = array(
			'label' => __( 'Permissions', 'acf-frontend-form-element' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
		);
		if ( $form ) {
			$section_settings['condition'] = array(
				'admin_forms_select' => '',
			);
		}
		$widget->start_controls_section( 'permissions_section', $section_settings );
		$condition = array();

		$widget->add_control(
			'not_allowed',
			array(
				'label'       => __( 'No Permissions Message', 'acf-frontend-form-element' ),
				'type'        => Controls_Manager::SELECT,
				'label_block' => true,
				'default'     => 'show_nothing',
				'options'     => array(
					'show_nothing'   => __( 'None', 'acf-frontend-form-element' ),
					'show_message'   => __( 'Message', 'acf-frontend-form-element' ),
					'custom_content' => __( 'Custom Content', 'acf-frontend-form-element' ),
				),
			)
		);
		$condition['not_allowed'] = 'show_message';
		$widget->add_control(
			'not_allowed_message',
			array(
				'label'       => __( 'Message', 'acf-frontend-form-element' ),
				'type'        => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'rows'        => 4,
				'default'     => __( 'You do not have the proper permissions to view this form', 'acf-frontend-form-element' ),
				'placeholder' => __( 'You do not have the proper permissions to view this form', 'acf-frontend-form-element' ),
				'condition'   => $condition,
			)
		);
		$condition['not_allowed'] = 'custom_content';
		$widget->add_control(
			'not_allowed_content',
			array(
				'label'       => __( 'Content', 'acf-frontend-form-element' ),
				'type'        => Controls_Manager::WYSIWYG,
				'label_block' => true,
				'render_type' => 'none',
				'condition'   => $condition,
			)
		);
		unset( $condition['not_allowed'] );
		$who_can_see = array(
			'logged_in'  => __( 'Only Logged In Users', 'acf-frontend-form-element' ),
			'logged_out' => __( 'Only Logged Out', 'acf-frontend-form-element' ),
			'all'        => __( 'All Users', 'acf-frontend-form-element' ),
		);
		// get all user role choices
		$user_roles = feadmin_get_user_roles( array(), true );
		$user_caps  = feadmin_get_user_caps( array(), true );

		$widget->add_control(
			'who_can_see',
			array(
				'label'       => __( 'Who Can See This...', 'acf-frontend-form-element' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'default'     => 'logged_in',
				'options'     => $who_can_see,
				'condition'   => $condition,
			)
		);
		$condition['who_can_see'] = 'logged_in';
		$widget->add_control(
			'by_role',
			array(
				'label'       => __( 'Select By Role', 'acf-frontend-form-element' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple'    => true,
				'default'     => array( 'administrator' ),
				'options'     => $user_roles,
				'condition'   => $condition,
			)
		);
		$widget->add_control(
			'by_cap',
			array(
				'label'       => __( 'Select By Capabilities', 'acf-frontend-form-element' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple'    => true,
				'options'     => $user_caps,
				'condition'   => $condition,
			)
		);
		if ( ! class_exists( 'ElementorPro\\Modules\\QueryControl\\Module' ) ) {
			$widget->add_control(
				'by_user_id',
				array(
					'label'       => __( 'Select By User', 'acf-frontend-form-element' ),
					'type'        => Controls_Manager::TEXT,
					'placeholder' => __( '18, 12, 11', 'acf-frontend-form-element' ),
					'description' => __( 'Enter the a comma-seperated list of user ids', 'acf-frontend-form-element' ),
					'condition'   => $condition,
				)
			);
		} else {
			$widget->add_control(
				'by_user_id',
				array(
					'label'        => __( 'Select By User', 'acf-frontend-form-element' ),
					'label_block'  => true,
					'type'         => Query_Module::QUERY_CONTROL_ID,
					'autocomplete' => array(
						'object'  => Query_Module::QUERY_OBJECT_USER,
						'display' => 'detailed',
					),
					'multiple'     => true,
					'condition'    => $condition,
				)
			);
		}

		if ( $widget->get_name() !== 'edit_button' ) {
			$condition['save_to_post'] = array( 'edit_post', 'duplicate_post', 'delete_post' );
		}
		$widget->add_control(
			'dynamic',
			array(
				'label'       => __( 'Dynamic Permissions', 'acf-frontend-form-element' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'description' => 'Use a dynamic acf user field that returns a user ID to filter the form for that user dynamically. You may also select the post\'s author',
				'options'     => feadmin_user_id_fields(),
				'condition'   => $condition,
			)
		);
		$condition['save_to_user'] = 'edit_user';
		$widget->add_control(
			'dynamic_manager',
			array(
				'label'       => __( 'Dynamic Permissions', 'acf-frontend-form-element' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'options'     => array(
					'manager' => __( 'User Manager', 'acf-frontend-form-element' ),
				),
				'condition'   => $condition,
			)
		);

		if ( $form ) {
			$widget->add_control(
				'wp_uploader',
				array(
					'label'        => __( 'WP Media Library', 'acf-frontend-form-element' ),
					'type'         => Controls_Manager::SWITCHER,
					'description'  => 'Whether to use the WordPress media library for file fields or just a basic upload button',
					'label_on'     => __( 'Yes', 'acf-frontend-form-element' ),
					'label_off'    => __( 'No', 'acf-frontend-form-element' ),
					'default'      => 'true',
					'return_value' => 'true',
				)
			);
			$widget->add_control(
				'media_privacy_note',
				array(
					'label'           => __( '<h3>Media Privacy</h3>', 'acf-frontend-form-element' ),
					'type'            => Controls_Manager::RAW_HTML,
					'raw'             => __( '<p align="left">Click <a target="_blank" href="' . admin_url( '?page=' .  'fea-settings&tab=uploads-privacy' ) . '">here</a> to limit the files displayed in the media library to the user who uploaded them.</p>', 'acf-frontend-form-element' ),
					'content_classes' => 'media-privacy-note',
				)
			);
		}
		$widget->end_controls_section();
	}


	public function conditions_logic( $settings, $type ) {
		if ( ! empty( $settings['display'] ) ) {
			return $settings;
		}

		global $post;

		if ( isset( $settings['form_conditions'] ) ) {
			$conditions = $settings['form_conditions'];
		} else {
			$conditions = array();
			$values     = array(
				'who_can_see'         => 'logged_in',
				'not_allowed'         => 'show_nothing',
				'not_allowed_message' => '',
				'not_allowed_content' => '',
				'email_verification'  => 'all',
				'by_role'             => array( 'administrator' ),
				'by_user_id'          => '',
				'dynamic'             => '',
			);

			foreach ( $values as $key => $value ) {
				if ( isset( $settings[ $key ] ) ) {
					$conditions[0][ $key ] = $settings[ $key ];
				} else {
					$conditions[0][ $key ] = $value;
				}
			}
		}

		if ( empty( $conditions ) ) {
			return $settings;
		}
		$active_user = wp_get_current_user();
		foreach ( $conditions as $condition ) {
			if ( ! isset( $condition['applies_to'] ) ) {
				$condition['applies_to'] = array( 'form' );
			}

			if ( empty( $condition['applies_to'] ) || ! in_array( $type, $condition['applies_to'] ) ) {
				continue;
			}

			if ( 'all' == $condition['who_can_see'] ) {
				$settings['display'] = true;
				return $settings;
			}
			if ( 'logged_out' == $condition['who_can_see'] ) {
				$settings['display'] = ! (bool) $active_user->ID;
			}
			if ( 'logged_in' == $condition['who_can_see'] ) {
				if ( ! $active_user ) {
					$settings['display'] = false;
				} else {
					$by_role    = $by_cap = $specific_user = $dynamic = false;
					$user_roles = $condition['by_role'];

					if ( $user_roles ) {
						if ( is_array( $condition['by_role'] ) ) {
							if ( count( array_intersect( $condition['by_role'], (array) $active_user->roles ) ) != false || in_array( 'all', $condition['by_role'] ) ) {
								$by_role = true;
							}
						}
					}

					if ( ! empty( $condition['by_cap'] ) ) {
						foreach ( $condition['by_cap'] as $cap ) {
							if ( current_user_can( $cap ) ) {
								$by_cap = true;
							}
						}
					}

					if ( ! empty( $condition['by_user_id'] ) ) {
						$user_ids = $condition['by_user_id'];
						if ( ! is_array( $user_ids ) ) {
							$user_ids = explode( ',', $user_ids );
						}
						if ( is_array( $user_ids ) ) {
							if ( in_array( $active_user->ID, $user_ids ) ) {
								$specific_user = true;
							}
						}
					}

					$save = isset( $settings['save_to_post'] ) ? $settings['save_to_post'] : '';
					if ( $save == 'edit_post' || $save == 'delete_post' || $save == 'duplicate_post' ) {
						$post_action = true;
					}

					if ( ! empty( $condition['dynamic'] ) ) {
						if ( ! empty( $settings['post_id'] ) ) {
							$post_id = $settings['post_id'];
						} elseif ( ! empty( $settings['product_id'] ) ) {
							$post_id = $settings['product_id'];
						} else {
							$post_id = get_the_ID();
							if ( isset( $post_action ) ) {
								if ( $settings['post_to_edit'] == 'select_post' && ! empty( $settings['post_select'] ) ) {
									$post_id = $settings['post_select'];
								} elseif ( $settings['post_to_edit'] == 'url_query' && isset( $_GET[ $settings['url_query_post'] ] ) ) {
									$post_id = absint( $_GET[ $settings['url_query_post'] ] );
								}
							}
						}

						if ( '[author]' == $condition['dynamic'] ) {
							$author_id = get_post_field( 'post_author', $post_id );
						} else {
							$author_id = get_post_meta( $post_id, $condition['dynamic'], true );
						}

						if ( ! is_numeric( $author_id ) ) {
							$authors = acf_decode_choices( $author_id );
							if ( in_array( $active_user->ID, $authors ) ) {
								$dynamic = true;
							}
						} else {
							if ( $author_id == $active_user->ID ) {
								$dynamic = true;
							}
						}
					}
					$save = isset( $settings['save_to_user'] ) ? $settings['save_to_user'] : '';
					if ( $save == 'edit_user' || $save == 'delete_user' ) {
						$user_action = true;
					}
					if ( isset( $condition['dynamic_manager'] ) && isset( $user_action ) ) {
						if ( $settings['user_to_edit'] == 'current_user' ) {
							$user_id = $active_user->ID;
						} elseif ( $settings['user_to_edit'] == 'select_user' ) {
							$user_id = $settings['user_select'];
						} elseif ( $settings['user_to_edit'] == 'url_query' && isset( $_GET[ $settings['url_query_user'] ] ) ) {
							$user_id = wp_kses( $_GET[ $settings['url_query_user'] ], 'strip' );
						}

						if ( $condition['dynamic_manager'] && isset( $user_id[1] ) ) {
							$manager_id = false;

							if ( 'manager' == $condition['dynamic_manager'] ) {
								$manager_id = get_user_meta( $user_id, 'frontend_admin_manager', true );
							} else {
								$manager_id = get_user_meta( $user_id, $condition['dynamic_manager'], true );
							}

							if ( $manager_id == $active_user->ID ) {
								$dynamic = true;
							}
						}
					}

					if ( $by_role || $by_cap || $specific_user || $dynamic ) {
						if ( isset( $condition['email_verification'] ) && $condition['email_verification'] != 'all' ) {
							$required       = $condition['email_verification'] == 'verified' ? 1 : 0;
							$email_verified = get_user_meta( $active_user, 'frontend_admin_email_verified', true );

							if ( ( $email_verified == $required ) ) {
								$settings['display'] = true;
							} else {
								$settings['display'] = false;
							}
						} else {
							$settings['display'] = true;
						}
						if ( ! empty( $condition['allowed_submits'] ) ) {
							$submits = (int) $condition['allowed_submits'];

							$submitted = get_user_meta( $active_user->ID, 'submitted::' . $settings['id'], true );
							if ( $submits - (int) $submitted <= 0 ) {
								$settings['display'] = false;

								if ( $condition['limit_reached'] == 'show_message' ) {
									$settings['message'] = '<div class="acf-notice -limit frontend-admin-limit-message"><p>' . $condition['limit_reached_message'] . '</p></div>';
								} elseif ( $condition['limit_reached'] == 'custom_content' ) {
									$settings['message'] = $condition['limit_reached_content'];
								} else {
									$settings['message'] = 'NOTHING';
								}
							}
						}
						return $settings;
					}

					$settings['display'] = false;

				}
			}
			if ( $condition['not_allowed'] == 'show_message' ) {
				echo '<div class="acf-notice -limit frontend-admin-limit-message"><p>' . esc_html( $condition['not_allowed_message'] ) . '</p></div>';
			} elseif ( $condition['not_allowed'] == 'custom_content' ) {
				echo wp_kses_post( $condition['not_allowed_content'] );
			}

			if ( $settings['display'] ) {
				break;
			}
		}
		if ( empty( $settings['display'] ) ) {
			$settings = false;
		}

		return $settings;
	}

	public function __construct() {
		 add_action( 'frontend_admin/permissions_section', array( $this, 'register_permissions_section' ), 10, 2 );
		add_filter( 'frontend_admin/show_form', array( $this, 'conditions_logic' ), 10, 2 );
	}

}

new PermissionsTab();
