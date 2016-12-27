$('#productModal').on("hidden.bs.modal", function () {
    $("#productModal .dialog").empty().append('<div class="text-center">' +
        '<img src="' + _globalRoute + '/assets/css/lib/ajax-loader.gif" alt="" style="display: inline-block"/>' +
        '</div>');
});

$('.ui.modal.modal-single-product').modal({
    observeChanges: true,
    onHide: function () {
        $(".modal-body").empty().append('<div class="text-center">' +
            '<img src="' + _globalRoute + '/assets/css/lib/ajax-loader.gif" alt="" style="display: inline-block"/>' +
            '</div>');
    }
});

$(document).on('click', '.single-item-product .title a', function () {
    var productId = $(this).data('product-id');
    openProductModal(productId);
});

function openProductModal(productId) {
    function callBackFunction(context, response) {
        populateProductModal(response);
        setTimeout(function () {
            $('.ui.modal.modal-single-product').modal('refresh');
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

    var referenceImage = null;

    if (productData.refImage != null && productData.refImage != undefined) {
        referenceImage = productData.refImage;
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
    if (referenceImage !== null) {
        productHTML += '<div class="item-preview">' +
            '<h3>Other References for this product</h3>' +
            '<a href="' + _globalRoute + '/front/references/single/' + productData.refId + '"><img src="' + referenceImage + '" alt="" class="img-responsive"></a>' +
            '</div>';
    }

    $(".modal-body").empty().append(productHTML);

}