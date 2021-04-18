<?php
    class Profile {
        private $id;
        private $bio;

        function __construct($id, $bio)
        {
            $this->id = $id;
            $this->bio = $bio;
        }


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
    }