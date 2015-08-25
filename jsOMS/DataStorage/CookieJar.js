(function (jsOMS, undefined) {
    jsOMS.CookieJar = function () {
    };

    /**
     * Saving data to cookie
     *
     * @param cName Cookie name
     * @param value Value to save
     * @param exdays Lifetime for the cookie
     * @param domain Domain for the cookie
     * @param path Path for the cookie
     *
     * @return array
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    jsOMS.CookieJar.prototype.setCookie = function (cName, value, exdays, domain, path) {
        var exdate = new Date();
        exdate.setDate(exdate.getDate() + exdays);
        var cValue = encodeURI(value) + ((exdays === null) ? "" : "; expires=" + exdate.toUTCString()) + ";domain=" + domain + ";path=" + path;
        document.cookie = cName + "=" + cValue;
    };

    /**
     * Loading cookie data
     *
     * @param cName Cookie name
     *
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    jsOMS.CookieJar.prototype.getCookie = function (cName) {
        var cValue = document.cookie;
        var cStart = cValue.indexOf(" " + cName + "=");

        if (cStart === -1) {
            cStart = cValue.indexOf(cName + "=");
        }

        if (cStart === -1) {
            cValue = null;
        } else {
            cStart = cValue.indexOf("=", cStart) + 1;
            var cEnd = cValue.indexOf(";", cStart);

            if (cEnd === -1) {
                cEnd = cValue.length;
            }

            cValue = decodeURI(cValue.substring(cStart, cEnd));
        }
        return cValue;
    };
}(window.jsOMS = window.jsOMS || {}));
