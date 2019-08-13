$('.ui.dropdown').dropdown({
    onAdd: function (selectedValue, selectedText, $selectedItem) {
        filterProducts(selectedValue, $(this).data('filter'));
    },
    onRemove: function (removedValue, removedText, $removedChoice) {
        filterProductsDeleted(removedValue, $(this).data('filter'));
    }
});

var searchObject = {
    locationParams: [],
    brandParams: [],
    categoriesParams: [],
};

function filterProductsDeleted(text, filterType) {

    switch (filterType) {
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

    function callBackFunction(context, brandreferences) {
        var html = '';
        for (var i = 0; i < brandreferences.length; i++) {
            var brandreference = brandreferences[i];
            var imageUrl = '/assets/img/topditop-missing-logo-image-xs.jpg';

            if (brandreference.thumbnail_medium_url !== null) {
                imageUrl = brandreference.thumbnail_medium_url;
            }

			html += '<div class="brandreference">'+
				 ' <a href="' + _globalRoute + '/' + _globalLang + '/front/brands/' + brandreference.manufacturer_id + '/references/'+ brandreference.id +'">'+
					'<img src="/images'+imageUrl+'">'+
				 ' </a>'+
				  '<div class="brandreference-text">'+
					'<p class="brandreference-text-title">' + brandreference.title +
														'<span class="brandreference-text-category">' + brandreference.categories.join(", ") + '</span>'+
													'</p>'+
					'<p class="brandreference-text-description">' + brandreference.description + '</p>'+
				  '</div>'+
			'</div>';
        }

        $(".list-all-brandrefs").css("opacity", 0.5);
        $(".list-all-brandrefs").html(html);
        $(".list-all-brandrefs-pagination").remove();
        
        if (typeof Macy !== "undefined") {
			var macyInstance = Macy({
				container: '.brandreferences-macy',
				columns: 3,
				margin: {
					x: 10,
					y: 40
				},
				breakAt: {
					940: 2,
					640: 1
				}
			});
			macyInstance.reInit();
		}
		$(".list-all-brandrefs").fadeTo("slow",1);
    }

    connector.getData("POST", $("form.filter-multi").attr("action"), "json", dataToSend, callBackFunction, "");
}

$('.clear-filter').on('click', function () {
    $('.ui.dropdown').dropdown('restore defaults');
});
