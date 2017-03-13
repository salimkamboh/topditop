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
            return function () {
                var contentString =
                    '<div class="container-fluid map-holder-over">' +
                    '   <div class="">' +
                    '       <a href="' + _globalRoute + '/' + _globalLang + '/front/stores/' + locationsJSON.stores[i].store_id + '">' +
                    '           <img style="width:150px;height:auto;" src="' + locationsJSON.stores[i].img + '">' +
                    '       </a>' +
                    '   </div>' +
                    '   <h2>' +
                    '       <a href="' + _globalRoute + '/' + _globalLang + '/front/stores/' + locationsJSON.stores[i].store_id + '">' + locationsJSON.stores[i].store_name + '</a>' +
                    '   </h2>' +

                    '   <div class="row">' +
                    '       <div class="col-xs-6">' +
                    '           <span>' + locationsJSON.stores[i].numproducts + '</span> <small>Products</small>' +
                    '       </div>' +
                    '       <div class="col-xs-6 map__window__manufacturers">' +
                    '           <span>' + locationsJSON.stores[i].numreferences + '</span> <small>References</small>' +
                    '       </div>' +
                    '   </div>' +
                    '</div>';
                //infowindow.setContent(locationsJSON.stores[i]["store_name"]);
                infowindow.setContent(contentString);
                infowindow.open(map, marker);
                console.log(locationsJSON.stores[i]);
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
                    '   <div class="">' +
                    '       <a href="' + _globalRoute + '/' + _globalLang + '/front/stores/' + newLocation.stores[i].store_id + '">' +
                    '           <img style="width:150px;height:auto;" src="' + newLocation.stores[i].img + '">' +
                    '       </a>' +
                    '   </div>' +
                    '   <h2>' +
                    '       <a href="' + _globalRoute + '/' + _globalLang + '/front/stores/' + newLocation.stores[i].store_id + '">' + newLocation.stores[i].store_name + '</a>' +
                    '   </h2>' +

                    '   <div class="row">' +
                    '       <div class="col-xs-6">' +
                    '           <span>' + newLocation.stores[i].numproducts + '</span> <small>Products</small>' +
                    '       </div>' +
                    '       <div class="col-xs-6 map__window__manufacturers">' +
                    '           <span>' + newLocation.stores[i].numreferences + '</span> <small>References</small>' +
                    '       </div>' +
                    '   </div>' +
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