<?php
    include_once(__DIR__ . "/../classes/Comment.php");

    $user = $_SESSION['legato-user'];
    $userEmail = $user->getEmail();
    $userId =  DB::getUserByEmail($userEmail)->getId();


    if(!empty($_POST)){
        //Nieuwe comment maken
        $c = new Comment();
        $c->getPostId($_POST('postId'));
        $c->getText($_POST('text'));
        $c->getUserId($userId); 

        //Comment opslaan
        $c->saveComment();

        //Seccues boodschap teruggeven
        $response = [
            'status' => 'succes',
            'body' => htmlspecialchars($c->getText()),
            'message' => 'Comments saved'
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
    }
?>