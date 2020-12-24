
(function ($) {
    const items = $('.accordian__heading');

    $(items).on('click', function () {
        const index = $(this).index() - 1;
        const parent = $(this).parents('.elementor-element').data('id');
        const parentClass = '.elementor-element-' + parent;
        const contents = $(parentClass).find('.accordian__content');
        const images = $(parentClass).find('.accordian__image');

        $(this).siblings().removeClass('active');
        $(this).addClass('active');

        const content = $($(contents)[index]);
        content.siblings().removeClass('active');
        content.addClass('active');

        const image = $($(images)[index]);
        image.siblings().removeClass('active');
        image.addClass('active');
    });

})(jQuery);
