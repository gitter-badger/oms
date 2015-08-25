(function (jsOMS, undefined) {
    jsOMS.Modules.Media.Models.Upload = function (responseManager) {
        this.responseManager = responseManager;
        this.success = [];

        this.uri = '';
        this.allowedTypes = [];
        this.maxFileSize = 0;
        this.files = [];
    };

    jsOMS.Modules.Media.Models.Upload.setUri = function (uri) {
        this.uri = uri;
    };

    jsOMS.Modules.Media.Models.Upload.setAllowedTypes = function (allowed) {
        this.allowedTypes = allowed;
    };

    jsOMS.Modules.Media.Models.Upload.addAllowedType = function (allowed) {
        this.allowedTypes.push(allowed);
    };

    jsOMS.Modules.Media.Models.Upload.setMaxFileSize = function (size) {
        this.maxFileSize = size;
    };

    jsOMS.Modules.Media.Models.Upload.addFile = function (file) {
        this.files.push(file);
    };

    jsOMS.Modules.Media.Models.Upload.upload = function () {
        // TODO: validate file type + file size

        var request = new jsOMS.Request(),
            formData = new FormData();

        this.files.forEach(function (element, index) {
            formData.append('file', element);
        });

        request.setData(element);
        request.setType('raw');
        request.setUri(this.uri);
        request.setMethod('POST');
        request.setRequestHeader('X_FILENAME', element.path);
        request.setSuccess(function (xhr) {
            console.log(xhr); // TODO: remove this is for error checking
            var o = JSON.parse(xhr.response),
                response = Object.keys(o).map(function (k) {
                    return o[k]
                });

            for (var k = 0; k < response.length; k++) {
                if (response[k] !== null) {
                    if (!self.success[e.id]) {
                        self.responseManager.execute(response[k].type, response[k]);
                    } else {
                        self.success[e.id](response[k].type, response[k]);
                    }
                }
            }
        });
        request.send();
    };
}(window.jsOMS = window.jsOMS || {}));