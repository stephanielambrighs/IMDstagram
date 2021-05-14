<?php


class Post {
    private $id = 0;
    private $title = "";
    private $description = "";
    private $genre_id = 0;
    private $upload_date = 0;
    private $user_id = 0;
    private $type_id = 1;
    private $file_path = "";
    private $inactive = 0;



    // function __construct($id, $title, $description, $genre_id, $upload_date, $user_id, $type_id, $file_path)
    // {
    //     $this->id = $id;
    //     $this->title = $title;
    //     $this->description = $description;
    //     $this->genre_id = $genre_id;
    //     $this->upload_date = $upload_date;
    //     $this->user_id = $user_id;
    //     $this->type_id = $type_id;
    //     $this->file_path = $file_path;

    // }

    function __construct()
    {
    }

    public function getId()
    {
            return $this->id;
    }

    public function setId($id)
    {
        if (is_int($id)) {
            $this->id = $id;
        }
        return $this;
    }

    public function getTitle()
    {
            return $this->title;
    }

    public function setTitle($title)
    {
        if(is_string($title)){
            $this->title = $title;
        }
        return $this;
    }

    public function getDescription()
    {
            return $this->description;
    }

    public function setDescription($description)
    {
        if(is_string($description)){
            $this->description = $description;
        }
        return $this;
    }

    public function getGenre_id()
    {
            return $this->genre_id;
    }

    public function setGenre_id($genre_id)
    {
        if(is_int($genre_id)){
            $this->genre_id = $genre_id;
        }
        return $this;
    }

    public function getUpload_date()
    {
            return $this->upload_date;
    }

    public function setUpload_date($upload_date)
    {
            $this->upload_date = $upload_date;

            return $this;
    }

    public function getUser_id()
    {
            return $this->user_id;
    }

    public function setUser_id($user_id)
    {
        if(is_int($user_id)){
            $this->user_id = $user_id;
        }
        return $this;
    }

    public function getType_id()
    {
            return $this->type_id;
    }

    public function setType_id($type_id)
    {
        if(is_int($type_id)){
            $this->type_id = $type_id;
        }
        return $this;
    }

    public function getFile_path()
    {
            return $this->file_path;
    }

    public function setFile_path($file_path)
    {
        if(is_string($file_path)){
            $this->file_path = $file_path;
        }
        return $this;
    }

    /**
     * Get the value of inactive
     */
    public function getInactive()
    {
        return $this->inactive;
    }

    /**
     * Set the value of inactive
     *
     * @return  self
     */
    public function setInactive($inactive)
    {
        if(is_bool($inactive)){
            $this->inactive = $inactive;
        }
        return $this;
    }


    public function searchPost(){
            $conn = Db::getConnection();
            $searchPostInput = $this->getTitle();
            $statement = $conn->prepare("SELECT title FROM posts WHERE title LIKE '%$searchPostInput%'");
            $statement->execute();
            $searchPostOutput = array();
            $searchPostOutput[] = $statement->fetchall();
            return $searchPostOutput;
    }



    public function getUploadedTimeAgo()
    {
        // calculate time difference
        $timeUploaded = new DateTime($this->getUpload_date());
        $timeNow = new DateTime(Db::get_current_time());
        $timeDelta = $timeUploaded->diff($timeNow);

        // years ago
        if($timeDelta->y > 1){
            return $timeDelta->y . " years ago";
        }
        else if($timeDelta->y > 0){
            return $timeDelta->y . " year ago";
        }

        // months ago
        if($timeDelta->m > 1){
            return $timeDelta->m . " months ago";
        }
        else if($timeDelta->m > 0){
            return $timeDelta->m . " month ago";
        }

        // days ago
        if($timeDelta->d > 1){
            return $timeDelta->d . " days ago";
        }
        else if($timeDelta->d > 0){
            return $timeDelta->d . " day ago";
        }

        // hours ago
        if($timeDelta->h > 1){
            return $timeDelta->h . " hours ago";
        }
        else if($timeDelta->h > 0){
            return $timeDelta->h . " hour ago";
        }

        // minutes ago
        if($timeDelta->i > 1){
            return $timeDelta->i . " minutes ago";
        }
        else if($timeDelta->i > 0){
            return $timeDelta->i . " minute ago";
        }

        // seconds ago
        if($timeDelta->s > 1){
            return $timeDelta->s . " seconds ago";
        }
        else if($timeDelta->s > 0){
            return $timeDelta->s . " second ago";
        }


        return "1 second ago";
    }

    public function insert(){
        $conn = Db::getConnection();
        $statement = $conn->prepare("
            INSERT INTO posts (`title`, `description`, `genre_id`, `upload_date`, `user_id`, `type_id`, `file_path`, `inactive`)
            VALUES (:title, :description, :genre_id, :upload_date, :user_id, :type_id, :file_path, :inactive);
        ");
        $statement->bindValue(':title', $this->getTitle());
        $statement->bindValue(':description', $this->getDescription());
        $statement->bindValue(':genre_id', $this->getGenre_id());
        $statement->bindValue(':upload_date', Db::get_current_time());
        $statement->bindValue(':user_id', $this->getUser_id());
        $statement->bindValue(':type_id', $this->getType_id());
        $statement->bindValue(':file_path', $this->getFile_path());
        $statement->bindValue(":inactive", $this->getInactive());
        $result = $statement->execute();
        // var_dump($result);
        // var_dump($statement->errorInfo());
    }


}




?>