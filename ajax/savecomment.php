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
        //$c = new Comment();
        $postid = 74;
        $text = 'test';
        $userId = 81; 

        //Comment opslaan
        //$c->
        $save = saveComment($userId, $posrid, $text);

        //Seccues boodschap teruggeven
        $response = [
            'status' => 'success',
            'body' => htmlspecialchars($save->getText()),
            'message' => 'Comment saved'
            
        ];

        header('Content-Type: application/json');
        echo json_encode($response);
    }
?>