<?php
    include_once(__DIR__ . "/../classes/Comment.php");
    include_once(__DIR__ . "/../classes/Db.php");
    session_start();

    $user = $_SESSION['legato-user'];
    $userEmail = $user->getEmail();
    $userId =  Db::getUserByEmail($userEmail)->getId();


    if(!empty($_POST)){
        //Nieuwe comment maken
        $c = new Comment();
        $postid = $c->setPostId($_POST('postid'));
        $text = $c->setText($_POST('text'));
        $userId = $c->setUserId($userId); 

        //Comment opslaan
        $c->saveComment($postid, $userId, $text);

        //Seccues boodschap teruggeven
        $response = [
            'status' => 'success',
            'body' => htmlspecialchars($c->getText()),
            'message' => 'Comment saved'
            
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
    }
?>