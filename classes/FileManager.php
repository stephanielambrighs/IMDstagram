<?php 
require_once("autoload.php");

class FileManager {

    private static $files_location;

    public static function getLocation(){
        include_once(__DIR__ . "/../settings/settings.php");
        if(self::$files_location === null) {
            self::$files_location = $config['FILES_LOCATION'];
        }
        else {
            return self::$files_location;
        }
    }

    public static function uploadFile($file_name){
        
    }


}

?>