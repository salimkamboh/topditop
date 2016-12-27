$.noConflict();
(function ($) {

    _globalRoute = 'http://topditop.foundcenter.com';

    connector = {
        getData: function (methodType, route, dataType, dataBlock, callbackFunction, context) {
            $.ajax({
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

    var referenceImagesExisting = null;
    var activeReferenceId = $(".holder_reference_id").val();

    /**
     *
     * @param url
     * @private
     */
    function _getImages(url) {

        function callBackFunction(context, response) {
            referenceImagesExisting = response;

            $.each(referenceImagesExisting, function (index, item) {
                var htmlForm = '<div style="padding:10px;border-bottom:1px solid #ccc; margin-bottom:10px;">' +
                    '<br>' +
                    //'<input id="image_' + index + '" name="image_' + index + '" type="file" class="input-file" value="' + item.url + '">' +
                    '<br><img src="' + item.url + '" style="width:300px; height:auto;"><br>' +
                    '<button type="button" data-refid="' + activeReferenceId + '" data-imageid="' + item.id + '" class="remove-item">remove</button>' +
                    '</div>';
                $('.image-holder-all').append(htmlForm);
            });
        }

        connector.getData("GET", url, "json", null, callBackFunction, "");
    }


    var referenceProductsExisting = null;

    // /**
    //  *
    //  * @param url
    //  * @private
    //  */
    // function _getProducts(url) {
    //
    //     function callBackFunction(context, response) {
    //         referenceProductsExisting = response;
    //
    //
    //         $.each(referenceProductsExisting, function (index, item) {
    //             var imageUrl = '';
    //             if (item.images.length > 0)
    //                 imageUrl = item.images[0].url;
    //
    //             var htmlForm = '<div style="padding:10px;border-bottom:1px solid #ccc; margin-bottom:10px;">' +
    //                 '<br>' +
    //                 '<input id="image_' + index + '" name="image_' + index + '" type="file" class="input-file" value="' + item.url + '">' +
    //                 '<br><img src="' + imageUrl + '" style="width:300px; height:auto;"><br>' +
    //                 '<button type="button" data-refid="' + activeReferenceId + '" data-productid="' + item.id + '" class="remove-item">remove</button>' +
    //                 '</div>';
    //             $('.products-holder-all').append(htmlForm);
    //         });
    //     }
    //
    //     connector.getData("GET", url, "json", null, callBackFunction, "");
    // }

    _getImages('http://topditop.foundcenter.com/api/references/' + activeReferenceId + '/images');
//    _getProducts('http://topditop.foundcenter.com/api/references/' + activeReferenceId + '/products');

    $(document).on('click', '.addmore', function () {
        //$('.image-holder-all').prepend('<div><input id="image_upload" name="image_upload[]" type="file" class="input-file" multiple></div>');
    });

    $(document).on('click', '.image-holder-all .remove-item', function () {

        var imageObject = {
            'referenceId': $(this).data('refid'),
        };

        function callBackFunction(context, response) {

            if (response.code == 200) {
                context.parent().remove();
            }
        }

        connector.getData("POST", _globalRoute + '/api/references/images/delete/' + $(this).data('imageid'), "json", imageObject, callBackFunction, $(this));
    });

})(jQuery);