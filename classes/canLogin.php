<?php

    include_once("../autoload.php");

    public function login($username, $password){
            
        if($username === "dev" && $password === "dev"){
            return true;
        }else{
            return false;
        }
    }
?>