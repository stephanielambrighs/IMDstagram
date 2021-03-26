<?php

class Db
{

    private static $conn;

    public static function getConnection()
    {
        include_once(__DIR__ . "/../settings/settings.php");
        $host = $config['DB_HOST'];
        var_dump($host);
        $dbname = $config['DB_DATABASE'];
        var_dump($dbname);
        $port = $config['DB_PORT'];
        if (self::$conn === null) {
            self::$conn = new PDO("mysql:host=$host;dbname=$dbname;port=$port",$config['DB_USERNAME'],$config['DB_PASSWORD']);
            $status = self::$conn->getAttribute(PDO::ATTR_CONNECTION_STATUS);
            var_dump($status);
            return self::$conn;
        } else {
            return self::$conn;
        }
    }
}