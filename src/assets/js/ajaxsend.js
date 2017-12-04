var ajaxSend;

function AjaxSend(ajaxSelectors) {
    var selectors = ajaxSelectors;

    function init() {
        addListeners(selectors, true);
    }

    var sendAjax = function (element, url) {
        $.ajax({
            type: element.method ? element.method : 'GET',
            url: url
        }).done(function (data) {
            if (typeof element.afterSend === 'function') {
                element.afterSend(data);
            }
        });
    };

    function addListeners(elements, skipCheck) {
        elements.forEach(function (element) {
            if (skipCheck || !hasSelector(selectors, element.selector)) {
                $("body").on("" + element.trigger, "" + element.selector, function (e) {
                    e.preventDefault();
                    var url = "";
                    if (element.url) {
                        url = element.url;
                    } else {
                        element.urlAttribute ? $(this).attr("" + element.urlAttribute) : $(this).attr('href');
                    }
                    sendAjax(element, url);
                });
            }
        });
    }

    function hasSelector(allSelectors, selector) {
        var filteredSelectors = allSelectors.filter(function (formSelector) {
            return formSelector.selector === selector;
        });
        return filteredSelectors.length > 0;
    }


    this.addSelector = function (newSelectors) {
        addListeners(newSelectors);
        selectors = selectors.concat(newSelectors);
    };
    init();
}