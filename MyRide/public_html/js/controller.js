/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$( document ).ready(function(){
    $(".button-collapse").sideNav();
    //$('#traffic').openModal();
    //$('#busStatus').closeModal();
});

 $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();
  });
  
  $(document).ready(function(){
      initMap();
  })
 
 function initMap() {
  // Create a map object and specify the DOM element for display.
  var map = new google.maps.Map(document.getElementById('MapCanvas'), {
    center: {lat: 5.7500, lng: 0.0000},
    scrollwheel: false,
    zoom: 8
  });
}
  /*
function initMap() {
  var accra = {lat: 5.7500, lng: 0.0000};
  //var indianapolis = {lat: 39.79, lng: -86.14};

  var map = new google.maps.Map(document.getElementById('mainPage'), {
    center: accra,
    scrollwheel: false,
    zoom: 7
  });

  var directionsDisplay = new google.maps.DirectionsRenderer({
    map: map
  });*/

  /*// Set destination, origin and travel mode.
  var request = {
    destination: indianapolis,
    origin: chicago,
    travelMode: google.maps.TravelMode.DRIVING*/
  //};
