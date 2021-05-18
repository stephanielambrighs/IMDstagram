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
            if(is_string($text)){
                $this->text = $text;
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
         * @return self
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
         * @return self
         */
        public function setUserId($userId)
        {
            if(is_int($userId)){
                $this->userId = $userId;
            }

            return $this;
        }

        public static function saveComment($userId, $postId, $text){
            $timeNow = new DateTime(Db::get_current_time());
            $time = $timeNow->format('Y-m-d H:i:s');
            //$datetime_object = datetime.strptime($timeNow, '%b %d %Y %I:%M%p')
            $conn = Db::getConnection();
            //$statement = $conn->prepare("insert into comments (user_id, post_id, text) values (:userId, :postId, :text)");

            $statement = $conn->prepare("insert into comments (user_id, post_id, comment_date, text) values (:userId, :postId, :timeNow, :text)");
            $statement->bindValue(':userId', $userId);
            $statement->bindValue(':postId', $postId);
            $statement->bindValue(':timeNow', $time, PDO::PARAM_STR);
            $statement->bindValue(':text', $text);


            $result = $statement->execute();
            return $result;
        }

        public static function getAllComments($postId){
            $conn = Db::getConnection();
            $statement = $conn->prepare("
                SELECT *
                FROM comments
                WHERE post_id = :postId
                ORDER BY comment_date ASC
            ");
          
            $statement->bindValue(":postId", $postId);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            // var_dump($statement->errorInfo());
    
            $commentList = [];
            foreach($result as $db_comment){
                $comment = new Comment();
                $comment->setId($db_comment['id']);
                $comment->setText($db_comment['text']);
                $comment->setPostId($db_comment['post_id']);
                $comment->setUserId($db_comment['user_id']);
                $comment->setCommentDate($db_comment['comment_date']);
                array_push($commentList, $comment);
            }
            return $commentList;
        }
    }