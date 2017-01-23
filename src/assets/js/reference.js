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
    maxFiles: $(".dropzone-previews").data('max'),
    maxFilesize: 8,
    previewsContainer: '#dropzonePreview',
    previewTemplate: document.querySelector('#preview-template').innerHTML,
    addRemoveLinks: true,
    dictRemoveFile: 'Remove',
    dictFileTooBig: 'Image is bigger than 8MB',
    clickable: ".open-uploader-dropzone, .replace-scene-image",

    // The setting up of the dropzone
    init: function (file) {
        this
            .on("thumbnail", function (file, dataUrl) {
                $('.dz-image').last().find('img').attr({width: '100%', height: '100%'});
                console.log(checkUploadability());
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
                            checkUploadability();
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
            referenceObject.images.push(done.imageId)
        }

        file.previewElement.querySelector("img").src = done.url_thumb;
        if (replacementImageMode) {
            _replacementElement.after(file.previewElement);
            _replacementElement.remove();
            deleteImage(_to_delete_image_id, _to_delete_image_id_ref_id);
        }
    }
};

function checkUploadability() {
    var existing = $(".dropzone-previews img").length;
    var allowed = $(".dropzone-previews").data('max');

    if (allowed <= existing) {
        $(".dropzone-holder").parent().hide();
    } else {
        $(".dropzone-holder").show();
        $(".dropzone-holder").parent().show();
    }
}

var defaultManufacturers = $('.ui.dropdown-manufacturers [name="manufacturers"]').val();

referenceObject = {
    'products': [],
    'images': [],
    'manufacturers': defaultManufacturers,
    _token: $("[name='_token']").val()
};

var productData = null;

$('.ui.dropdown-manufacturers').dropdown({
    onChange: function (val) {
        referenceObject.manufacturers = val;
    }
});

$('.ui.dropdown-products').dropdown();

$('.ui.modal').modal('attach events', '.connect-product', 'show');

var removedProductsFromModal = [];

$(document).on('click', '.confirm-add-product-to-reference', function (e) {
    e.preventDefault();
    var prodId = $('input[name="reference_product"]').val();
    referenceObject.products.push(prodId);
    removedProductsFromModal.push({
        'id': prodId,
        'name': $('.dropdown-products .item[data-value="' + prodId + '"]:first').text()
    });
    $('.item[data-value="' + prodId + '"]').remove();
    $('input[name="reference_product"]').val('');

    function callBackFunction(context, response) {
        productData = response;
        populateProductBlockHtml(response.html);
    }

    connector.getData("GET", _globalRoute + '/api/products/html/' + prodId, "json", '', callBackFunction, "");
});

/**
 * @returns {*|jQuery|HTMLElement}
 */
function populateProductBlockHtml(productHtml) {
    $('.reference-product-holder.row').prepend(productHtml);
    $(".dropdown-products .text").text('');
    $('.ui.modal').modal('hide');
}

$(document).on('click', '.delete-scene-image', function (e) {
    e.preventDefault();

    var imageId = $(this).data('image-id');
    var referenceId = $(this).data('reference-id');

    deleteImage(imageId, referenceId, $(this));
});

function deleteImage(imageId, referenceId, refElement) {
    var imageObject = {
        'referenceId': referenceId,
        _token: $("[name='_token']").val()
    };

    function callBackFunction(context, response) {
        if (response.code == 200) {
            context.parent().parent().parent().remove();
            checkUploadability();
        }
        if ($(".dropzone-parent img").length == 0) {
            $(".dropzone-holder").show();
        }
    }

    connector.getData("POST", _globalRoute + '/ajax/images/delete/' + imageId, "json", imageObject, callBackFunction, refElement);
}


$(document).on('click', '.save_reference', function (e) {
    e.preventDefault();

    if (countUnuploaded() > 0) {
        return false;
    }

    referenceObject.title = $('input[name="reference_title"]').val().trim();
    referenceObject.status = $('select[name="reference_status"]').val();
    referenceObject.description = $('textarea[name="reference_description"]').val();
    referenceObject.video = $('input[name="video_url"]').val();

    function callBackFunction(context, response) {

        if (response.code == 200) {
            window.location = _globalRoute + '/' + _globalLang + '/dashboard/references/edit/' + response.resourceId;
        } else if (response.code == 202) {
            window.location = _globalRoute + '/' + _globalLang + '/dashboard/upgrade/references';
        }
    }

    connector.getData("POST", $("form#insertreference").attr("action"), "json", referenceObject, callBackFunction, "");
});

function countUnuploaded() {
    var num = 0;
    $('.dz-processing').each(function (index) {
        if (!$(this).hasClass('dz-complete'))
            num++;
    });
    return num;
}

replacementImageMode = false;
_to_delete_image_id = null;
_to_delete_image_id_ref_id = null;

$(document).on('click', '.replace-scene-image', function (e) {
    replacementImageMode = true;
    _replacementElement = $(this).parent().parent().parent();
    _to_delete_image_id_ref_id = $(this).data('reference-id');
    _to_delete_image_id = $(this).data('image-id');
});

$(document).on('click', '.disconnect-product', function (e) {

    e.preventDefault();

    //handleLogic
    var prodId = $(this).data('prodid');
    var returnObject = popAndReturn(prodId, removedProductsFromModal);
    var products = referenceObject.products;
    for (var i = 0; i < products.length; i++) {
        prodId = prodId + '';
        if (products[i] === prodId) {
            products.splice(i, 1);
            break;
        }
    }

    referenceObject.products = products;

    //handle UI
    $('.dropdown-products .menu').append('<div class="item" data-value="' + returnObject.id + '">' + returnObject.name + '</div>');
    $(this).parent().parent().parent().remove();

});

/**
 *
 * @param id
 * @param array
 * @returns {*}
 */
function popAndReturn(id, array) {
    var itemSaved;
    for (var i = 0; i < array.length; i++) {
        if (array[i].id == id) {
            itemSaved = {
                id: array[i].id,
                name: array[i].name
            };
            array.splice(i, 1);
            break;
        }
    }
    return itemSaved;
}