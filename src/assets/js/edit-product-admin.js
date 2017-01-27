$.noConflict();
(function ($) {

    _globalRoute = 'http://topditop.foundcenter.com';

    connector = {
        getData: function (methodType, route, dataType, dataBlock, callbackFunction, context) {
            return $.ajax({
                async: true,
                type: methodType,
                dataType: dataType,
                url: route,
                data: dataBlock
            }).then(function (data) {
                if (callbackFunction != null && context != null) {
                    callbackFunction(context, data);
                }
                return data;
            });
        }
    };

    var activeProductId = $(".holder_product_id").val();

    var referenceProductsExisting = null;

    /**
     *
     * @param url
     * @private
     */
    function _getProducts(url) {

        function callBackFunction(context, response) {
            referenceProductsExisting = response;
            $.each(referenceProductsExisting, function (index, item) {
                var imageUrl = '';
                if (item.url != undefined)
                    imageUrl = item.url;

                var htmlForm =
                    '<div style="padding:10px;border-bottom:1px solid #ccc; margin-bottom:10px;">' +
                    '<br>' +
                    '<img src="' + imageUrl + '" style="width:300px; height:auto;">' +
                    '<br>' +
                    '<button type="button" data-productid="' + activeProductId + '" data-imageid="' + item.id + '" class="remove-item">remove</button>' +
                    '</div>';
                $('.products-holder-all').append(htmlForm);
            });
        }

        connector.getData("GET", url, "json", null, callBackFunction, "");
    }

    _getProducts('http://topditop.foundcenter.com/api/products/' + activeProductId + '/images');

    $(document).on('click', '.products-holder-all .remove-item', function () {
        var imageObject = {
            'productId': $(this).data('productid')
        };

        function callBackFunction(context, response) {
            if (response.code == 200) {
                context.parent().remove();
            }
        }

        connector.getData("POST", _globalRoute + '/api/products/images/delete/' + $(this).data('imageid'), "json", imageObject, callBackFunction, $(this));
    });

})(jQuery);