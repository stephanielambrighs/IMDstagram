<?php
    include_once(__DIR__ . "/../classes/Comment.php");

    $user = $_SESSION['legato-user'];
    $userEmail = $user->getEmail();
    $userId =  DB::getUserByEmail($userEmail)->getId();


    if(!empty($_POST)){
        //Nieuwe comment maken
        $c = new Comment();
        $c->setPostId($_POST('postId'));
        $c->setText($_POST('text'));
        $c->setUserId($userId); 

        //Comment opslaan
        $c->saveComment();

        //Seccues boodschap teruggeven
        $response = [
            'status' => 'succes',
            'body' => htmlspecialchars($c->getText()),
            'message' => 'Comment saved'
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
    }
?>