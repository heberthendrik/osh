var App = {
    listeners: function listeners() {
        $('a.btn-delete').on('click', function () {
            var $this = $(this),
                message = $this.data('message') || '';

            if (confirm(message) == true) {
                $this.closest('form').submit();
            }
        });
    },
    init: function init() {
        this.listeners();
    }
};

App.init();