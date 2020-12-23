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
	 * A single example test.
	 */
	public function test_construct() {
		// Replace this with some actual testing code.
		require_once 'widgets/class-assignment.php';
		$widget_assignment = Assignment;
		$name              = $widget_assignment->get_name();
		$this->assertTrue( 'assignment' === $name );
	}
}
