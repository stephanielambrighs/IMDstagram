<?php

require_once("autoload.php");

class Db {

    private static $conn;

    public static function getConnection()
    {
        include(__DIR__ . "/../settings/settings.php");
        if (self::$conn === null) {
            $host = $config['DB_HOST'];
            $dbname = $config['DB_DATABASE'];
            $port = $config['DB_PORT'];
            self::$conn = new PDO(
                "mysql:host=$host;dbname=$dbname;port=$port",
                $config['DB_USERNAME'],
                $config['DB_PASSWORD']
            );
            $status = self::$conn->getAttribute(PDO::ATTR_CONNECTION_STATUS);
            return self::$conn;
        } else {
            return self::$conn;
        }
    }

    public static function getAllGenres(){
        $conn = self::getConnection();
        $statement = $conn->prepare("SELECT id, name FROM genre");
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

    public static function insertPost($post){
        $conn = self::getConnection();
        $statement = $conn->prepare("
            INSERT INTO posts (`title`, `description`, `genre_id`, `upload_date`, `user_id`, `type_id`, `file_path`) 
            VALUES (:title, :description, :genre_id, :upload_date, :user_id, :type_id, :file_path);
        ");
        $statement->bindValue(':title', $post->getTitle());
        $statement->bindValue(':description', $post->getDescription());
        $statement->bindValue(':genre_id', $post->getGenre_id());
        $statement->bindValue(':upload_date', self::get_current_time());
        $statement->bindValue(':user_id', $post->getUser_id());
        $statement->bindValue(':type_id', $post->getType_id());
        $statement->bindValue(':file_path', $post->getFile_path());
        $result = $statement->execute();
        // var_dump($result);
        // var_dump($statement->errorInfo());
    }

    private static function get_current_time(){
        $now = new DateTime('now');
        return date_format($now, 'Y-m-d H:i:s');
    }

    // public static function getGenreByName($genre_name){
    //     var_dump($genre_name);
    //     $conn = self::getConnection();
    //     $statement = $conn->prepare("SELECT id, name FROM `genre` WHERE LOWER(name) = :name");
    //     $statement->bindValue(':name', strtolower($genre_name));
    //     $statement->execute();
    //     $result = $statement->fetch(PDO::FETCH_ASSOC);
    //     var_dump($result);
    //     $genre = new Genre($result['id'], $result['name']);
    //     var_dump($statement->errorInfo());
    //     return $genre;
    // }

}