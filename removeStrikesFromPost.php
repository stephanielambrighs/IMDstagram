<?php

require_once("autoload.php");

if(!empty($_POST)){
    $postId = $_POST['postId'];

    $deleteSuccess = Db::removeFromReports($postId);
    if ($deleteSuccess){
        $response = [
            'status' => 'success',
            'message' => 'Successfully removed strikes for post ' . $postId

        ];
    }
    else{
        $response = [
            'status' => "failed",
            'message' => 'Failed to remove strikes for post ' . $postId
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($response);
}
