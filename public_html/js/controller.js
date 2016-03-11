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

  
  
  /**
   * function to initialize datepicker
   */ 
   $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 30 // Creates a dropdown of 15 years to control year
  });
  
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
  
  /**
   * function to add data to the database
   * @returns {undefined}
   */
  function addBus(){
      var busId = $("#Busid").val();
      var busName = $("#BusName").val();
      var gpsDeviceId= $("#GPSDevice_ID").val();
      var driverId = $("#Bus_DriverId").val();
      var routeCode = $("#Bus_RouteCode").val();
      var Agency = $("#Bus_Agency").val();
      var numberofSeats = parseInt($("#number_of_seats").val());
     
      var stringval = "Bus_id="+busId+"&Bus_Name="+busName+"&GPSDevice_ID="+gpsDeviceId+"&Bus_DriverId="+driverId+"&Bus_RouteCode="+routeCode+"&Bus_Agency="+Agency+"&Number_of_seats="+numberofSeats;
     var theUrl =" http://166.62.103.147/~ashesics/class2016/beatrice_lungahu/MyRide/public_html/PHP/request.php?cmd=3&"+stringval;
     console.log(theUrl);
     var object = sendRequest(theUrl);
     
     if(object.result==1){
         Materialize.toast(object.message,4000,'rounded');
     }
     else{
         Materialize.toast(object.message,4000,'rounded');
     }

  }
  
  function adddriver(){
      var driverId = $("#driverID").val();
      var firstName = $("#firstName").val();
      var lastName= $("#lastName").val();
      var BirthDay = $("#birthday").val();
      
     
      var stringval = "DriverId="+driverId+"&FirstName="+firstName+"&LastName="+lastName+"&dateofBirth="+BirthDay;
     var theUrl =" http://166.62.103.147/~ashesics/class2016/beatrice_lungahu/MyRide/public_html/PHP/request.php?cmd=3&"+stringval;
     console.log(theUrl);
     var object = sendRequest(theUrl);
     
     if(object.result==1){
         Materialize.toast(object.message,4000,'rounded');
     }
     else{
         Materialize.toast(object.message,4000,'rounded');
     }
  }