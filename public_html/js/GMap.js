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

    coords = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
    var options = {
        zoom: 12,
        center: coords,
        scrollwheel: true,
        mapTypeControlOptions: {
            style: google.maps.NavigationControlStyle.SMALL
        },
        //mapTypeId: google.maps.MapTypeId.ROADMAP

    };

    var map = new google.maps.Map(document.getElementById('MapCanvas'), options);


    var marker = new google.maps.Marker({
        position: coords,
        map: map,
        title: "Your are here"
    });


    var onChangeHandler = function () {
        calculateAndDisplayRoute(directionsService, directionsDisplay);
    };
    //document.getElementById('start').addEventListener('change', onChangeHandler);
    document.getElementById('findPlaces').addEventListener('change', onChangeHandler);


/*
    //create a search box and link it to the elements
    var input = document.getElementById('findPlaces');
    var options = {
        types: ['locality']
    };
    var searchBox = new google.maps.places.SearchBox(input);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    //Bias the searchBox results towards the current mapp view point\
    map.addListener('places_changed', function () {
        searchBox.setBounds(map.getBounds());
    })

    //listen to the event fired when user selectes a prediction and
    //retrieves
    var markers = [];
    searchBox.addListener('places_changed', function () {
        var places = searchBox.getPlaces();

        if (places.length == 0) {
            return;
        }

        //clear the old markers
        markers.forEach(function (marker) {
            marker.setMap(null);
        });

        markers = [];
        //for each place get the icon and name of the place
        var bounds = new google.maps.LatLngBounds();
        places.forEach(function (place) {
            var icon = {
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(25, 25)

            };

            //create a marker for eah place
            markers.push(new google.maps.Marker({
                map: map,
                icon: icon,
                title: place.name,
                position: place.geometry.location
            }));

        });
    });

    /*var onChangeHandler = function() {
     calculateAndDisplayRoute(directionsService, directionsDisplay);
     };
     document.getElementById('start').addEventListener('change', onChangeHandler);
     document.getElementById('end').addEventListener('change', onChangeHandler);*/
}



/*
 * function to calculate direction and distance to a particular place on the map
 * 
 */

function calculateAndDisplayRoute(directionsService, directionsDisplay) {
    directionsService.route({
        origin: navigator.geolocation.getCurrentPosition(initMap),
        destination: document.getElementById('findPlaces').value,
        travelMode: google.maps.TravelMode.DRIVING
    }, function (response, status) {
        if (status === google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
        } else {
            window.alert('Directions request failed due to ' + status);
        }
    });
}


