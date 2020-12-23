<?php
/**
 * Class SampleTest
 *
 * @package Elementor_Assignment
 */

/**
 * Sample test case.
 */
class SampleTest extends WP_UnitTestCase {

	/**
	 * A single example test.
	 */
	public function test_sample() {
		// Replace this with some actual testing code.
		$widget_loaded = new Elementor_Assignment();
		$is_loaded     = has_action( 'plugins_loaded', array( $widget_loaded, 'init' ) );
		$this->assertTrue( 10 === $is_loaded );
		
	}
}
