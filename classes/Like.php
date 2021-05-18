<?php

require_once(__DIR__ . "/../autoload.php");

class Like {
    private $id;
    private $postId;
    private $userId;

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        if(is_int($id)){
            $this->id = $id;
        }

        return $this;
    }

    /**
     * Get the value of postId
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * Set the value of postId
     *
     * @return  self
     */
    public function setPostId($postId)
    {
        if(is_int($postId)){
            $this->postId = $postId;
        }

        return $this;
    }

    /**
     * Get the value of userId
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set the value of userId
     *
     * @return  self
     */
    public function setUserId($userId)
    {
        if(is_int($userId)){
            $this->userId = $userId;
        }

        return $this;
    }

    public static function setClickLike($postId, $userId){
        $conn = Db::getConnection();

        $statement = $conn->prepare("SELECT active FROM post_likes WHERE user_id = :userId AND post_id = :postId");
        $statement->bindValue("postId", $postId);
        $statement->bindValue("userId", $userId);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        if($result === false){
            $var = 'like';
            $statement = $conn->prepare("INSERT INTO post_likes (user_id, post_id, active) VALUES (:userId, :postId, 1)");
            $statement->bindValue("postId", $postId);
            $statement->bindValue("userId", $userId);
            $result = $statement->execute();
        }
        else{
            $statement = $conn->prepare("
            UPDATE post_likes
            SET active = :active
            WHERE user_id = :userId
            AND post_id = :postId
            ");

            $statement->bindValue("postId", $postId);
            $statement->bindValue("userId", $userId);

            if($result['active'] === '0'){
                $var = 'unlike';
                $statement->bindValue(":active", 1);
            }
            else{
                $var = 'like';
                $statement->bindValue(":active", 0);
            }
            $result = $statement->execute();
        }

        if($result){
            return $var;
        }
        else{
            return "error";
        }


    }

    public static function getNumberLike($postId){
        $conn = Db::getConnection();
        $statement = $conn->prepare("
            SELECT COUNT(id)
            FROM post_likes
            WHERE post_id = :postId
            AND active = 1
        ");
        $statement->bindValue(':postId', $postId);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        //var_dump($result);
        return $result['COUNT(id)'];
    }

    public static function getLikeStatusUser($postId, $userId){
        $conn = Db::getConnection();
        $statement = $conn->prepare("
            SELECT COUNT(id)
            FROM post_likes
            WHERE post_id = :postId
            AND user_id = :userId
            AND active = 1
        ");
        $statement->bindValue(':postId', $postId);
        $statement->bindValue(':userId', $userId);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        // var_dump($result);
        // var_dump("post: ".$postId);
        // var_dump("user: ".$userId);

        if($result['COUNT(id)'] == 0){
            $var = 'like';
        }
        else {
            $var = 'unlike';
        }

        return $var;
    }
}