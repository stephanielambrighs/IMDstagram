 <?php
    require_once(__DIR__."/../autoload.php");

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
            $time = $timeNow->format('Y-m-d H:i:s');
            //$datetime_object = datetime.strptime($timeNow, '%b %d %Y %I:%M%p')
            $conn = Db::getConnection();
            $statement = $conn->prepare("insert into comments (user_id, post_id, comment_date, text) values (:userId :postId, :timeNow, :text)");

            $statement->bindValue(':userId', $this->userId);
            $statement->bindValue(':postId', $this->postId);
            $statement->bindValue(':timeNow', $time, PDO::PARAM_STR);
            $statement->bindValue(':text', $this->text);


            $result = $statement->execute();
            var_dump($result);

            return $result;
        }
    }