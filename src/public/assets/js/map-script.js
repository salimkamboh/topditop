var infowindow = new google.maps.InfoWindow({
    content: ''
});

var map;

var locationsData = null;

function callBackFunction(context, response) {
    locationsData = response;
    initialize();
}

connector.getData("GET", _globalRoute + "/" + _globalLang + "/api/locations/all/custom", "json", null, callBackFunction, "");

function initialize() {

    var locationsJSON = locationsData[0];

    map = new google.maps.Map(document.getElementById('map-canvas'), {
        zoom: 10,
        center: new google.maps.LatLng(locationsJSON.latitude, locationsJSON.longitude),
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locationsJSON.stores.length; i++) {
        marker = new google.maps.Marker({
            position: new google.maps.LatLng(locationsJSON.stores[i]["latitude"], locationsJSON.stores[i]["longitude"]),
            map: map,
            icon: _globalRoute+'/assets/img/mapicon.png'
        });

        google.maps.event.addListener(marker, 'click', (function (marker, i) {
            var imgTag = locationsJSON.stores[i].img ? '<img style="width: 100px; height: auto;" src="' + locationsJSON.stores[i].img + '">' : '';
            return function () {
                var contentString =
                    '<div class="container-fluid map-holder-over">' +
                        imgTag +
                        '<h2>' +
                        '<a style="text-align:center;" href="' + _globalRoute + '/' + _globalLang + '/front/stores/' + locationsJSON.stores[i].store_id + '">' + locationsJSON.stores[i].store_name + '</a>' +
                        '</h2>' +
                    '</div>';
                infowindow.setContent(contentString);
                infowindow.open(map, marker);
            }
        })(marker, i));
    }
}

/**
 *
 * @param city
 */
function newLocation(city) {

    var newLocation = null;

    $.each(locationsData, function (index, item) {
        if (item.key == city) {
            newLocation = item;
        }
    });

    map.setCenter(
        {
            lat: newLocation.latitude,
            lng: newLocation.longitude
        }
    );

    var marker, i;

    for (i = 0; i < newLocation.stores.length; i++) {
        marker = new google.maps.Marker({
            position: new google.maps.LatLng(newLocation.stores[i]["latitude"], newLocation.stores[i]["longitude"]),
            map: map,
            icon: _globalRoute+'/assets/img/mapicon.png'
        });

        google.maps.event.addListener(marker, 'click', (function (marker, i) {
            return function () {
                var contentString =
                    '<div class="container-fluid map-holder-over">' +
                    '   <h2>' +
                    '       <a  style="text-align:center;" href=' + _globalRoute + '/' + _globalLang + '/front/stores/' + newLocation.stores[i].store_id + '">' + newLocation.stores[i].store_name + '</a>' +
                    '   </h2>' +
                    '</div>';
                infowindow.setContent(contentString);
                infowindow.open(map, marker);
            }
        })(marker, i));
    }
}

$(".city-selector a").on("click", function (e) {
    e.preventDefault();
    var city = $(this).data("city");
    var storeCount = $(this).parent().find("sup").text();
    if (storeCount == 0) {
        return;
    }
    newLocation(city);
    $(".city-selector li").removeClass('active');
    $(this).parent().addClass('active');
});