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
            $this->id = $id;

            return $this;
    }

    public function getTitle()
    {
            return $this->title;
    }

    public function setTitle($title)
    {
            $this->title = $title;

            return $this;
    }

    public function getDescription()
    {
            return $this->description;
    }

    public function setDescription($description)
    {
            $this->description = $description;

            return $this;
    }

    public function getGenre_id()
    {
            return $this->genre_id;
    }

    public function setGenre_id($genre_id)
    {
            $this->genre_id = $genre_id;

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
            $this->user_id = $user_id;

            return $this;
    }

    public function getType_id()
    {
            return $this->type_id;
    }

    public function setType_id($type_id)
    {
            $this->type_id = $type_id;

            return $this;
    }

    public function getFile_path()
    {
            return $this->file_path;
    }

    public function setFile_path($file_path)
    {
            $this->file_path = $file_path;

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

}




?>