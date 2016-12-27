$('.ui.dropdown').dropdown({
    onAdd: function (selectedValue, selectedText, $selectedItem) {
        filterReferences(selectedValue, $(this).data('filter'));
    },
    onRemove: function (removedValue, removedText, $removedChoice) {
        filterReferencesDeleted(removedValue, $(this).data('filter'));
    }
});


var searchObject = {
    storeParams: [],
    brandParams: []
};

/**
 *
 * @param text
 * @param filterType
 */
function filterReferences(text, filterType) {
    console.log(filterType);
    switch (filterType) {
        case 'store':
            searchObject.storeParams.push(text);
            break;
        case 'brand':
            searchObject.brandParams.push(text);
            break;
        default:
            console.log('what?');

    }
    performFilter();
}

$('.clear-filter').on('click', function () {
    $('.ui.dropdown').dropdown('restore defaults');
});

/**
 *
 */
function performFilter() {

    var dataToSend = {
        searchObject: searchObject,
        _token: $("[name='_token']").val()
    };

    function callBackFunction(context, response) {
        referenceList = response;
        var html = '';
        $.each(referenceList, function (index, item) {
            var titleLink = '';
            if (item.package_name != 'TopDiTop Store')
                titleLink = '<span class="title">' + item.title + '</span>';
            else
                titleLink = '<span class="title">' +
                    '<a href="' + _globalRoute + '/' + _globalLang + '/front/references/single/' + item.id + '">' + item.title + '</a>' +
                    '</span>';

            html += '<div class="col-md-6">' +
                '<div class="single-item item-shadow">' +
                '<img alt="" class="img-responsive" src="' + item.image + '">' +
                '<div class="item-info">' +
                '<div class="item-info-top clearfix">' +
                '<div class="width-fix">' +
                titleLink +
                '<span class="number-of pull-left">(' + item.numImages + ' ' + item.scenes + ')</span>' +
                '</div>' +
                '<span class="date pull-right">' + item.date + '</span>' +
                '</div>' +
                '<div class="item-info-bottom">' +
                '<a href="' + _globalRoute + '/' + _globalLang + '/front/references/single/' + item.id + '"><i' +
                'class="icon-shopping-cart"></i>' + item.package_name + ' : ' + item.store_name + ' </a>' +
                '<a class="shareBtn" href="' + _globalRoute + '/' + _globalLang + '/front/references/single/' + item.id + '">+ Share</a>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>';
        });

        $(".list-all-references").empty().append(html);
    }

    connector.getData("POST", $("form.filter-multi").attr("action"), "json", dataToSend, callBackFunction, "");
}

function filterReferencesDeleted(text, filterType) {

    switch (filterType) {
        case 'store':
            for (var i = searchObject.storeParams.length - 1; i >= 0; i--) {
                if (searchObject.storeParams[i] === text) {
                    searchObject.storeParams.splice(i, 1);
                }
            }
            break;
        case 'brand':
            for (var i = searchObject.brandParams.length - 1; i >= 0; i--) {
                if (searchObject.brandParams[i] === text) {
                    searchObject.brandParams.splice(i, 1);
                }
            }
            break;

        default:
            console.log('what?');

    }

    console.log(searchObject);

    performFilter();
}