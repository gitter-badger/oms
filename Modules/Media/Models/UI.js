(function (jsOMS, undefined) {
    jsOMS.Modules.Media.Models.UI = function (responseManager, formManager) {
        this.ignore = [];
        this.formManager = formManager;

        this.formManager.injectSubmit('input[type=file]', this.upload);
        this.formManager.injectSubmit('.dragndrop', this.upload);
    };

    jsOMS.FormManager.prototype.ignore = function (id) {
        this.ignore.push(id);
    };

    jsOMS.FormManager.prototype.validateFormElement = function (e) {
    };

    jsOMS.Modules.Media.Models.Ui.upload = function () {

    };

    jsOMS.Modules.Media.Models.Ui.dragndrop = function () {

    };
}(window.jsOMS = window.jsOMS || {}));