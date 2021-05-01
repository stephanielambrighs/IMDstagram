 <?php
    include_once(__DIR__ . "/Db.php");

    class Comment{
        private $text;
        private $postId;
        private $userId;

        /**
         * Get the value of text
         */
        public function getText()
        {
            return $this->text;
        }

        /**
         * Set the value of text
         * 
         * @return self
         */
        public function setText($text)
        {
            $this->text = $text;

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
         * @return self
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
         * @return self
         */
        public function setUserId($userId)
        {
            $this->userId = $userId;

            return $this;
        }

        public function saveComment(){
            $timeNow = new DateTime(Db::get_current_time());
            $conn = Db::getConnection();
            $statement = $conn->prepare("insert into comments (user_id, post_id, comment_date, text) values (:userId, :postId, :timeNow, :text)");
            
            $userId = $this->getUserId();
            $postId = $this->getPostId();
            $text = $this->getText();

            $statement->bindValue(":uderId", $userId);
            $statement->bindValue(":postId", $postId);
            $statement->bindValue(":timeNow", $timeNow);
            $statement->bindValue(":text", $text);

            $result = $statement->execute();
            return $result;
        }
    }