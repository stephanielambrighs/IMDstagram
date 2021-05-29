<?php
    include_once(__DIR__ . "/../classes/Comment.php");
    include_once(__DIR__ . "/../classes/User.php");
    include_once(__DIR__ . "/../classes/Db.php");

        if(!empty($_POST)){
            //Nieuwe comment maken
            $userId = $_POST['userId'];
            $postId = $_POST['postid'];
            $text = $_POST['text'];

            //Comment opslaan
            $addCommentSuccess = Comment::saveComment($userId, $postId, $text);
            $getCommentsPost = Comment::getAllComments($postId);
            // $getTimeComment = Comment::getUploadedTimeAgo();
            //$c->saveComment();

            //Seccues boodschap teruggeven
                $response = [
                    'text' => htmlspecialchars($text)
                ];
            
            header('Content-Type: application/json');
            echo json_encode($response);
        }
?>