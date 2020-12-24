<?php
/**
 * Class TestAssignment
 *
 * @package Elementor_Assignment
 */

/**
 * Sample test case.
 */
class Test_Assignment extends WP_UnitTestCase {

	/**
	 * Test to check if the plugin is loaded with elementor.
	 */
	public function test_construct() {
		$plugin_loaded = new Elementor_Assignment();
		$is_loaded     = has_action( 'plugins_loaded', array( $plugin_loaded, 'init' ) );
		$this->assertTrue( 10 === $is_loaded );
	}

	/**
	 * Test to check the name of widget.
	 */
	public function test_get_name() {

	}
}
