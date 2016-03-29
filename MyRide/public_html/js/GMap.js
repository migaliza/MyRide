/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


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

/* global google */

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
        }
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
        var theURL = "http://166.62.103.147/~ashesics/class2016/beatrice_migaliza/MyRide/public_html/PHP/request.php?cmd=2";
        var obj = sendRequest(theURL);
        if (obj.result === 1) {
            $.each(obj.coordinates, function (i, coordinates) {
                var bus = coordinates.Device_Id;
                var longitude = coordinates.long;
                var latitude = coordinates.lat;
                var info = '<div id="content"><a href="#">' + bus + '</a></div>';

                var infowindow = new google.maps.InfoWindow({
                    content: info
                });
                //var marker;
                var busIcon = new google.maps.MarkerImage("images/logo.png", null, null, null, new google.maps.Size(40, 40));
               

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
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(origin);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(destination);

    //add autocompletion on the search text
    var origin_autocomplete = new google.maps.places.Autocomplete((origin));
    origin_autocomplete.bindTo('bounds', map);
    var destination_autoComplete = new google.maps.places.Autocomplete(destination);
    destination_autoComplete.bindTo('bounds', map);
    
    
    /**
     * function to fit the viewport on the screen
     * @param {type} map
     * @param {type} place
     * @returns {undefined}
     */
    function expandviewport(map, place) {
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        }
        else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }
    }
    //expandviewport(map,place);
    /*
     * eventlistener for any change carried on on the map
     */

    origin_autocomplete.addListener('place_changed', function () {
        //alert("at origin autocomplete");
        var place = origin_autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("contained no geometry");
            return;
        }
        expandviewport(map, place);
        
        /* if the place has geometry store its place id and route it if there is the other place id */
        origin_place_id = place.place_id;
       // alert(origin_place_id);
        route(origin_place_id, destination_place_id, travel_mode, directionsService, directionsDisplay);
    });

    destination_autoComplete.addListener('place_changed', function () {
        //alert("at destination autocomplete");
        var place = destination_autoComplete.getPlace();
        if (!place.geometry) {
            window.alert("Contained no geometry");
            return;
        }
        expandviewport(map, place);

        /* if the place has geometry, store it and route it and route it if there is the other place id */
        destination_place_id = place.place_id;
        route(origin_place_id, destination_place_id, travel_mode, directionsService, directionsDisplay);

    });


    /**
     * function to draw the route from origin to destination 
     * @param {type} origin_place_id
     * @param {type} destination_place_id
     * @param {type} travel_mode
     * @param {type} directionsService
     * @param {type} directionsDisplay
     * @returns {undefined}
     */
    function route(origin_place_id, destination_place_id, travel_mode, directionsService, directionsDisplay) {
        if (!origin_place_id || !destination_place_id) {
            return;
        }

        directionsService.route({
            origin: {'placeId': origin_place_id},
            destination: {'placeId': destination_place_id},
            travelMode: travel_mode},
        function (response, status) {
            if (status === google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(response);
            }
            else {
                window.alert('request failed');
            }
        });
    }
}







