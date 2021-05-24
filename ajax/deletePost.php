<?php

include_once(__DIR__ . "/../classes/Db.php");

if(!empty($_POST)){
    $postId = $_POST['postId'];

    // first delete reports for post to avoid constraint errors
    $deleteReportsSuccess = Db::removeFromReports($postId);
    if ($deleteReportsSuccess){

        // now delete the post
        $deletePostSuccess = Db::deletePost($postId);


        if ($deletePostSuccess){
            $response = [
                'status' => 'success',
                'message' => 'Successfully deleted post ' . $postId . ' from database'
            ];
        }
        else {
            $response = [
                'status' => "failed",
                'message' => 'Failed to delete post ' . $postId . ' from database'
            ];
        }

    }else {
        $response = [
            'status' => "failed",
            'message' => 'Failed to remove reports for post ' . $postId
        ];
    }



    header('Content-Type: application/json');
    echo json_encode($response);
}
