/*
 * Handle special case link and button clicks. 
 * This is usefull in order to support ajax calls and dynamic page changes without reloads
 */
var nodes = document.querySelectorAll('a, button, input[type=submit]');
jsOMS.each(nodes, function (ele) {
    jsOMS.listenEvent(ele, 'click', function (evt, e) {
        if (!e.hasAttribute('data-request') || !e.hasAttribute('data-http')) {
            return true;
        }

        // TODO: create request object

        var requestType = e.getAttribute('data-request'),
            httpType = e.getAttribute('data-http'),
            requestUri = '',
            requestData = e.getAttribute('data-json');

        if (requestType === 'URL') {
            requestUri = e.getAttribute('href');
        } else {
            requestUri = e.getAttribute('data-uri');
        }

        jsOMS.ajax({
            type: httpType,
            url: URL + requestUri,
            data: requestData,
            requestHeader: "application/json; charset=utf-8",
            responseType: "text",
            success: function (ret) {
                console.log(ret);
            },
            error: function (ret) {
                console.log('error');
            }
        });

        evt.preventDefault();
        return false;
    });
});
