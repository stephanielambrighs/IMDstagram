<?php
require_once("autoload.php");

if(!empty($_POST)){
    $postId = $_POST['postId'];
    $userId = $_POST['userId'];

    if (Db::checkIfArchieveExists($postId, $userId)){
        $response = [
            'status' => 'failed',
            'messsage' => 'User already reported this post'
        ];
    }
    else {
        $addSuccess = Db::addArchieve($postId, $userId);
        if($addSuccess){
            $response = [
                'status' => 'success',
                'messsage' => 'Added entry to reports table'
            ];
        }
        else {
            $response = [
                'status' => 'failed',
                'messsage' => 'Failed to add entry to reports table'
            ];
        }
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
