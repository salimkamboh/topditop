$('.ui.dropdown').dropdown({
    onAdd: function (selectedValue, selectedText, $selectedItem) {
        filterProducts(selectedValue, $(this).data('filter'));
    },
    onRemove: function (removedValue, removedText, $removedChoice) {
        filterProductsDeleted(removedValue, $(this).data('filter'));
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
function filterProducts(text, filterType) {
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
    searchObject = {
        storeParams: [],
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
            html +=
                '<div class="col-md-6">' +
                '<div class="single-item single-item-product item-shadow" data-product-id="' + item.id + '">' +
                '<a href="' + _globalRoute + '/' + _globalLang + '/front/stores/' + item.store.id + '">'+
                '<img alt="" class="img-responsive" src="' + item.image + '">' +
                '</a>'+
                '<div class="item-info">' +
                '<div class="item-info-top clearfix">' +
                '<div class="width-fix">' +
                '<span class="title"><a href="javascript:void(0)" data-product-id="' + item.id + '">' + item.title + '</a></span>' +
                '<span class="number-of pull-left">(' + item.references + ' references)</span>' +
                '</div>' +
                '<span class="price"><i class="icon-eur"></i>' + item.price + '</span>' +
                '</div>' +
                '<div class="item-info-bottom">' +
                '<a href="' + _globalRoute + '/' + _globalLang + '/front/stores/' + item.store.id + '"><i class="icon-shopping-cart"></i>' + item.package_name + ' : ' + item.store_name + '</a>' +
                '<a href="'+ _globalRoute + '/' + _globalLang + '/front/brand/' + item.manufacturer_id + '/stores/' + '" class="pull-left"><i class="icon-tags"></i> ' + item.manufacturer_name + ' </a>' +
                '<a class="shareBtn" href="javascript:void(0)">+ Share</a>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>';
        });

        $(".list-all-products").empty().append(html);
    }

    connector.getData("POST", $("form#frontmultifilterproducts").attr("action"), "json", dataToSend, callBackFunction, "");
}

/**
 * @param text
 */
function filterProductsDeleted(text, filterType) {
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
    performFilter();
}