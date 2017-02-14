$('#productModal').on("hidden.bs.modal", function() {
    $("#productModal .dialog").empty().append('<div class="text-center">' +
        '<img src="' + _globalRoute + '/assets/css/lib/ajax-loader.gif" alt="" style="display: inline-block"/>' +
        '</div>');
});

$('.ui.modal.modal-single-product').modal({
    observeChanges: true,
    onHide: function() {
        $(".modal-body").empty().append('<div class="text-center">' +
            '<img src="' + _globalRoute + '/assets/css/lib/ajax-loader.gif" alt="" style="display: inline-block"/>' +
            '</div>');
    }
});

$(document).on('click', '.single-item-product .title a', function() {
    var productId = $(this).data('product-id');
    openProductModal(productId);
});

function openProductModal(productId) {
    function callBackFunction(context, response) {
        populateProductModal(response);
        setTimeout(function() {
            $('.ui.modal.modal-single-product').modal('refresh');

            $('#reference-images-' + productId).css('visibility', 'hidden');
            $('#reference-images-' + productId).resize();

            setTimeout(function() {
                $('#reference-images-' + productId).css('visibility', 'visible');
            }, 300);
        }, 300);

        $('.ui.modal.modal-single-product').modal('show');
    }

    connector.getData("GET", _globalRoute + '/api/products/html/' + productId, "json", '', callBackFunction, "");
}

function populateProductModal(productData) {

    var manufacturer = null;

    if (productData.manufacturer != null && productData.manufacturer != undefined) {
        if (productData.manufacturer.name != null && productData.manufacturer.name != undefined) {
            manufacturer = productData.manufacturer.name;
        }
    }

    var referenceImages = null;

    if (productData.refImages != null && productData.refImages != undefined) {
        referenceImages = productData.refImages;
    }

    var categories = productData.categoriesNice;

    var productHTML =
        '<img src="' + productData.productImage + '" alt="" class="img-responsive">' +
        '<div class="item-info show-info">' +
        '<div class="item-info-top clearfix">' +
        '<span class="title">' + productData.title + '</span>' +
        '<span class="price"><i class="icon-eur"></i>' + productData.price + '</span>' +
        '</div>' +
        '<div class="item-info-bottom">' +
        '<p class="prod-modal-info-line"><i class="fa fa-bookmark"></i>' + manufacturer + '</p>' +
        '<p class="prod-modal-info-line"><i class="fa fa-bookmark"></i>' + categories + '</p>' +
        '<div class="pull-right">' +
        '<a class="shareBtn" href="' + productData.id + '"><i class="fa fa-facebook-square"></i></a>' +
        '</div>' +
        '<div class="clearfix"></div>' +
        '</div>' +
        '</div>' +
        '<p>' + productData.description + '</p>';

    if (referenceImages) {
        productHTML += '<h3>' + Lang.get('messages.product_other_references') + '</h3>';
        productHTML += '<div class="reference-images" id="reference-images-' + productData.id + '">';

        referenceImages.forEach(function(referenceImage) {
            productHTML += '<a href="' + _globalRoute + '/front/references/single/' + productData.refId + '"><img src="' + referenceImage + '" alt=""></a>';
        });

        productHTML += '</div>';
    }

    $(".modal-body:not(.modal-body-video)").empty().append(productHTML);

    if (referenceImages) {
        $('#reference-images-' + productData.id).slick({
            dots: true,
        });
    }
}