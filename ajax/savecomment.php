<?php
    include_once(__DIR__ . "/../classes/Comment.php");
    include_once(__DIR__ . "/../classes/User.php");
    include_once(__DIR__ . "/../classes/Db.php");

    //$user = $_SESSION['legato-user'];
    //$userEmail = $user->getEmail();
    //$userId =  Db::getUserByEmail($userEmail)->getId();


    if(!empty($_POST)){
        //Nieuwe comment maken
        $c = new Comment();
        $userId = $c->setUserId($_POST['userId']);
        $postId = $c->setPostId($_POST['postid']);
        $text = $c->setText($_POST['text']);

        //Comment opslaan
        $addCommentSuccess = $c->saveComment();

        //Seccues boodschap teruggeven
        if($addCommentSuccess){
            $response = [
                'status' => 'success',
                'text' => htmlspecialchars($c->getText()),
                'message' => 'Comment saved'
            ];
        }
        else {
            $response = [
                'status' => 'failed',
                'messsage' => 'Failed to add a comment'
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }
?>