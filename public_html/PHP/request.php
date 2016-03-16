<?php

$cmd = $_REQUEST['cmd'];
switch ($cmd) {

    case 1:


        $latitude = $_GET['lat'];
        $longitude = $_GET['lon'];
        $Device = $_GET['device'];

        include_once('GPSDevice.php');
        $GPSdevice = new GPSDevice();

        //echo ($GPSdevice->add_GPS_Device($Device,$latitude,$longitude));
        if ($GPSdevice->add_GPS_Device($Device, $latitude, $longitude)) {
            echo '{"result":1,"message": "SUCCESFULLY ADDED"}';
        } else {
           
            echo '{"result":0,"message": "unsuccessful"}';
        }

        break;

    //this displays the content added to the database
    case 2:
        include_once('GPSDevice.php');
        $device = new GPSDevice();
        if ($device->fetch_GPS_Coordinates()) {
            $row = $device->fetch();
            echo '{"result":1,"coordinates":['; //start of json object
            while ($row) {
                echo json_encode($row);   //convert the result array to json object
                $row = $device->fetch();
                if ($row) {
                    echo ",";     //if there are more rows, add comma 
                }
            }
            echo "]}";
        }






        break;

    case 3:
        include_once ('bus.php');
        $bus = new bus();

        $busId = $_REQUEST['Bus_id'];
        $busName = $_REQUEST['Bus_Name'];
        $gpsDeviceId = $_REQUEST['GPSDevice_ID'];
        $driverId = $_REQUEST['Bus_DriverId'];
        $routeCode = $_REQUEST['Bus_RouteCode'];
        $Agency = $_REQUEST['Bus_Agency'];
        $numberofseats = $_REQUEST['Number_of_seats'];
        $ValSeats = $numberofseats;
        if ($bus->add_new_bus($busId, $busName, $gpsDeviceId, $driverId, $routeCode, $Agency, $ValSeats)) {
            echo '{"result":1,"message": "YOU HAVE ADDED A NEW BUS"}';
        } else {
            echo '{"result":0,"message": "NOT SUCCESSFUL"}';
        }

        break;


    case 4:
        include_once('driver.php');
        $driver = new driver();
        
        $driverId = $_REQUEST['DriverId'];
        $firstName = $_REQUEST['firstName'];
        $lastName = $_REQUEST['lastName'];
        $AssignedBus_ID = $_REQUEST['AssignedBus_ID'];
        
        if($driver->add_driver($driverId,$firstName,$lastName,$AssignedBus_ID)){
            echo $driverId." ".$firstName." ".$lastName." ".$AssignedBus_ID;
            echo '{"result":1 "message": "SUCCESSFULLY ADDED"}';
        }
        else{
            echo '{"result":0 "message": "UNSUCCESSFULLY"}';
        }
        
        
                
        

        break;

    case 5:
        include_once('busStops.php');
        $busStop = new busStops();
        
        $name = $_REQUEST['Bus_Stop_Name'];
        $lon= $_REQUEST['Longitude'];
        $lat = $_REQUEST['Latitude'];
        $RouteId = $_REQUEST['RouteId'];
        
        if($busStop->add_new_busStop($name,$lon,$lat,$RouteId)){
            echo '{"result": 1 "message": "SUCCESSFULLY ADDED"}';
        }
        else{
            echo '{"result":0 "message": "UNSUCCESFULL"}';
        }
        
        break;

    case 6:
        include_once ('GPSDevice.php');
        $GPSdevice = new GPSDevice();
        
        $device = $_REQUEST['Device_Id'];
        $description = $_REQUEST['Description'];
        
        if($GPSdevice->addGPSDeviceDescription($device,$description)){
            echo '{"result":1 "message": "SUCCESSFULLY ADDED A NEW DEVICE DESCRIPTION"}';
        }
        else{
             echo '{"result":0 "message": "UNSUCCESSFULL"}';
        }
       
        break;


    case 7:
        $DB_HOST = "localhost";
        $DB_NAME = "csashesi_beatrice-lungahu";
        $DB_USER = "csashesi_bl16";
        $DB_PWORD = "db!hiJ35";

        $link = mysqli_connect($DB_HOST, $DB_USER, $DB_PWORD, $DB_NAME);
        if ($link == false) {
            echo "not succesfull";
        }
        /*
          if(mysqli_select_db($DB_NAME,$link)){
          echo "echo can not select db";
          } */


        $str_query = "SELECT * FROM MWC_PoolMembers ";
        $result = mysqli_query($link, $str_query);
        $row = $result->fetch_assoc();
        echo '{"result":1,"values":['; //start of json object
        while ($row) {
            echo json_encode($row);   //convert the result array to json object
            $row = $result->fetch_assoc();
            if ($row) {
                echo ",";     //if there are more rows, add comma 
            }
        }
        echo "]}";
        break;
}
?>