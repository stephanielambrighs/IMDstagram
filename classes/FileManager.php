<?php 

require_once("autoload.php");

class FileManager {

    private static $files_location;

    public static function getLocation()
    {
        if(self::$files_location === null) {
            include(__DIR__ . "/../settings/settings.php");
            self::$files_location = $config['FILES_LOCATION'];
            // $conn = Db::insertPost($this.);
            // self::$files_location = $conn;
            return self::$files_location;
        } else {
            return self::$files_location;
        }
    }

    public static function uploadFile($file){

        // var_dump($file);

        $fileName = basename($file["name"]);
        $fileSize = $file["size"]/1024;
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $fileTmpName = $file["tmp_name"];  

        // upload
        $target_dir = self::getLocation();
        $target_file = $target_dir . "/" . self::generateName($fileName, $fileType);

        // var_dump($target_file);
        var_dump($fileSize);

      
        
        if($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "gif" ) {
            return array (
                "success" => false,
                "message" => "Sorry, only JPG, JPEG, PNG & GIF files are allowed."
            );
        }
        else if ($fileSize > 2000) {
            // 2mb = 2000kb
            // niet groter dan 2mb uploaden
            return array (
                "success" => false,
                "message" => "Sorry, your file is too large (> 2MB)."
            );
        }

        self::compressImage($fileTmpName, $target_file, 40);
    
       
        // if ( move_uploaded_file($fileTmpName, $target_file)) {
        //     var_dump("The file ". htmlspecialchars($fileTmpName) . " has been uploaded.");
        // } else {
        //     var_dump("Sorry, there was an error uploading your file.");
        // }
    
        return array (
            "success" => true,
            "message" => "This file has been uploaded correctly.",
            "file_path" => $target_file
        );

    }

    private static function generateName($file_name, $file_type){
        $now = new DateTime('now');
        $new_file_name = date_format($now, 'Y-m-d-H-i-s') ."-". substr(base64_encode($file_name), 0,8) . "." . $file_type;
        return $new_file_name;
    }


    private static function compressImage($source, $destination, $quality){
        $info = getimagesize($source);

        if ($info['mime'] == 'image/jpeg') 
        $image = imagecreatefromjpeg($source);

        elseif ($info['mime'] == 'image/gif') 
        $image = imagecreatefromgif($source);

        elseif ($info['mime'] == 'image/png') 
        $image = imagecreatefrompng($source);

        imagejpeg($image, $destination, $quality);
    }

    }


?>