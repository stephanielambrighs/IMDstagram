<?php

    include_once(__DIR__ . "/Db.php");

    class Profile 
    {
        private $id;
        private $bio;

        /*function __construct($id, $bio)
        {
            $this->id = $id;
            $this->bio = $bio;
        }*/


        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Get the value of bio
         */ 
        public function getBio()
        {
                return $this->bio;
        }
        // ======================================

        public static function loadProfile ($idTarget) {
            $conn = Db::getConnection();

            $statement = $conn->prepare("select * from users where id = :id");
            $statement->bindValue(':id', $idTarget);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            return $result;
        }

        public static function loadMyProfile ($email) {
            $conn = Db::getConnection();

            $statement = $conn->prepare("select * from users where email = :email");
            $statement->bindValue(':email', $email);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            return $result;
        }
    }