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

    public static function getAllGenres(){
        echo "🥸";
        $conn = self::getConnection();
        var_dump($conn);
        $statement = $conn->prepare("SELECT id, name FROM genres");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        var_dump($statement->errorInfo());

        $genreList = [];
        foreach($result as $db_genre){
            $genre = new Genre($db_genre['id'], $db_genre['name']);
            array_push($genreList, $genre);
        }
        return $genreList;
    }
}