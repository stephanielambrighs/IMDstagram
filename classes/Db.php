<?php


require_once(__DIR__ . "/../autoload.php");


class Db {

    private static $conn;

    public static function getConnection()
    {
        include(__DIR__ . "/../settings/settings.php");
        if (self::$conn === null) {
            $host = $config['DB_HOST'];
            $dbname = $config['DB_DATABASE'];
            $port = $config['DB_PORT'];
            self::$conn = new PDO(
                "mysql:host=$host;dbname=$dbname;port=$port",
                $config['DB_USERNAME'],
                $config['DB_PASSWORD']
            );
            $status = self::$conn->getAttribute(PDO::ATTR_CONNECTION_STATUS);
            return self::$conn;
        } else {
            return self::$conn;
        }
    }

    public static function getProfiles() {
        echo "😎-getProfiles";
        $conn = self::getConnection();
        $statement = $conn->prepare("SELECT id, bio FROM profiles");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($statement->errorInfo());

        $profilesList = [];
        foreach ($result as $db_profile) {
            $profile = new Profile ($db_profile['id'], $db_profile['bio']);
            array_push($profilesList, $profile);
        }
        return $profilesList;
    }

    public static function getAllGenres(){
        $conn = self::getConnection();
        $statement = $conn->prepare("SELECT id, name FROM genre");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($statement->errorInfo());

        $genreList = [];
        foreach($result as $db_genre){
            $genre = new Genre($db_genre['id'], $db_genre['name']);
            array_push($genreList, $genre);
        }
        return $genreList;
    }



    /*public static function uploadGenres($user){
        for ($i=1; $i < 4; $i++) {  //hardcoded?
            //var_dump("AAA-" . $_POST['genre' . $i]);

            $conn = self::getConnection();
            $statement = $conn->prepare("
                insert into profile_genre (profile_id, genre_id)
                values ((select id from profiles where id = (SELECT id FROM users WHERE email = :email)),
                       (select id from genre where id = :genre))
            ");
            $statement->bindValue(":email", $_SESSION['email']);
            $statement->bindValue(":genre", $_POST['genre' . $i]);
            $result_ = $statement->execute();
            //var_dump($result_);
        }

    }*/



    public static function get_current_time(){
        $now = new DateTime('now');
        return date_format($now, 'Y-m-d H:i:s');
    }


    public static function getAllPosts($limit, $userId){
        $conn = self::getConnection();
        $statement = $conn->prepare("
            SELECT *
            FROM posts

            /* Only posts with < 3 reports */
            WHERE (
                SELECT COUNT(id)
                FROM reports
                WHERE post_id = posts.id
            ) < 3

            AND (

                    /* 1) Posts of public profiles */
                    (
                        SELECT profile_private
                        FROM users
                        WHERE id = posts.user_id
                    ) = 0

                OR

                        /* 2) Posts of private profiles IF the current
                              logged in user is in list of followers
                              AND is accepted as a follower */
                        (
                            SELECT profile_private
                            FROM users
                            WHERE id = posts.user_id
                        ) = 1
                    AND
                        :loggedInUserId in (
                            SELECT follower_id
                            FROM followers
                            WHERE followers.user_id = posts.user_id
                            AND accepted = 1
                        )

                OR
                    /* 3) Posts of the user self */
                    user_id = :loggedInUserId

            )
            ORDER BY upload_date DESC
            LIMIT :limit
        ");

        $statement->bindValue(":limit", $limit, PDO::PARAM_INT);
        $statement->bindValue(":loggedInUserId", $userId);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($statement->errorInfo());

        $postList = [];
        foreach($result as $db_post){
            $post = new Post();
            $post->setId(intval($db_post['id']));
            $post->setTitle($db_post['title']);
            $post->setDescription($db_post['description']);
            $post->setGenre_id(intval($db_post['genre_id']));
            $post->setUpload_date($db_post['upload_date']);
            $post->setUser_id(intval($db_post['user_id']));
            $post->setType_id(intval($db_post['type_id']));
            $post->setFile_path($db_post['file_path']);
            array_push($postList, $post);
            // var_dump($postList);
        }
        return $postList;
    }

    public static function getAllPostsWithTag($limit, $tag){
        $conn = self::getConnection();
        $hashtag = '%'.$tag.'%';
        $statement = $conn->prepare("
            SELECT *
            FROM posts
            WHERE description LIKE :tag
            ORDER BY upload_date DESC
            LIMIT :limit
        ");

        $statement->bindValue(":limit", $limit, PDO::PARAM_INT);
        $statement->bindValue(":tag", $hashtag, PDO::PARAM_STR);
        // var_dump("Achter bindValue()");
        $statement->execute();
        // var_dump("Achter execute()");
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        // var_dump("Achter fetchAll()");
        // var_dump($statement->errorInfo());

        $postList = [];
        foreach($result as $db_post){
            $post = new Post();
            $post->setId($db_post['id']);
            $post->setTitle($db_post['title']);
            $post->setDescription($db_post['description']);
            $post->setGenre_id($db_post['genre_id']);
            $post->setUpload_date($db_post['upload_date']);
            $post->setUser_id($db_post['user_id']);
            $post->setType_id($db_post['type_id']);
            $post->setFile_path($db_post['file_path']);
            array_push($postList, $post);
            // var_dump($postList);
        }
        return $postList;
    }

    public static function getAllReportedPosts(){
        $conn = self::getConnection();
        $statement = $conn->prepare("
            SELECT *
            FROM posts
            WHERE (
                SELECT COUNT(id)
                FROM reports
                WHERE post_id = posts.id
            ) >= 3
            ORDER BY upload_date DESC
        ");
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($statement->errorInfo());

        $postList = [];
        foreach($result as $db_post){
            $post = new Post();
            $post->setId(intval($db_post['id']));
            $post->setTitle($db_post['title']);
            $post->setDescription($db_post['description']);
            $post->setGenre_id(intval($db_post['genre_id']));
            $post->setUpload_date($db_post['upload_date']);
            $post->setUser_id(intval($db_post['user_id']));
            $post->setType_id(intval($db_post['type_id']));
            $post->setFile_path($db_post['file_path']);
            array_push($postList, $post);
            // var_dump($postList);
        }
        return $postList;
    }

    public static function getAllReportedPostsWithTag($tag){
        $conn = self::getConnection();
        $hashtag = '%'.$tag.'%';
        $statement = $conn->prepare("
            SELECT *
            FROM posts
            WHERE description LIKE :tag
            ORDER BY upload_date DESC
        ");
        $statement->bindValue(':tag', $hashtag, PDO::PARAM_STR);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($statement->errorInfo());

        $postList = [];
        foreach($result as $db_post){
            $post = new Post();
            $post->setId($db_post['id']);
            $post->setTitle($db_post['title']);
            $post->setDescription($db_post['description']);
            $post->setGenre_id($db_post['genre_id']);
            $post->setUpload_date($db_post['upload_date']);
            $post->setUser_id($db_post['user_id']);
            $post->setType_id($db_post['type_id']);
            $post->setFile_path($db_post['file_path']);
            array_push($postList, $post);
            // var_dump($postList);
        }
        return $postList;
    }

    public static function getGenreById($genreId){
        // genre opvragen -> database
        // object maken en dit object teruggeven
        $conn = self::getConnection();
        $statement = $conn->prepare("SELECT * FROM `genre` WHERE id = :id");
        $statement->bindValue(":id", $genreId);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);

        $genre = new Genre($result['id'], $result['name']);
        // var_dump($genre);
        return $genre;
    }

    // public static function getGenreByName($genre_name){
    //     var_dump($genre_name);
    //     $conn = self::getConnection();
    //     $statement = $conn->prepare("SELECT id, name FROM `genre` WHERE LOWER(name) = :name");
    //     $statement->bindValue(':name', strtolower($genre_name));
    //     $statement->execute();
    //     $result = $statement->fetch(PDO::FETCH_ASSOC);
    //     var_dump($result);
    //     $genre = new Genre($result['id'], $result['name']);
    //     var_dump($statement->errorInfo());
    //     return $genre;
    // }


    public static function getUserByEmail($userEmail){
        $conn = self::getConnection();
        $statement = $conn->prepare("SELECT * FROM `users` WHERE email = :email");
        $statement->bindValue(":email", $userEmail);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $user = new User();
        $user->setId($result['id']);
        $user->setEmail($result['email']);
        $user->setUsername($result['username']);
        $user->setPassword($result['password']);
        $user->setFirstname($result['firstname']);
        $user->setLastname($result['lastname']);
        $user->setDateOfBirth($result['date_of_birth']);
        $user->setAdmin(boolval($result['admin']) ? true : false);
        return $user;
    }

    public static function getUserById($userId){
        $conn = self::getConnection();
        $statement = $conn->prepare("SELECT * FROM `users` WHERE id = :id");
        $statement->bindValue(":id", $userId);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $user = new User();
        $user->setId($result['id']);
        $user->setEmail($result['email']);
        $user->setUsername($result['username']);
        $user->setPassword($result['password']);
        $user->setFirstname($result['firstname']);
        $user->setLastname($result['lastname']);
        $user->setDateOfBirth($result['date_of_birth']);
        $user->setAdmin(boolval($result['admin']) ? true : false);
        return $user;
    }



    public static function insertProfileGenre($profile_id, $genre_id){
        $conn = self::getConnection();
        $statement = $conn->prepare("INSERT INTO profile_genre (profile_id, genre_id) VALUES (:profile_id, :genre_id);");
        $statement->bindValue(":profile_id", $profile_id); // not correct
        $statement->bindValue(":genre_id", $genre_id); // not correct
        $statement->execute();
    }


    public static function getProfileImgPath($userId){
        $conn = self::getConnection();
        $statement = $conn->prepare("SELECT profile_img_path FROM `users` WHERE id = :id");
        $statement->bindValue(":id", $userId);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return $result['profile_img_path'];
    }

    public static function checkIfReportExists($postId, $userId){
        $conn = self::getConnection();
        $statement = $conn->prepare("
            SELECT id
            FROM reports
            WHERE user_id = :user_id
            AND post_id = :post_id
        ");
        $statement->bindValue(':user_id', $userId);
        $statement->bindValue(':post_id', $postId);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        // var_dump($result);
        if (!$result) {
            return false;
        }
        else {
            return true;
        }
    }

    public static function addReport($postId, $userId){
        $conn = self::getConnection();
        $statement = $conn->prepare("
            INSERT INTO reports (`user_id`, `post_id`)
            VALUES (:user_id, :post_id);
        ");
        $statement->bindValue(':user_id', $userId);
        $statement->bindValue(':post_id', $postId);
        return $statement->execute();
    }

    public static function getReportCount($postId){
        $conn = self::getConnection();
        $statement = $conn->prepare("
            SELECT COUNT(*) AS reportcount
            FROM `reports`
            WHERE post_id = :post_id
        ");
        $statement->bindValue(':post_id', $postId);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        // var_dump($result['reportcount']);
        return $result['reportcount'];
    }


    public static function removeFromReports($postId){
        $conn = self::getConnection();
        $statement = $conn->prepare("
            DELETE FROM reports
            WHERE post_id = :post_id
        ");
        $statement->bindValue(':post_id', $postId);
        return $statement->execute();
    }

    public static function deletePost($postId){
        $conn = self::getConnection();
        $statement = $conn->prepare("
            DELETE FROM posts
            WHERE id = :post_id
        ");
        $statement->bindValue(':post_id', $postId);
        $result = $statement->execute();
        return $result;
    }



    public static function getFollowerRequests($userId){
        $conn = self::getConnection();
        $statement = $conn->prepare("
            SELECT follower_id
            FROM followers
            WHERE user_id = :user_id
            AND accepted = 0
        ");
        $statement->bindValue(":user_id", $userId);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        // create list with userids of the followers
        $followerIdList = [];
        foreach ($result as $followerId) {
            array_push($followerIdList, intval($followerId['follower_id']));
        }
        return $followerIdList;
    }

    public static function getFollowerRowId($userId, $followerId){
        $conn = self::getConnection();
        $statement = $conn->prepare("
            SELECT id
            FROM followers
            WHERE user_id = :user_id
            AND follower_id = :follower_id
        ");
        $statement->bindValue(":user_id", $userId);
        $statement->bindValue(":follower_id", $followerId);
        $statement->execute();
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        return intval($result['id']);
    }


    public static function setFollowerAccept($followersRowId, $accepted){
        $conn = self::getConnection();
        $statement = $conn->prepare("
            UPDATE followers
            SET accepted = :accepted
            WHERE id = :followers_row_id
        ");
        $statement->bindValue(":followers_row_id", $followersRowId);
        $statement->bindValue(":accepted", $accepted);
        $result = $statement->execute();
        // var_dump($result);
        return $result;
    }

    public static function deleteFollowersRow($followersRowId){
        $conn = self::getConnection();
        $statement = $conn->prepare("
            DELETE FROM followers
            WHERE id = :followers_row_id
        ");
        $statement->bindValue(":followers_row_id", $followersRowId);
        $result = $statement->execute();
        return $result;
    }

    public static function getAllPostsWithTitle($tag){
        $conn = self::getConnection();
        $title = '%'.$tag.'%';
        $statement = $conn->prepare("
            SELECT *
            FROM posts
            WHERE title LIKE :tag
            ORDER BY upload_date DESC
        ");

        $statement->bindValue(":tag", $title, PDO::PARAM_STR);
        //var_dump("Achter bindValue()");
        $statement->execute();
        //var_dump("Achter execute()");
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        //var_dump("Achter fetchAll()");
        //var_dump($statement->errorInfo());

        $postList = [];
        foreach($result as $db_post){
            $post = new Post();
            $post->setId($db_post['id']);
            $post->setTitle($db_post['title']);
            $post->setDescription($db_post['description']);
            $post->setGenre_id($db_post['genre_id']);
            $post->setUpload_date($db_post['upload_date']);
            $post->setUser_id($db_post['user_id']);
            $post->setType_id($db_post['type_id']);
            $post->setFile_path($db_post['file_path']);
            array_push($postList, $post);
            // var_dump($postList);
        }
        return $postList;
    }

    public static function getAllPostsWithTagSearch($tag){
        $conn = self::getConnection();
        $hashtag = '%'.$tag.'%';
        $statement = $conn->prepare("
            SELECT *
            FROM posts
            WHERE description LIKE :tag
            ORDER BY upload_date DESC
        ");

        $statement->bindValue(":tag", $hashtag, PDO::PARAM_STR);
        //var_dump("Achter bindValue()");
        $statement->execute();
        //var_dump("Achter execute()");
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        //var_dump("Achter fetchAll()");
        //var_dump($statement->errorInfo());

        $postList = [];
        foreach($result as $db_post){
            $post = new Post();
            $post->setId($db_post['id']);
            $post->setTitle($db_post['title']);
            $post->setDescription($db_post['description']);
            $post->setGenre_id($db_post['genre_id']);
            $post->setUpload_date($db_post['upload_date']);
            $post->setUser_id($db_post['user_id']);
            $post->setType_id($db_post['type_id']);
            $post->setFile_path($db_post['file_path']);
            array_push($postList, $post);
            // var_dump($postList);
        }
        return $postList;
    }

    public static function getAllPostsWithLocation($tag){
        $conn = self::getConnection();
        $location = '%'.$tag.'%';
        $statement = $conn->prepare("
            SELECT *
            FROM posts
            WHERE location LIKE :tag
            ORDER BY upload_date DESC
        ");

        $statement->bindValue(":tag", $location, PDO::PARAM_STR);
        //var_dump("Achter bindValue()");
        $statement->execute();
        //var_dump("Achter execute()");
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        //var_dump("Achter fetchAll()");
        //var_dump($statement->errorInfo());

        $postList = [];
        foreach($result as $db_post){
            $post = new Post();
            $post->setId($db_post['id']);
            $post->setTitle($db_post['title']);
            $post->setDescription($db_post['description']);
            $post->setGenre_id($db_post['genre_id']);
            $post->setUpload_date($db_post['upload_date']);
            $post->setUser_id($db_post['user_id']);
            $post->setType_id($db_post['type_id']);
            $post->setFile_path($db_post['file_path']);
            array_push($postList, $post);
            // var_dump($postList);
        }
        return $postList;
    }


}