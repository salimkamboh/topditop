$('.ui.dropdown').dropdown({
    onAdd: function (selectedValue, selectedText, $selectedItem) {
        filterReferences(selectedValue);
    },
    onRemove: function (removedValue, removedText, $removedChoice) {
        filterReferencesDeleted(removedValue);
    }
});

var searchObject = {
    brandParams: []
};

function filterReferencesDeleted(text) {

    for (var i = searchObject.brandParams.length - 1; i >= 0; i--) {
        if (searchObject.brandParams[i] === text) {
            searchObject.brandParams.splice(i, 1);
        }
    }

    performFilter();
}

/**
 *
 * @param text
 */
function filterReferences(text) {
    searchObject.brandParams.push(text);
    performFilter();
}

$('.clear-filter').on('click', function () {
    $('.ui.dropdown').dropdown('restore defaults');
    searchObject = {
        brandParams: []
    };
    performFilter();
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
        storeList = response;
        var html = '';
        $.each(storeList, function (index, item) {
            if (item.slide != null && item.slide != undefined)
                var imageUrl = item.slide.image_url;
            else
                var imageUrl = item.image.url;

            html += '<div class="col-md-6">' +
                '<div class="single-item item-shadow">' +
                '<img alt="" class="img-responsive" src="' + item.image + '">' +
                '<div class="item-info">' +
                '<div class="item-info-top clearfix">' +
                '<div class="width-fix">' +
                '<span class="title">' +
                '<a href="' + _globalRoute + '/' + _globalLang + '/front/references/single/' + item.id + '">' + item.title + '</a>' +
                '</span>' +
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

        $(".list-all-brands").empty().append(html);
    }

    connector.getData("POST", $("form.filter-multi").attr("action"), "json", dataToSend, callBackFunction, "");
}

$(document).on('click', '.show-ref-newest', function () {
    $(".references-ref-newest").removeClass('hidden-block');
    $(".references-ref-most").addClass('hidden-block');
    $('.show-ref-most').removeClass('active');
    $(this).addClass('active');
});

$(document).on('click', '.show-ref-most', function () {
    $(".references-ref-newest").addClass('hidden-block');
    $(".references-ref-most").removeClass('hidden-block');
    $('.show-ref-newest').removeClass('active');
    $(this).addClass('active');
});