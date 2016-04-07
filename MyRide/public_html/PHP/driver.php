<?php
include("adb.php");
class driver extends adb{
    function add_driver($driverId,$firstName,$lastName,$AssignedBus_ID){
        $str_query="INSERT INTO driver (DriverId,firstName,lastName,AssignedBus_ID) VALUES('$driverId','$firstName','$lastName','$AssignedBus_ID')";
        if($this->query($str_query)){
            return true;
        }
        else{
            return false;
        }
    }
    
    function edit_driver($driverId,$firstName,$lastName,$AssignedBus_ID){
        $str_query="UPDATE driver SET firstName='$firstName' lastName='$lastName' AssignedBus_ID='$AssignedBus_ID' WHERE DriverId='$driverId'";
        if($this->query($str_query)){
            return true;
        }
        else{
            return false;
        }
        
    }
    
    
}

?>
