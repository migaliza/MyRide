/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var directionsDisplay = new google.maps.DirectionsRenderer();
var directionsService = new google.maps.DirectionsService();
$(document).ready(function () {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(initMap);

    }
    else {
        error("Geo Location is not supported");
    }


});

/*
 * function to draw the current location of the map
 * 
 */


var coords;
function initMap(position) {
    var destination_place_id = null;
    var origin_place_id = null;
    var travel_mode = google.maps.TravelMode.DRIVING;

    coords = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
    var options = {
        zoom: 12,
        center: coords,
        scrollwheel: true,
        mapTypeControlOptions: {
            style: google.maps.NavigationControlStyle.SMALL
        },
    };

    var map = new google.maps.Map(document.getElementById('MapCanvas'), options);


    /*
     * marker to show current position of user
     * @type google.maps.Marker
     */
    var marker = new google.maps.Marker({
        position: coords,
        map: map,
        title: "Your are here"
    });

    /*
     * function to place buses on the map
     * @param {type} directionsService
     * @param {type} directionsDisplay
     * @returns {undefined}
     */

    function traceBusOnMap() {
        var theURL = "http://166.62.103.147/~ashesics/class2016/beatrice_lungahu/MyRide/public_html/PHP/request.php?cmd=2";
        var obj = sendRequest(theURL);
        if (obj.result === 1) {
            $.each(obj.coordinates, function (i, coordinates) {
                var bus = coordinates.Device_Id;
                var longitude = coordinates.Longitude;
                var latitude = coordinates.Latitude;
                var info = '<div id="content"><a href="#">' + bus + '</a></div>';

                var infowindow = new google.maps.InfoWindow({
                    content: info
                });

                var busIcon = new google.maps.MarkerImage("images/bus2.png", null, null, null, new google.maps.Size(21, 30));
                var marker = new google.maps.Marker({
                    map: map,
                    position: new google.maps.LatLng(latitude, longitude),
                    icon: busIcon,
                    title: bus
                });


                marker.addListener('click', function () {
                    infowindow.open(map, marker);
                });

            });
        }
    }

    traceBusOnMap();


    var directionsService = new google.maps.DirectionsService;
    var directionsDisplay = new google.maps.DirectionsRenderer;
    directionsDisplay.setMap(map);
    var origin = document.getElementById('start');
    var destination = document.getElementById('end');

    // push the destination input text box on the map
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(origin)
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(destination);

    //add autocompletion on the search text
    var origin_autocomplete = new google.maps.places.Autocomplete((origin));
    origin_autocomplete.bindTo('bounds', map);
    var destination_autoComplete = new google.maps.places.Autocomplete(destination);
    destination_autoComplete.bindTo('bounds', map);

    function expandviewport(map, place) {
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        }
        else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }
    }
    /*
     * eventlistener for any change carried on on the map
     */

    origin_autocomplete.addListener('place_change', function () {
        var place = origin_autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("contained no geomtry");
            return;
        }
        expandviewport(map, place);

        origin_place_id = place.place.id;
        (origin_place_id, destination_place_id, travel_mode, directionsService, directionsDisplay);
    });

    destination_autoComplete.addListener('place_change', function () {
        var place = destination_autoComplete.getPlace();
        if (!place.geometry) {
            window.alert("Contained no geometry");
            return;
        }
        expandviewport(map, place);

        //if the place has geometry, store it and route it
        destination_place_id = place.place.id;
        route(origin_place_id, destination_place_id, travel_mode, directionsService, directionsDisplay);

    });


    //draw route
    function route(origin_place_id, destination_place_id, travel_mode, directionsService, directionsDisplay) {
        if (!origin || destination_place_id) {
            return;
        }
        directionsService.route({
            origin: {'placeId': origin_place_id},
            destination: {'placeId': destination_place_id},
            travelMode: travel_mode},
        function (response, status) {
            if (status === google.DirectionsStatus.OK) {
                directionsDisplay.setDirections(response);

            }
            else {
                window.alert('request failed');
            }

        });

    }


}




/*
 * function to send request
 * @param {type} directionsService
 * @param {type} directionsDisplay
 * @returns {undefined}
 */

function sendRequest(u) {
    //alert("here");
    // alert(u);
    console.log(u);
    var obj = $.ajax({url: u, async: false});
    var result = $.parseJSON(obj.responseText);
    return result;
}

/*
 * function to calculate direction and distance to a particular place on the map
 * 
 */

function calculateAndDisplayRoute(directionsService, directionsDisplay) {
    directionsService.route({
        origin: navigator.geolocation.getCurrentPosition(initMap),
        destination: document.getElementById('end').value,
        travelMode: google.maps.TravelMode.DRIVING
    }, function (response, status) {
        if (status === google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
        } else {
            window.alert('Directions request failed due to ' + status);
        }
    });
}


