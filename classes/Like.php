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
        $this->id = $id;

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
        $this->postId = $postId;

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
        $this->userId = $userId;

        return $this;
    }


    public function clickLike(){
        $conn = Db::getConnection();
        $statement = $conn->prepare("INSERT INTO post_likes (user_id, post_id) VALUES (51, 74)");
        $statement->execute();
        $succes = 'Gelukt';
        return $succes;
    }
}