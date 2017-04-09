var Slides = function(containerSelector) {
    this.containerSelector = containerSelector || 'body';
}

Slides.prototype = {
    /**
     * Init animation
     */
    listen: function() {
        // init container elements
        this.$container = $(this.containerSelector);

        // listen scroll events
        $(window).scroll(_.debounce(
            function() {
                this.changeAnimatedState();
            }.bind(this),
            100
        ));

        // initial change of animated state
        this.changeAnimatedState();
    },

    /**
     * Handle state
     */
    changeAnimatedState: function()
    {
        var scrollTop = $(window).scrollTop(),
            windowHeight = $(window).height(),
            $animatedElements = $('.transition', this.$container);

        for (var i = 0; i < $animatedElements.length; i++) {
            var $el = $animatedElements.eq(i);
            var elTop = $el.offset().top;
            var elBottom = elTop + $el.height();

            if (elBottom < scrollTop || elTop > (scrollTop + windowHeight)) {
                if ($el.hasClass('animated')) {
                    $el.removeClass('animated');
                }
                continue;
            }

            if (!$el.hasClass('animated')) {
                $el.addClass('animated');
            }
        }
    }
};