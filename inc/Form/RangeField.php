<?php
/**
 * Created by PhpStorm.
 * User: nguyenvanduocit
 * Date: 9/29/2015
 * Time: 5:53 PM
 */

namespace Diress\Form;


class RangeField extends FormField{
	/**
	 * Sanitizes value.
	 *
	 * @param string $value
	 *
	 * @return string
	 */
	public function validate( $value ) {
		$sanitize = isset( $this->sanitize ) ? $this->sanitize : 'wp_kses_data';

		return call_user_func( $sanitize, $value, $this );
	}
	/**
	 * Generate the corresponding HTML for a field.
	 *
	 * @param array $args
	 *
	 * @return string
	 */
	protected function _render( $args ) {
		$args = wp_parse_args( $args, array(
			'value'    => '',
			'desc_pos' => 'after',
			'extra'    => array( 'class' => 'regular-text' ),
		) );

		if ( ! isset( $args['extra']['id'] ) && ! is_array( $args['name'] ) && false === strpos( $args['name'], '[' ) ) {
			$args['extra']['id'] = $args['name'];
		}
		if(isset($args['extra']['min'])){ $args['extra']['min']=  $args['min'];};
		if(isset($args['extra']['max'])){ $args['extra']['max']=  $args['max'];};
		if(isset($args['extra']['step'])){ $args['extra']['step']=  $args['step'];};
		return FormField::_input_gen( $args );
	}

	/**
	 * Sets value using a reference.
	 *
	 * @param array  $args
	 * @param string $value
	 *
	 * @return void
	 */
	protected function _set_value( &$args, $value ) {
		$args['value'] = $value;
	}
}