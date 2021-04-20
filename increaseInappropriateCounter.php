<?php

require_once("autoload.php");

if(!empty($_POST)){
    $postId = $_POST['postId'];
    $current_count = Db::getInappropriateCount($postId);
    $updateSuccess = Db::updateInappropriateCount($postId, ($current_count +1));
    if($updateSuccess){
        $response = [
            'status' => 'success',
            'messsage' => 'InappropriateCount increased by one',
            'count' => ($current_count +1)
        ];
    }
    else {
        $response = [
            'status' => 'failed',
            'messsage' => 'Failed to update InappropriateCount',
            'count' => $current_count
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
