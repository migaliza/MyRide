<?php
/**
* author: Beatrice Migaliza Lung'ahu
* date: 9th February,2016
* description: class containing database queries on the busStops tableau
*/

include("adb.php");

class busStops extends adb{
    
    function add_new_busStop($name,$lon,$lat,$RouteId){
        $str_query="INSERT INTO busstops (Bus_Stop_Name, Longitude, Latitude, RouteId) values('$name','$lon','$lat','$RouteId')";
        if($this->query($str_query)){
            return true;
        }
        else{
            return false;
        }
    }
    
    
    function edit_busStop($ID,$name,$lon,$lat,$RouteId){
        $str_query="UPDATE busstops SET Bus_Stop_Name='$name' Longitude='$lon' Latitude='$lat' RouteId='$RouteId' WHERE Bus_Stop_Id='$ID'";
        if($this->query($str_query)){
            return true;
        }
        else{
            return false;
        }
    }
    
    
}

?>
