<?php


namespace Jet_Form_Builder\Classes\Arrayable;

class Array_Tools {

	public static function to_array( array $payload ): array {
		foreach ( $payload as $index => $object ) {
			if ( is_array( $object ) ) {
				continue;
			}

			/** @var Arrayable $object */
			if ( is_object( $object ) && ! ( $object instanceof Arrayable ) ) {
				wp_die( 'Must implements Arrayable.', 'Illegal item of array' );
			}

			try {
				$payload[ $index ] = $object->to_array();
			} catch ( Array_Continue_Exception $exception ) {
				continue;
			}
		}

		return array_values( $payload );
	}

}
