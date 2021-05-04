<?php
    include_once(__DIR__ . "/../classes/Comment.php");
    include_once(__DIR__ . "/../classes/User.php");
    include_once(__DIR__ . "/../classes/Db.php");
    session_start();

    //$user = $_SESSION['legato-user'];
    //$userEmail = $user->getEmail();
    //$userId =  Db::getUserByEmail($userEmail)->getId();


    if(!empty($_POST)){
        //Nieuwe comment maken
        $c = new Comment();
        $userId = $c->setUserId(51);
        $postId = $c->setPostId(74);
        $text = $c->setText('Hallo');
 
        sleep(10);
        //Comment opslaan
        //$c->
        $c->saveComment($userId, $postId, $text);
        sleep(10);

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