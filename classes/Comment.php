 <?php
    require_once(__DIR__."/../autoload.php");

    class Comment{
        private $id;
        private $text;
        private $postId;
        private $userId;
        private $commentDate;

        /**
         * Get the value of id
         */
        public function getId()
        {
            return $this->id;
        }

        /**
         * Set the value of text
         *
         * @return self
         */
        public function setId($id)
        {
            if(is_int($id)){
                $this->id = $id;
            }

            return $this;
        }

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

        /**
         * Get the value of commentDate
         */
        public function getCommentDate()
        {
            return $this->commentDate;
        }

        /**
         * Set the value of text
         *
         * @return self
         */
        public function setCommentDate($commentDate)
        {
            if(is_int($commentDate)){
                $this->commentDate = $commentDate;
            }

            return $this;
        }

        public function getUploadedTimeAgo()
    {
        // calculate time difference
        $timeUploaded = new DateTime($this->getCommentDate());
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


        //return "1 second ago";
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