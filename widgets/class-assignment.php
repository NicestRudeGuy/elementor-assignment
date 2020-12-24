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

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Utils;

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
	protected function _register_controls() {    // phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore
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
				'default' => __( 'Title of this accordian', 'elementor-assignment' ),
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'heading',
			array(
				'label' => __( 'Heading', 'elementor-assignment' ),
				'type'  => Controls_Manager::TEXT,
			)
		);

		$repeater->add_control(
			'button_name',
			array(
				'label' => __( 'Button Name', 'elementor-assignment' ),
				'type'  => Controls_Manager::TEXT,
			)
		);

		$repeater->add_control(
			'button_url',
			array(
				'label' => __( 'Button Url', 'elementor-assignment' ),
				'type'  => Controls_Manager::URL,
			)
		);

		$repeater->add_control(
			'description',
			array(
				'label' => __( 'Description', 'elementor-assignment' ),
				'type'  => Controls_Manager::TEXTAREA,
			)
		);

		$repeater->add_control(
			'image',
			array(
				'label' => __( 'Image', 'elementor-assignment' ),
				'type'  => Controls_Manager::MEDIA,
			)
		);

		$this->add_control(
			'list',
			array(
				'label'       => __( 'Repeater List', 'elementor-assignment' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'heading'     => __( 'Lorem ipsum dolor sit amet', 'elementor-assignment' ),
						'button_name' => __( 'Lorem ipsum dolor', 'elementor-assignment' ),
						'button_url'  => array(
							'url' => __( 'https://www.yourlink.com', 'elementor-assignment' ),
						),
						'description' => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing aliquip ex ea commodo consequat. ', 'elementor-assignment' ),
						'image'       => array(
							'url' => Utils::get_placeholder_image_src(),
						),
					),
				),
				'title_field' => '{{{ heading }}}', // phpcs:ignore WordPressVIPMinimum.Security.Mustache.OutputNotation
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
		?>
		<div class="accordian">
			<div class="accordian__item">
				<div class="accordian__section">
				<div class="accordian__title">
		<?php echo esc_html( $settings['title'] ); ?>
		</div>
				<?php
				foreach ( $settings['list'] as $key => $item ) {
					?>
					<div class="accordian__heading <?php echo ( 0 === $key ) ? 'active' : ''; ?>" >
					<?php echo esc_html( $item['heading'] ); ?>
					</div>
					<?php
				}
				?>
				</div>
				<div class="accordian__section">
					<div class="accordian__section-b">
						<?php
						foreach ( $settings['list'] as $key => $item ) {
							?>
						<div class="accordian__content  <?php echo ( 0 === $key ) ? 'active' : ''; ?>">
							<div class="accordian__description">
							<?php echo esc_html( $item['description'] ); ?>
							</div>
							<a class="accordian__button" href="<?php echo esc_url( $item['button_url']['url'] ); ?>" > 
							<?php echo esc_html( $item['button_name'] ); ?>
							</a>
						</div>
							<?php
						}
						?>
					</div>
				</div>
				<div class="accordian__section">
					<div class="accordian__section-c">
						<?php
						foreach ( $settings['list'] as $key => $item ) {
							?>
							<img class="accordian__image <?php echo ( 0 === $key ) ? 'active' : ''; ?>" src="<?php echo esc_url( $item['image']['url'] ); ?>" />
							<?php
						}
						?>
					</div>
				</div>
			</div>
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
	protected function _content_template() {  // phpcs:ignore PSR2.Methods.MethodDeclaration.Underscore 
		?>
		<#
		if ( settings.list ){
		#>
		<div class="accordian">
			<div class="accordian__item">
				<div class="accordian__section">
				<div class="accordian__title">
				{{settings.title}} 
				</div>
				<#  settings.list.map((item, index) => {
					if( 0 === index ) {
					#><div class="accordian__heading active"> 
					{{item.heading}}
					</div><#
					} else {
					#>
					<div class="accordian__heading">
					{{item.heading}} 
					</div><#
				}
				})#>

				</div>
				<div class="accordian__section">
					<div class="accordian__section-b">

						<div class="accordian__content active">
							<div class="accordian__description">
							{{settings.list[0].description}}
							</div>
							<a class="accordian__button" href="{{settings.list[0].button_url.url}}" > 
							{{settings.list[0].button_name}} 
							</a>
						</div>

					</div>
				</div>
				<div class="accordian__section">
					<div class="accordian__section-c">

							<img class="accordian__image active" src="{{settings.list[0].image.url}}" /> 
					</div>
				</div>
			</div>
		</div>
		<# } #>
		<?php
	}
}
