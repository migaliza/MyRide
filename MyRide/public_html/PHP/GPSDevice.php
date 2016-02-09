<?php

/**
* author: Beatrice Migaliza Lung'ahu
* date: 9th February,2016
* description: class containing database queries on the GPSDevice tableau
*/

include ("adb.php");

class GPSDevice extends adb{

    /**
     * [[The add_GPS_Device]] is a function to add a new GPS device
     * @param [[Sting]] $name
     */
    
    function add_GPS_Device($Name,$latitude,$longitude,$address){
        $str_query = "INSERT INTO GPSDevice (Name,Longitude, Latitude,Address) VALUES('$Name','$latitude','$longitude','$address')";
        
        if($this->connect()){
            $this->query($str_query);
            return true;
        }
        return false;
        
    }
    
    
    function Overwrite_GPS_Lat_Longitude($longitude,$latitude,$Address){
        $str_query = "REPLACE INTO GPSDevice (Latitude, Longitude,Address) VALUES ('$latitude','$longitude','Address')";
        if($this-connect()){
            $this->query($str_query);
            return true;
        }
        return false;
        
    }
    
    
    function delete_GPS_Device($id){
        $str_query="DELETE FROM GPSDevice WHERE id='$id'";
        if($this->connect()){
            $this->query($str_query);
            return true;
        }
        return false;
    }
    
    
    function search_GPS_Device($name){
        $str_query="SELECT FROM GPSDevice WHERE name='$name'";
        if(!$this->query($str_query)){
            return false;
        }
        
        return true;
    }

}























?>