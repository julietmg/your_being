<?php

namespace Jet_Form_Builder\Actions\Methods\Update_User;

use Jet_Form_Builder\Actions\Methods\Abstract_Modifier;
use Jet_Form_Builder\Classes\Tools;
use Jet_Form_Builder\Exceptions\Action_Exception;
use Jet_Form_Builder\Exceptions\Silence_Exception;

class User_Modifier extends Abstract_Modifier {

	/** @var \WP_User */
	private $updated_user;

	/** @var string */
	private $user_role;

	public function get_object_fields() {
		return apply_filters(
			'jet-form-builder/user-modifier/object-properties',
			array(
				'ID'               => array(
					'before_cb' => array( $this, 'before_attach_id' ),
				),
				'password'         => array(
					'before_cb' => array( $this, 'before_attach_password' ),
				),
				'email'            => array(
					'before_cb' => array( $this, 'before_attach_email' ),
				),
				'confirm_password' => array(
					'before_cb' => array( $this, 'exclude_current' ),
				),
				'user_url',
				'user_nicename',
				'first_name',
				'last_name',
				'display_name',
				'nickname',
				'description',
			)
		);
	}

	public function get_actions() {
		return apply_filters(
			'jet-form-builder/user-modifier/object-actions',
			array(
				'update' => array(
					'action' => array( $this, 'update_user' ),
				),
			)
		);
	}

	public function get_external_properties() {
		return apply_filters(
			'jet-form-builder/user-modifier/external-actions',
			array(
				'meta' => array(
					'condition_cb' => true,
					'match_cb'     => array( $this, 'attach_user_meta' ),
					'after_action' => array( $this, 'after_action_user_meta' ),
				),
			)
		);
	}

	public function get_action() {
		return 'update';
	}

	/**
	 * @throws Action_Exception
	 */
	public function update_user() {
		$response = wp_update_user( $this->source_arr );

		if ( is_wp_error( $response ) ) {
			throw ( new Action_Exception(
				$response->get_error_message(),
				$response->get_error_data()
			)
			)->dynamic_error();
		}

		if ( ! empty( $this->user_role ) ) {
			$this->updated_user->set_role( $this->user_role );
		}
	}

	public function attach_user_meta() {
		if ( ! Tools::is_repeater_val( $this->current_value ) ) {
			$this->set_current_external(
				array(
					$this->current_prop => $this->current_value,
				)
			);

			return;
		}

		$this->set_current_external(
			array(
				$this->current_prop => Tools::prepare_repeater_value(
					$this->current_value,
					$this->fields_map
				),
			)
		);
	}

	public function after_action_user_meta() {
		$meta = $this->get_current_external();

		foreach ( $meta as $key => $value ) {
			update_user_meta( $this->updated_user->ID, $key, $value );
		}
	}

	/**
	 * @throws Action_Exception
	 */
	public function before_attach_id() {
		$this->current_value = absint( $this->current_value );

		if ( empty( $this->current_value ) ) {
			throw new Action_Exception( 'sanitize_user' );
		}

		if ( get_current_user_id() !== $this->current_value && ! current_user_can( 'edit_users' ) ) {
			// Only users with appropriate capabilities can edit other users, also user can edit himself
			throw new Action_Exception( 'internal_error' );
		}

		$this->updated_user = get_user_by( 'ID', $this->current_value );

		if ( ! is_a( $this->updated_user, \WP_User::class ) ) {
			throw new Action_Exception( 'internal_error', $this->updated_user, $this->current_value );
		}
	}

	/**
	 * @throws Silence_Exception|Action_Exception
	 */
	public function before_attach_password() {
		$this->throw_if_empty();
		$this->current_prop = 'user_pass';

		$confirm = $this->get_value_by_prop( 'confirm_password' );

		if ( false === $confirm ) {
			$this->current_value = wp_check_invalid_utf8( $this->current_value, true );

			return;
		}

		$this->current_value = wp_check_invalid_utf8( $this->current_value, true );
		$confirm             = wp_check_invalid_utf8( $confirm, true );

		if ( $confirm !== $this->current_value ) {
			throw new Action_Exception( 'password_mismatch' );
		}
	}

	/**
	 * @throws Silence_Exception|Action_Exception
	 */
	public function before_attach_email() {
		$this->throw_if_empty();
		$this->current_prop = 'user_email';

		$email = sanitize_email( $this->current_value );

		if ( $email !== $this->current_value ) {
			throw new Action_Exception( 'empty_email' );
		}

		$email_exists = email_exists( $email );
		$id           = (int) $this->get_value_by_prop( 'ID' );

		if ( $email_exists && $id !== $email_exists ) {
			throw new Action_Exception( 'email_exists' );
		}
	}

	public function set_user_role( $role ) {
		if ( ! empty( $role ) && 'administrator' !== $role ) {
			$this->user_role = $role;
		}

		return $this;
	}

	/**
	 * @throws Action_Exception
	 */
	public function run() {
		if ( ! is_user_logged_in() ) {
			// Only logged in users can edit other users
			throw new Action_Exception( 'internal_error' );
		}

		parent::run(); // TODO: Change the autogenerated stub
	}
}
