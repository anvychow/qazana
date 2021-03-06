<?php
namespace Qazana;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Qazana popover toggle control.
 *
 * A base control for creating a popover toggle control. By default displays a button
 * to open and close the popover.
 *
 * Creating new control in the editor (inside `Widget_Base::_register_controls()`
 * method):
 *
 *    $this->add_control(
 *    	'border_popover_toggle',
 *    	[
 *    		'label' => __( 'Border', 'plugin-domain' ),
 *    		'type' => Controls_Manager::POPOVER_TOGGLE,
 *    		'default' => 'yes',
 *    		'return_value' => 'yes',
 *    		'label_off' => __( 'Default', 'plugin-domain' ),
 *    		'label_on' => __( 'Custom', 'plugin-domain' ),
 *    	]
 *    );
 *
 * @since 1.3.0
 *
 * @param string $label        Optional. The label that appears next of the
 *                             field. Default is empty.
 * @param mixed  $default      Optional. The field default value.
 * @param string $return_value Optional. The value returned when checked.
 *                             Default is 'yes'.
 * @param string $label_off    Optional. The label for the "unchecked" state
 *                             Default is `__( 'Default', 'qazana' )`.
 * @param string $label_on     Optional. The label for the "checked" state.
 *                             Default is `__( 'Custom', 'qazana' )`.
 * @param string $separator    Optional. Set the position of the control separator.
 *                             Available values are 'default', 'before', 'after'
 *                             and 'none'. 'default' will position the separator
 *                             depending on the control type. 'before' / 'after'
 *                             will position the separator before/after the
 *                             control. 'none' will hide the separator. Default
 *                             is 'default'.
 * @param bool   $show_label   Optional. Whether to display the label. Default
 *                             is true.
 * @param bool   $label_block  Optional. Whether to display the label in a
 *                             separate line. Default is false.
 */
class Control_Popover_Toggle extends Base_Data_Control {

	/**
	 * Retrieve popover toggle control type.
	 *
	 * @since 1.3.0
	 * @access public
	 *
	 * @return string Control type.
	 */
	public function get_type() {
		return 'popover_toggle';
	}

	/**
	 * Retrieve popover toggle control default settings.
	 *
	 * Get the default settings of the popover toggle control. Used to
	 * return the default settings while initializing the popover toggle
	 * control.
	 *
	 * @since 1.3.0
	 * @access protected
	 *
	 * @return array Control default settings.
	 */
	protected function get_default_settings() {
		return [
			'toggle_type' => 'switcher',
			'return_value' => 'yes',
		];
	}

	/**
	 * Render popover toggle control output in the editor.
	 *
	 * Used to generate the control HTML in the editor using Underscore JS
	 * template. The variables for the class are available using `data` JS
	 * object.
	 *
	 * @since 1.3.0
	 * @access public
	 */
	public function content_template() {
		$control_uid = $this->get_control_uid();
		?>
		<div class="qazana-control-field">
			<label class="qazana-control-title">{{{ data.label }}}</label>
			<div class="qazana-control-input-wrapper">
				<input id="<?php echo $control_uid; ?>-custom" class="qazana-control-popover-toggle-toggle" type="radio" name="qazana-choose-{{ data.name }}-{{ data._cid }}" value="{{ data.return_value }}">
				<label class="qazana-control-popover-toggle-toggle-label" for="<?php echo $control_uid; ?>-custom">
					<i class="eicon-edit" aria-hidden="true"></i>
					<span class="qazana-screen-only"><?php esc_html_e( 'Edit', 'qazana' ); ?></span>
				</label>
				<# if ( 'switcher' === data.toggle_type ) { #>
					<input id="<?php echo $control_uid; ?>-default" type="radio" name="qazana-choose-{{ data.name }}-{{ data._cid }}" value="">
					<label class="qazana-control-popover-toggle-reset-label tooltip-target" for="<?php echo $control_uid; ?>-default" data-tooltip="<?php echo __( 'Back to default', 'qazana' ); ?>" data-tooltip-pos="s">
						<i class="fa fa-repeat" aria-hidden="true"></i>
						<span class="qazana-screen-only"><?php esc_html_e( 'Back to default', 'qazana' ); ?></span>
					</label>
				<# } #>
			</div>
		</div>
		<?php
	}
}
