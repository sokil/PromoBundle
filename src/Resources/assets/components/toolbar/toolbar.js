var Toolbar = function(selector, options) {
    this.selector = selector;
    this.options = $.extend(
        {
            position: 'relative'
        },
        options
    );
};

Toolbar.prototype = {
    /**
     * Init animation
     */
    listen: function() {
        // init container elements
        this.$toolbar = $(this.selector)
            .addClass('toolbar toolbar--' + this.options.position);

        this.initialToolbarTop = this.$toolbar.offset().top;

        // listen scroll events
        $(window).scroll(_.debounce(
            function() {
                this.changeState();
            }.bind(this),
            50
        ));

        // initial change of animated state
        this.changeState();
    },

    changeState: function() {
        var scrollTop = $(window).scrollTop();
        var windowHeight = $(window).height();

        var isToolbarFixed = this.initialToolbarTop <= scrollTop || this.initialToolbarTop >= (scrollTop + windowHeight);

        this.$toolbar.toggleClass(
            'toolbar--fixed',
            isToolbarFixed
        );
    }
};