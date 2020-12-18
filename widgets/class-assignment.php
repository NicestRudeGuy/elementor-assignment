<?php
/**
 * Assignment class.
 *
 * @category   Class
 * @package    ElementorAssignment
 * @subpackage WordPress
 * @author     Vipin kumar Dinkar <vipinkumard365@gmail.com>
 * @license    https://opensource.org/licenses/GPL-3.0 GPL-3.0-only
 * @since      1.0.0
 * php version 7.3.5
 */

namespace ElementorAssignment\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

// Security Note: Blocks direct access to the plugin PHP files.
defined( 'ABSPATH' ) || die();

/**
 * Assignment widget class.
 *
 * @since 1.0.0
 */
class Assignment extends Widget_Base {
	/**
	 * Class constructor.
	 *
	 * @param array $data Widget data.
	 * @param array $args Widget arguments.
	 */
	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );

		wp_register_style( 'assignment_css', plugins_url( '/assets/css/main.css', ELEMENTOR_ASSIGNMENT ), array(), wp_rand(), 'all' );
		wp_register_script( 'assignment_js', plugins_url( '/assets/js/main.js', ELEMENTOR_ASSIGNMENT ), array(), wp_rand(), true );

		wp_enqueue_script( 'assignment_js' );
		wp_enqueue_style( 'assignment_css' );
	}

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'assignment';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Assignment', 'elementor-assignment' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'fa fa-snowflake-o';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'basic' );
	}

	/**
	 * Enqueue styles.
	 */
	public function get_style_depends() {
		return array( 'assignment_css' );
	}

	/**
	 * Enqueue script.
	 */
	public function get_script_depends() {
		return array( 'assignment_js' );
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _register_controls() { // phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore
		$this->start_controls_section(
			'section_content',
			array(
				'label' => __( 'Content', 'elementor-assignment' ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'   => __( 'Title', 'elementor-assignment' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Title', 'elementor-assignment' ),
			)
		);

		$this->add_control(
			'description',
			array(
				'label'   => __( 'Description', 'elementor-assignment' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => __( 'Description', 'elementor-assignment' ),
			)
		);

		$this->add_control(
			'content',
			array(
				'label'   => __( 'Content', 'elementor-assignment' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => __( 'Content', 'elementor-assignment' ),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_inline_editing_attributes( 'title', 'none' );
		$this->add_inline_editing_attributes( 'description', 'basic' );
		$this->add_inline_editing_attributes( 'content', 'advanced' );
		// phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped
		?>
		<h2 class="box__title" <?php echo $this->get_render_attribute_string( 'title' ); ?>> 
			<?php echo wp_kses( $settings['title'], array() ); ?>
		</h2>
		<div class="box__description" <?php echo $this->get_render_attribute_string( 'description' ); ?>> 
			<?php echo wp_kses( $settings['description'], array() ); ?>
		</div>
		<div class="box__content" <?php echo $this->get_render_attribute_string( 'content' ); ?>> 
			<?php echo wp_kses( $settings['content'], array() ); ?>
		</div>
		<?php
	}

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _content_template() { // phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore
		?>
		<#
		view.addInlineEditingAttributes( 'title', 'none' );
		view.addInlineEditingAttributes( 'description', 'basic' );
		view.addInlineEditingAttributes( 'content', 'advanced' );
		#>
		<h2 class="box__title" {{{ view.getRenderAttributeString( 'title' ) }}}>{{{ settings.title }}}</h2>
		<div class="box__description" {{{ view.getRenderAttributeString( 'description' ) }}}>{{{ settings.description }}}</div>
		<div class="box__content" {{{ view.getRenderAttributeString( 'content' ) }}}>{{{ settings.content }}}</div>
		<?php
	}
}
