<?php
/**
 * Elementor Assignment WordPress Plugin
 *
 * @package ElementorAssignment
 *
 * Plugin Name: Elementor Assignment
 * Description: Simple Elementor plugin example
 * Plugin URI:  https://github.com/NicestRudeGuy/elementor-assignment
 * Version:     1.0.0
 * Author:      Vipin Kumar Dinkar
 * Author URI:  https://github.com/NicestRudeGuy
 * Text Domain: elementor-assignment
 */

define( 'ELEMENTOR_ASSIGNMENT', __FILE__ );

/**
 * Include the Elementor_Assignment class.
 */
require plugin_dir_path( ELEMENTOR_ASSIGNMENT ) . 'class-elementor-assignment.php';
