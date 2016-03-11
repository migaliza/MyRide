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
            echo 'not successful';
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
        $numberofSeats = $_REQUEST['Number_of_seats'];

        if ($bus->add_new_bus($busId,$busName,$gpsDeviceId,$driverId,$routeCode,$Agency,$numberofSeats )) {
            echo '{"result":1,"message": "YOU HAVE ADDED A NEW BUS"}';
        } else {
            echo '{"result":0,"message": "NOT SUCCESSFUL"}';
        }

        break;


    case 4:
        $DB_HOST = "localhost";
        $DB_NAME = "csashesi_beatrice-lungahu";
        $DB_USER = "csashesi_bl16";
        $DB_PWORD = "db!hiJ35";

        $link = mysqli_connect($DB_HOST, $DB_USER, $DB_PWORD, $DB_NAME);
        if ($link == false) {
            echo "not succesfull";
        }


        $name = $_REQUEST['JoinPoolName'];
        $pNumber = $_REQUEST['PhoneNumber'];
        $poolOwner = $_REQUEST['JoinPoolName'];
        $studentStaffId = $_REQUEST['captured'];



        $str_query = "INSERT INTO  MWC_PoolMembers (Name,PhoneNumber,PoolOwner,StaffStudentId) VALUES('$name','$pNumber','$poolOwner','$studentStaffId')";
        if (mysqli_query($link, $str_query)) {
            echo '{"result":1,"message": "SUpdated"}';
        } else {
            //echo $str_query;
            echo '{"result":0,"message": "unsuccessful"}';
        }
        // $poolDetails = "You joined the pool";



        break;

    case 5:
        $DB_HOST = "localhost";
        $DB_NAME = "csashesi_beatrice-lungahu";
        $DB_USER = "csashesi_bl16";
        $DB_PWORD = "db!hiJ35";

        $link = mysqli_connect($DB_HOST, $DB_USER, $DB_PWORD, $DB_NAME);
        if ($link == false) {
            echo "not succesfull";
        }

        $email = $_REQUEST['Email'];
        $FirstName = $_REQUEST['FirstName'];
        $LastName = $_REQUEST['LastName'];
        $phoneNumber = $_REQUEST['PhonNumber'];
        $username = $_REQUEST['UserName'];
        $random = mt_rand(30, 60);
        $randomPass = $LastName . $random;



        $str_query = "INSERT INTO MWC_SignUpCarPooling (Email,FirstName,LastName,PhonNumber,randomPass,UserName) VALUES('$email','$FirstName','$LastName','$phoneNumber','$randomPass','$username')";

        $content = "Your+user+name+is%3A+" . $username . "+and+Password%3A+" . $randomPass;
        if (mysqli_query($link, $str_query)) {
            echo '{"result":1,"message": "SUpdated"}';
            ob_start();
            $url = "https://api.smsgh.com/v3/messages/send?"
                    . "From=CarPooling"
                    . "&To=%2B$phoneNumber"
                    . "&Content=$content"
                    . "&ClientId=odfbifrp"
                    . "&ClientSecret=rktegnml"
                    . "&RegisteredDelivery=true";
            $response = file_get_contents($url);
            ob_end_clean();
        } else {
            //echo $str_query;
            echo '{"result":0,"message": "Sign Up unsuccessful"}';
        }




        break;

    case 6:
        $DB_HOST = "localhost";
        $DB_NAME = "csashesi_beatrice-lungahu";
        $DB_USER = "csashesi_bl16";
        $DB_PWORD = "db!hiJ35";

        $link = mysqli_connect($DB_HOST, $DB_USER, $DB_PWORD, $DB_NAME);
        if ($link == false) {
            echo "not succesfull";
        }

        $username = $_REQUEST['UserName'];
        $password = $_REQUEST['randomPass'];


        $str_query = "SELECT * from MWC_SignUpCarPooling WHERE randomPass='$password' AND UserName='$username'";
        $result = mysqli_query($link, $str_query);
        $rowCount = mysqli_num_rows($result);

        if ($rowCount > 0) {
            echo '{"result":1,"message": "SUpdated"}';
            $_SESSION['UserName'] = $username;
        } else {

            echo '{"result":0,"message": "unsuccessful"}';
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