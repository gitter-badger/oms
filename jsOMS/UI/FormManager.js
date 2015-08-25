(function (jsOMS, undefined) {
    jsOMS.FormManager = function (responseManager) {
        this.responseManager = responseManager;
        this.ignore = [];
        this.success = [];
        this.injectSelector = [];
    };

    jsOMS.FormManager.prototype.ignore = function (id) {
        this.ignore.push(id);
    };

    jsOMS.FormManager.prototype.injectSubmit = function (selector, callback) {
        if (!(selector in this.injectSelector)) {
            this.injectSelector[selector] = callback;
            return true;
        }

        return false;
    };

    jsOMS.FormManager.prototype.setSuccess = function (id, callback) {
        this.success[id] = callback;
    };

    jsOMS.FormManager.prototype.bind = function (id) {
        if (typeof id !== 'undefined' && this.ignore.indexOf(id) == -1) {
            this.bindElement(document.getElementById(id));
        } else {
            var forms = document.getElementsByTagName('form');

            for (var i = 0; i < forms.length; i++) {
                if (this.ignore.indexOf(forms[i].id == -1)) {
                    this.bindElement(forms[i]);
                }
            }
        }
    };

    jsOMS.FormManager.prototype.validateFormElement = function (e) {
        /** Validate on change */
        if (typeof e.dataset.validate !== 'undefined') {
            if (!(new RegExp(e.dataset.validate)).test(e.value)) {
                return false;
            }
        }

        return true;
    };

    jsOMS.FormManager.prototype.bindElement = function (e) {
        var input = e.getElementsByTagName('input'),
            select = e.getElementsByTagName('select'),
            textarea = e.getElementsByTagName('textarea'),
            datalist = e.getElementsByTagName('datalist'),
            buttons = e.getElementsByTagName('button'),
            submits = e.querySelectorAll('input[type=submit]'),
            formelements = Array.prototype.slice.call(input).concat(Array.prototype.slice.call(select), Array.prototype.slice.call(textarea), Array.prototype.slice.call(datalist)),
            self = this;

        for (var j = 0; j < submits.length; j++) {
            submits[j].addEventListener('click', function (event) {
                var validForm = true,
                submitdata = {};

                /* Handle injection */
                self.injectSelector.forEach(function (callback, selector, arr) {
                    var selection = e.querySelectorAll(selector);

                    if (selection.length > 0) {
                        callback(e, selection);
                    }
                });

                /* Validating + assigning values */
                for (var k = 0; k < formelements.length; k++) {
                    if (!self.validateFormElement(e)) {
                        validForm = false;
                        // TODO: maybe jump out here since invalid and the elements get checked on changed by default
                        // will this change in the future? if yes then I need to check all and also add markup/styles here
                    }

                    submitdata[formelements[k].getAttribute('name')] = formelements[k].value;
                }

                if(typeof this.dataset.formfields !== 'undefined') {
                    try {
                        var formdata = JSON.parse(this.dataset.formfields);

                        Object.keys(formdata).forEach(function(key) {
                            if(formdata[key].startsWith('.') || formdata[key].startsWith('#')) {
                                var formElement = document.querySelector(formdata[key]);

                                if(formElement.type === 'checkbox') {
                                    submitdata[key] = formElement.checked;
                                } else {
                                    submitdata[key] = formElement.value;
                                }
                            }
                        });
                    } catch(e) {
                    }
                }

                if (validForm) {
                    var request = new jsOMS.Request();
                    request.setData(submitdata);
                    request.setType('json');
                    request.setUri(e.action);
                    request.setMethod(e.method);
                    request.setRequestHeader('Content-Type', 'application/json');
                    request.setSuccess(function (xhr) {
                        console.log(xhr); // TODO: remove this is for error checking
                        try {
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
                        } catch (e) {
                            console.log('No valid json');
                            return false;
                        }
                    });
                    request.send();
                }

                jsOMS.preventAll(event);
            });
        }

        /** Handle input */
        for (var i = 0; i < input.length; i++) {
            /** Validate on change */
            if (typeof input[i].dataset.validate !== 'undefined') {
                var validator = new RegExp(input[i].dataset.validate);

                input[i].onkeyup = function (e) {
                    var self = this;
                    jsOMS.watcher(function (e) {
                        if (!validator.test(self.value)) {
                            jsOMS.addClass(self, 'invalid');
                            console.log('wrong input:' + i);
                        }
                    }, 500);
                };
            }

            /** Request on change */
            if (typeof input[i].dataset.request !== 'undefined') {
                // handle request during typing
            }
        }

        /** Handle select */
        for (var i = 0; i < select.length; i++) {
            /** Redirect on change */
            if (typeof select[i].dataset.redirect !== 'undefined') {
                select[i].onchange = function () {
                    // TODO: use URI factory (which i still have to create :))
                    window.document.href = e.action.replace('{' + select[i].dataset.redirect + '}', select[i].value);
                };
            }
        }

        /** Handle button */
        for (var i = 0; i < buttons.length; i++) {
            /** Redirect in new window on click */
            if (typeof buttons[i].dataset.ropen !== 'undefined' || typeof buttons[i].dataset.redirect !== 'undefined') {
                buttons[i].addEventListener('click', function (event) {
                    var ropen = typeof this.dataset.ropen !== 'undefined' ? this.dataset.ropen : this.dataset.redirect,
                        matches = ropen.match(new RegExp("\{[#\?\.a-zA-Z0-9]*\}", "gi")),
                        current = jsOMS.Uri.parse_url(window.location.href),
                        value = null;

                    // TODO: find a way to use existing query parameters as well and just overwrite them if defined differently here
                    // eg. use &? in dummy urls to indicate that the url should use existing query parameters as well if not overwritten
                    for (var j = 0; j < matches.length; j++) {
                        var match = matches[j].substring(1, matches[j].length - 1);
                        if (match.indexOf('#') === 0) {
                            value = document.getElementById(match.substring(1, match.length)).value;
                        } else if (match.indexOf('.') === 0) {

                        } else if (match.indexOf('?') === 0) {
                            value = jsOMS.Uri.getUriQueryParameter(current.query, match.substring(1, match.length));
                        }

                        ropen = ropen.replace(matches[j], value);
                    }

                    if (typeof this.dataset.ropen !== 'undefined') {
                        var win = window.open(ropen, '_blank');
                        win.focus();
                    } else {
                        window.document.href = ropen;
                    }
                });
            } else if (jsOMS.hasClass(buttons[i], 'form-list') && buttons[i].dataset.name !== 'undefined') {
                // TODO: maybe use id here instead? then this needs to get changed in the form builder
                var input = document.querySelector('input[name=' + buttons[i].dataset.name + ']'),
                    list = document.querySelector('ul[data-name=l-' + buttons[i].dataset.name + ']'),
                    hidden = document.querySelector('input[type=hidden][name=h-' + buttons[i].dataset.name + ']');

                buttons[i].addEventListener('click', function (event) {
                    // TODO: maybe validate input value??? if not done during typing

                    if (hidden.bind === undefined) {
                        hidden.bind = [];
                    }

                    hidden.bind.push(input.bind ? input.bind : input.value);
                    hidden.value = JSON.stringify(hidden.bind);

                    var element = document.createElement('li');
                    element.appendChild(document.createTextNode(input.value));
                    list.appendChild(element);
                });
            } else if (jsOMS.hasClass(buttons[i], 'form-table') && buttons[i].dataset.name !== 'undefined') {
                // TODO: maybe use id here instead? then this needs to get changed in the form builder
                var input = document.querySelector('input[name=' + buttons[i].dataset.name + ']'),
                    table = document.querySelector('table[data-name=l-' + buttons[i].dataset.name + ']'),
                    hidden = document.querySelector('input[type=hidden][name=h-' + buttons[i].dataset.name + ']');

                buttons[i].addEventListener('click', function (event) {
                    // TODO: maybe validate input value??? if not done during typing

                    if (hidden.bind === undefined) {
                        hidden.bind = [];
                    }

                    hidden.bind.push(input.bind ? input.bind : input.value);
                    hidden.value = JSON.stringify(hidden.bind);

                    // TODO: handle table add
                });
            }
        }
    }
}(window.jsOMS = window.jsOMS || {}));
