$('.ui.dropdown').dropdown({
    onAdd: function (selectedValue, selectedText, $selectedItem) {
        filterProducts(selectedValue);
    },
    onRemove: function (removedValue, removedText, $removedChoice) {
        filterProductsDeleted(removedValue);
    }
});


var searchObject = {
    brandParams: []
};

/**
 * @param text
 */
function filterProducts(text) {
    searchObject.brandParams.push(text);
    searchObject.searchParams = $('#product_search_term').val().trim();
    performFilter();
}

$('.clear-filter').on('click', function () {
    $('.ui.dropdown').dropdown('restore defaults');
    searchObject = {
        brandParams: []
    };
    performFilter();
});

$('#product_search_term').on('keyup', function () {
    searchObject.searchParams = $(this).val().trim();
    performFilter();
});

function performFilter() {

    var dataToSend = {
        searchObject: searchObject,
        _token: $("[name='_token']").val()
    };

    function callBackFunction(context, response) {
        productList = response;
        var html = '';
        $.each(productList, function (index, item) {
            html += '<div class="col-md-6">' +
                '<div class="single-item item-shadow">' +
                '<img alt="" class="img-responsive" src="' + item.image + '">' +
                '<div class="item-info">' +
                '<div class="item-info-top clearfix">' +
                '<div class="width-fix">' +
                '<span class="title">' + item.title + '</span>' +
                '<span class="number-of pull-left">(' + item.references + ' references)</span>' +
                '</div>' +
                '<span class="price"><i class="icon-eur"></i>' + item.price + '</span>' +
                '</div>' +
                '<div class="item-info-bottom">' +
                '<a href="#" class="pull-left separator-bottom"><i class="icon-tags"></i>' + item.manufacturer_name + '</a>' +
                '<div class="clearfix"></div>' +
                '</div>' +
                '<a href="' + _globalRoute + '/' +_globalLang +'/dashboard/products/edit/' + item.id + '" class="click-button">'+Lang.get("messages.manage_product_js")+'</a>' +
                '<a href="#" class="click-button">'+Lang.get("messages.delete_product")+'</a>' +
                '</div>' +
                '</div>' +
                '</div>';
        });

        $(".list-all-products").empty().append(html);
    }

    connector.getData("POST", $("form#products-filter").attr("action"), "json", dataToSend, callBackFunction, "");
}

/**
 * @param text
 */
function filterProductsDeleted(text) {
    for (var i = searchObject.brandParams.length - 1; i >= 0; i--) {
        if (searchObject.brandParams[i] === text) {
            searchObject.brandParams.splice(i, 1);
        }
    }
    performFilter();
}