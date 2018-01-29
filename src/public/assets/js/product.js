/**
 *
 **
 ** TOPDITOP
 **
 *
 */

var photo_counter = 0;

Dropzone.options.realDropzone = {

    thumbnailWidth: null,
    thumbnailHeight: null,
    uploadMultiple: false,
    parallelUploads: 1,
    maxFiles: 1,
    maxFilesize: 8,
    previewsContainer: '#dropzonePreview',
    previewTemplate: document.querySelector('#preview-template').innerHTML,
    addRemoveLinks: true,
    dictRemoveFile: 'Remove',
    dictFileTooBig: 'Image is bigger than 8MB',
    clickable: ".open-uploader-dropzone, .replace-scene-image",

    // The setting up of the dropzone
    init: function () {
        this
            .on("maxfilesexceeded", function (file) {
                alert("No more files please!");
            })
            .on("thumbnail", function (file, dataUrl) {
                $('.dz-image').last().find('img').attr({width: '100%', height: '100%'});
            })
            .on("removedfile", function (file) {
                $.ajax({
                    type: 'POST',
                    url: 'upload/delete',
                    data: {id: file.name, _token: $('#csrf-token').val()},
                    dataType: 'html',
                    success: function (data) {
                        var rep = JSON.parse(data);
                        if (rep.code == 200) {
                            photo_counter--;
                            $("#photoCounter").text("(" + photo_counter + ")");
                        }
                    }
                });
            });
    },
    error: function (file, response) {
        if ($.type(response) === "string")
            var message = response; //dropzone sends it's own error messages in string
        else
            var message = response.message;
        file.previewElement.classList.add("dz-error");
        _ref = file.previewElement.querySelectorAll("[data-dz-errormessage]");
        _results = [];
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
            node = _ref[_i];
            _results.push(node.textContent = message);
        }
        return _results;
    },
    success: function (file, done) {
        photo_counter++;

        if (done.imageId !== undefined) {
            productObject.images.push(done.imageId)
        }

        file.previewElement.querySelector("img").src = done.url_thumb;

        if (replacementImageMode) {
            _replacementElement.after(file.previewElement);
            _replacementElement.remove();
            deleteImage(_to_delete_image_id, _to_delete_image_id_prod_id);

            replacementImageMode = false;
        }
    }
};

var referenceData = null;
var defaultCats = $('.ui.dropdown-categories [name="categories"]').val();

productObject = {
    'references': [],
    'images': [],
    'categories': defaultCats,
    'show_brand_link': $("[name='product_show_brand_link']").val(),
    _token: $("[name='_token']").val()
};

$("#product_show_brand_link").click(function() {
    if($("[name='product_show_brand_link']").val() == 0) {
        $("[name='product_show_brand_link']").val(1);
    }else {
        $("[name='product_show_brand_link']").val(0);
    }
});

$('.ui.dropdown-brand').dropdown();

$('.ui.dropdown-categories').dropdown({
    onChange: function (val) {
        productObject.categories = val;
    }
});

$(document).on('click', '.save_product', function (e) {
    e.preventDefault();

    if (!$("#insertproduct").valid()) {
        if ($("[name='categories']").val() == '') {
            $('.dropdown-categories .text').addClass('error');
        }
        if ($("[name='manufacturer']").val() == '') {
            $('.new-brand').addClass('error');
        }
        return false;
    }

    productObject.title = $('input[name="product_title"]').val().trim();
    productObject.description = $('textarea[name="product_description"]').val();
    productObject.price = $('input[name="product_price"]').val();
    productObject.manufacturer = $('input[name="manufacturer"]').val();
    productObject.show_brand_link = $("[name='product_show_brand_link']").val();

    function callBackFunction(context, response) {
        if (response.code == 200) {
            window.location = _globalRoute + '/' + _globalLang + '/dashboard/products/edit/' + response.resourceId;
        } else if (response.code == 202) {
            window.location = _globalRoute + '/' + _globalLang + '/dashboard/upgrade/products';
        }
    }

    connector.getData("POST", $("form#insertproduct").attr("action"), "json", productObject, callBackFunction, "");
});

$('.ui.dropdown-references').dropdown();

$('.ui.modal').modal('attach events', '.connect-reference', 'show');

$(document).on('click', '.confirm-add-reference-to-product', function (e) {
    e.preventDefault();
    var refId = $('input[name="product_reference"]').val();
    productObject.references.push(refId);
    $('.item[data-value="' + refId + '"]').remove();
    $('input[name="product_reference"]').val('');

    function callBackFunction(context, response) {
        referenceData = response;
        populateReferenceBlockHtml(response.html);
    }

    connector.getData("GET", _globalRoute + '/api/references/' + refId, "json", '', callBackFunction, "");
});

/**
 * @returns {*|jQuery|HTMLElement}
 */
function populateReferenceBlockHtml(htmlReference) {
    $('.product-reference-holder.row').prepend(htmlReference);
    $(".dropdown-references .text").text('');
    $('.ui.modal').modal('hide');
}

$(document).on('click', '.delete-scene-image', function (e) {
    e.preventDefault();

    var imageId = $(this).data('image-id');
    var productId = $(this).data('product-id');

    deleteImage(imageId, productId, $(this));
});

function deleteImage(imageId, productId, refElement) {
    var imageObject = {
        'productId': productId,
        _token: $("[name='_token']").val()
    };
    console.log(imageObject);
    function callBackFunction(context, response) {
        if (response.code == 200) {
            context.parent().parent().remove();

            if ($(".dropzone-parent img").length == 0) {
                $(".dropzone-holder").show();
            }
        }
    }

    connector.getData("POST", _globalRoute + '/ajax/images/product/delete/' + imageId, "json", imageObject, callBackFunction, refElement);
}

replacementImageMode = false;
_to_delete_image_id = null;
_to_delete_image_id_prod_id = null;

$(document).on('click', '.replace-scene-image', function (e) {
    replacementImageMode = true;
    _replacementElement = $(this).parent().parent();
    _to_delete_image_id_prod_id = $(this).data('product-id');
    _to_delete_image_id = $(this).data('image-id');
});
$(document).ready(function () {
    $("#insertproduct").validate({
        rules: {
            product_title: "required",
            product_price: "required",
            product_description: "required",
            manufacturer: "required",
            categories: "required",
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});