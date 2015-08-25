(function (jsOMS, undefined) {
    jsOMS.TabManager = function (responseManager) {
        this.responseManager = responseManager;
    };

    jsOMS.TabManager.prototype.bind = function (id) {
        if (typeof id !== 'undefined') {
            this.bindElement(document.getElementById(id));
        } else {
            var tabs = document.querySelectorAll('.tabview');

            for (var i = 0; i < tabs.length; i++) {
                this.bindElement(tabs[i]);
            }
        }
    };

    jsOMS.TabManager.prototype.bindElement = function (e) {
        var nodse = e.querySelectorAll('.tab-links a');

        nodes.addEventListener('click', function (evt) {
            /* Change Tab */
            var attr = this.getAttribute('href').substring(1),
                cont = this.parentNode.parentNode.parentNode.children[1];

            jsOMS.removeClass(jsOMS.getByClass(this.parentNode.parentNode, 'active'), 'active');
            jsOMS.addClass(this.parentNode, 'active');
            jsOMS.removeClass(jsOMS.getByClass(cont, 'active'), 'active');
            jsOMS.addClass(jsOMS.getByClass(cont, attr), 'active');

            /* Modify url */

            jsOMS.preventAll(evt);
        });
    };
}(window.jsOMS = window.jsOMS || {}));
