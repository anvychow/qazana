<?php
namespace Qazana;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Box shadow control.
 *
 * A base control for creating box shadow control. Displays input fields to define
 * the box shadow.
 *
 * Creating new control in the editor (inside `Widget_Base::_register_controls()`
 * method):
 *
 *    $this->add_group_control(
 *    	Group_Control_Box_Shadow::get_type(),
 *    	[
 *    		'name' => 'box_shadow',
 *    		'selector' => '{{WRAPPER}} .wrapper',
 *    		'separator' => 'before',
 *    	]
 *    );
 *
 * @since 1.0.0
 *
 * @param string $name        The field name.
 * @param string $separator   Optional. Set the position of the control separator.
 *                            Available values are 'default', 'before', 'after'
 *                            and 'none'. 'default' will position the separator
 *                            depending on the control type. 'before' / 'after'
 *                            will position the separator before/after the
 *                            control. 'none' will hide the separator. Default
 *                            is 'default'.
 */
class Group_Control_Box_Shadow extends Group_Control_Base {

	/**
	 * Fields.
	 *
	 * Holds all the box shadow control fields.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @static
	 *
	 * @var array Box shadow control fields.
	 */
	protected static $fields;

	/**
	 * Retrieve type.
	 *
	 * Get box shadow control type.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 * @return string Control type.
	 */
	public static function get_type() {
		return 'box-shadow';
	}

	/**
	 * Init fields.
	 *
	 * Initialize box shadow control fields.
	 *
	 * @since 1.0.0
	 * @access protected
	 *
	 * @return array Control fields.
	 */
	protected function init_fields() {
		$controls = [];

		$controls['box_shadow'] = [
			'label' => _x( 'Box Shadow', 'Box Shadow Control', 'qazana' ),
			'type' => Controls_Manager::BOX_SHADOW,
			'condition' => [
				'box_shadow_type!' => '',
			],
			'selectors' => [
				'{{SELECTOR}}' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}} {{box_shadow_position.VALUE}};',
            ],
            'responsive' => true,
		];

		$controls['box_shadow_position'] = [
			'label' => _x( 'Position', 'Box Shadow Control', 'qazana' ),
			'type' => Controls_Manager::SELECT,
			'options' => [
				' ' => _x( 'Outline', 'Box Shadow Control', 'qazana' ),
				'inset' => _x( 'Inset', 'Box Shadow Control', 'qazana' ),
			],
			'condition' => [
				'box_shadow_type!' => '',
			],
			'default' => ' ',
            'render_type' => 'ui',
            'responsive' => true,
		];

		return $controls;
	}

    	/**
	 * Init defaults.
	 *
	 * Initialize box shadow control defaults.
	 *
	 * @since 1.0.0
	 * @access protected
	 *
	 * @return array Control fields.
	 */
	protected function get_default_options() {
		return [
			'popover' => [
				'starter_title' => _x( 'Box Shadow', 'Box Shadow Control', 'qazana' ),
				'starter_name' => 'box_shadow_type',
				'starter_value' => 'yes',
			],
		];
	}
}
