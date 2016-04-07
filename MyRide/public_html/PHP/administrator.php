<?php

/**
* author: Beatrice Migaliza Lung'ahu
* date: 9th February,2016
* description: class containing database queries on the administrator tableau
*/

include("adb.php");

class administrator extends adb{
    
    /**
     * function to sign up an individual
     */    
    function Management_signUP($agence,$companyEmail,$phoneNumber,$location,$randomPass){
        
        $str_query="INSERT INTO administartor (AgencyName, email,PhoneNumber, Assigned_pass,Location) VALUES('$agence','$companyEmail','$phoneNumber','$randomPass','$location')";
        if($this->query($str_query)){
            /*$to=$companyEmail;
            $Subject = "Hello ".$agence. "Your password is ".$randomPass;
            $additional_headers = 'From: MyRide <migaliza.lyza@gmail.com>'
            mail($to, $subject, $message, $additional_headers)*/
            return true;
        }
        else{
            return false;
        }

    }
    
    function management_login($email,$password){
        //SELECT AgencyName, location FROM administartor WHERE email='easy.coach@gmail.com' AND Assigned_pass='dckMS7aebjD'
        $str_query="SELECT AgencyName, location FROM administartor WHERE email='$email' AND Assigned_pass='$password'";
        if($this->query($str_query)){
            return true;
        }
        else{
            return false;
        }
    }
    
    
}

?>
