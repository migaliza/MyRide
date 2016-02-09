<?php

/**
* author: Beatrice Migaliza Lung'ahu
* date: 9th February,2016
* description: class containing database queries on the administrator tableau
*/

include("adb.php");

class administrator extends adb{
    
    function add_new_admin($name,$password,$agence){
        $str_query="INSERT INTO administrator (Admin_name,Admin_password,Agence) VALUES('$name','$password','$agence')";
        if(!$this->query($str_query)){
            return false;
        }
        return false;
    }
    
    
}

?>
