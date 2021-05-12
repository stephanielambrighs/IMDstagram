<?php 


class Post {
    private $id = 0;
    private $title = "";
    private $description = "";
    private $genre_id = 0;
    private $upload_date = 0;
    private $user_id = 0;
    private $type_id = 0;
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

        public static function search($input){
                $inputSearch = '%'.$input.'%';
                $conn = Db::getConnection();
                $statement = $conn->prepare("SELECT title FROM posts WHERE title LIKE :input");
                $statement->bindValue(':input', $inputSearch);
                $statement->execute();
                $searchPostOutput = array();
                $searchPostOutput[] = $statement->fetchall();
                return $searchPostOutput;
        }
}





?>