<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://techblog.sdstudio.top/
 * @since      1.0.0
 *
 * @package    Montazheco_Price_Calc
 * @subpackage Montazheco_Price_Calc/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Montazheco_Price_Calc
 * @subpackage Montazheco_Price_Calc/includes
 * @author     Serhii Dudchenko <sergeydydchenko@gmail.com>
 */
class Montazheco_Price_Calc_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'montazheco-price-calc',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
