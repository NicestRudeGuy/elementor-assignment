
class Assignment extends elementorModules.frontend.handlers.Base {

	/**
	 * This method is used to add any custom settings to be used in the widget’s JS handler.
	 *
	 * @return {{selectors: {testButton: string, container: string}}}
	 */
	getDefaultSettings() {
		return {
			selectors: {
				heading: '.accordian__heading',
                content: '.accordian__content',
                button: '.accordian__button',
                image: '.accordian__image'
			}
		};
	}

	/**
	 * This method is used to create jQuery objects of the HTML elements targeted by the JS handler.
	 *
	 * @return {{$testButton: *, $container: *}}
	 */
	getDefaultElements() {
		const selectors = this.getSettings( 'selectors' );

		return {
			$heading: this.$element.find( selectors.heading ),
            $content: this.$element.find( selectors.content ),
            $button: this.$element.find( selectors.button ),
            $image: this.$element.find( selectors.image ),
		};
	}

	/**
	 * This method is used to add event listeners for widget-related events.
	 *
	 * @return {void}
	 */
	bindEvents() {

		this.elements.$heading.on( 'click', this.handleClicks.bind( this ) );

	}

	/**
	 * Handle Click.
	 *
	 * @param {Object} event Event Object.
	 */
	handleClicks( event ) {

		event.preventDefault();
        this.elements.$content.toggleClass( 'active' );
        this.elements.$button.toggleClass( 'active' );
        this.elements.$image.toggleClass( 'active' );
	}

}

/**
 * Registering the Widget Handler with Elementor
 */
jQuery( window ).on(
	'elementor/frontend/init',
	() => {

		const AssignmentHandler = ( $element ) => {

			elementorFrontend.elementsHandler.addHandler(
				Assignment,
				{
					$element
				}
			);

		};

		elementorFrontend.hooks.addAction(
			'frontend/element_ready/assignment_js.default',
			AssignmentHandler
		);
	}
);