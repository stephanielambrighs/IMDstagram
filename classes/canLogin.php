<?php

    include_once(__DIR__."./Db.php");
    
    getConnection();

    function login($username, $password){
            
        if($username === "dev" && $password === "dev"){
            return true;
        }else{
            return false;
        }
    }
?>