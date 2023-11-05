$(document).ready(function () {
    // Initialize the dropdown
    $('.ui.dropdown').dropdown({
        onAdd: function (selectedValue, selectedText, $selectedItem) {
            filterProducts(selectedValue, $(this).data('filter'));
        },
        onRemove: function (removedValue, removedText, $removedChoice) {
            filterProductsDeleted(removedValue, $(this).data('filter'));
        }
    });

    // Manually trigger onAdd for the pre-set values
    var preSelectedValues = $('input[name="brand_filter"]').val().split(',');
    $.each(preSelectedValues, function (index, value) {
        var $item = $('.ui.dropdown .menu .item[data-value="' + value + '"]');
        console.log(index + ": " + index)
        console.log($item);
        var selectedText = $item.text();
        // $('.ui.dropdown').dropdown('set selected', value);
        $('#dropdown-brand').dropdown('set selected', value);
        console.log("selectedText: " + selectedText)
        // Assuming filterProducts is defined and handles the logic needed on adding a filter
        filterProducts(value, $('.ui.dropdown').data('filter'));
    });
});


var searchObject = {
    locationParams: [],
    brandParams: [],
    categoriesParams: [],
};

function filterProductsDeleted(text, filterType) {

    switch (filterType) {
        case 'location':
            for (var i = searchObject.locationParams.length - 1; i >= 0; i--) {
                if (searchObject.locationParams[i] === text) {
                    searchObject.locationParams.splice(i, 1);
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
        case 'categories':
            for (var i = searchObject.categoriesParams.length - 1; i >= 0; i--) {
                if (searchObject.categoriesParams[i] === text) {
                    searchObject.categoriesParams.splice(i, 1);
                }
            }
            break;

        default:
            console.log('what?');

    }

    console.log(searchObject);

    performFilter();
}

/**
 *
 * @param text
 * @param filterType
 */
function filterProducts(text, filterType) {

    switch (filterType) {
        case 'location':
            searchObject.locationParams.push(text);
            break;
        case 'brand':
            searchObject.brandParams.push(text);
            break;
        case 'categories':
            searchObject.categoriesParams.push(text);
            break;
        default:
            console.log('what?');
    }
    performFilter();
}

/**
 *
 */
function performFilter() {

    var dataToSend = {
        searchObject: searchObject,
        _token: $("[name='_token']").val()
    };

    function callBackFunction(context, stores) {
        var html = '';
        for (var i = 0; i < stores.length; i++) {
            var store = stores[i];
            var imageUrl = '/assets/img/topditop-missing-logo-image-xs.jpg';

            if (store.image !== null) {
                imageUrl = store.image.url;
            }


            html += '<div class="col-md-4">' +
                '<a href="' + _globalRoute + '/' + _globalLang + '/front/stores/' + store.id + '" class="single-item item-shadow">' +
                '<div class="store-image-holder"><img class="img-responsive" src="' + imageUrl + '"></div>' +
                '<div class="item-info show-info">' +
                '<div class="item-info-top clearfix">' +
                '<span class="title">' + store.store_name + '</span>' +
                '<span class="number-of pull-left">(' + store.numberReferences + ' ' + store.scenes + ')</span>' +
                '</div>' +
                '<div class="item-info-bottom">' +
                '<i class="fa fa-map-marker brown-color"></i><span>' + store.location.name + '</span>' +
                '<i class="fa fa-tag brown-color"></i><span>Kategorien: ' + store.categories.join(", ") + '</span>' +
                '</div>' +
                '</div>' +
                '</a>' +
                '</div>'
        }

        $(".list-all-stores").html(html);
        $(".list-all-stores-pagination").remove();
    }

    connector.getData("POST", $("form.filter-multi").attr("action"), "json", dataToSend, callBackFunction, "");
}

$('.clear-filter').on('click', function () {
    $('.ui.dropdown').dropdown('restore defaults');
});