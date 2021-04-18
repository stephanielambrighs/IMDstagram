<?php
include_once(__DIR__ . "/Db.php");

class Tag
{
    private $id;
    private $tag;

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
     * Get the value of email
     */ 
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }
    
    public function searchTag(){
        $conn = Db::getConnection();
        $searchTagInput = $this->getTag();
        $statement = $conn->prepare("SELECT tag FROM tags WHERE tag LIKE '%$searchTagInput%'");
        $statement->execute();
        $searchTagOutput = array();
        $searchTagOutput[] = $statement->fetchall();
        return $searchTagOutput;
    }





}
