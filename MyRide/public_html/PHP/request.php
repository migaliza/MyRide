<?php
session_start();
$cmd = $_REQUEST['cmd'];
switch ($cmd) {

    case 1:


        $latitude = $_GET['lat'];
        $longitude = $_GET['long'];
        $Device = $_GET['device_id'];

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
        
        
        if($busStop->fetch_Bus_Stops()){
            $row = $busStop->fetch();
            echo '{"result":1,"busStops":[';
            while($row){
                echo json_encode($row);
                $row = $busStop->fetch();
                if($row){
                    echo ",";
                }
            }
            echo "]}";
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
        include_once ('GPSDevice.php');
        $GPSdevice = new GPSDevice();
        
        if($GPSdevice->getGPSID()){
            $row=$GPSdevice->fetch();
            echo '{"result":1,"GPSID":[';
            while($row){
                echo json_encode($row);
                $row = $GPSdevice->fetch();
                if($row){
                    echo ",";
                }
            }
        echo "]}";
        }
        break;
        
    case 8:
        include_once('routes.php');
        $routes = new routes();
        
        $routeCode =$_REQUEST['Route_Code'];
        $starLong=$_REQUEST['StartRoute_longitude'];
        $startLat=$_REQUEST['StartRoute_Latitude'];
        $endLong=$_REQUEST['EndLongitude'];
        $endLat=$_REQUEST['EndLatitude'];
        
        if($routes->add_new_route($routeCode, $starLong,$startLat,$endLong,$endLat)){
            echo '{"result":1,"message":"SUCCESSFULLY ADDED A ROUTE"}';
        }
        else{
            echo '{"result":0,"message": "UNSUCCESSFUL"}';
        }
        
        break;
        
    case 9:
        
        include_once("routes.php");
        $routes = new routes();
        
        if($routes->display_All_Routes()){
            $row=$routes->fetch();
            echo '{"result":1, "routes":[';
            while($row){
                echo json_encode($row);
                $row=$routes->fetch();
                if($row){
                    echo ",";
                    
                }
            }
            echo "]}";
        }
        else{
            echo '{"result":0,"message": "Nothing to display"}';
        }
        
        break;
    case 10:
        include_once ('administrator.php');
        $admnistrator = new administrator();
        
        $agence= $_REQUEST['AgencyName'];
        $companyEmail= $_REQUEST['email'];
        $phoneNumber = $_REQUEST['PhoneNumber'];
        $location = $_REQUEST['location'];
        
        $randomPass = str_shuffle("abcd7MSDjke");
        
        if($admnistrator->Management_signUP($agence,$companyEmail,$phoneNumber,$location,$randomPass)){
            echo '{"result":1,"message":"SUCCESSFULLY SIGNED UP"}';
        }
        else{
            echo '{"result":0, "message":"NOT SUCCESSFUL"}';
        }
        break;
        
        
    case 11:
        include_once('administrator.php');
        $administrator = new administrator();
        
        if(!empty($_REQUEST['email']) && !empty($_REQUEST['Assigned_Pass'])){
            $email = $_REQUEST['email'];
            $password = $_REQUEST['Assigned_Pass'];
            
            if($administrator->management_login($email,$password)){
                $row=$administrator->fetch();
                if($row){
                    echo '{"result":1,"message": "Logged In"}';
                    $agencyName = $_SESSION['AgencyName'];

                }
            }
            else{
                echo '{"result":0, "message": "UNSUCCESSFULL"}';
            }
            
        }
        else{
                echo '{"result":0, "message": "UNSUCCESSFULL"}';
            }
        
        break;
}
?>