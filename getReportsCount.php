<?php

require_once("autoload.php");

if(!empty($_POST)){
    $postId = $_POST['postId'];

    $reportCount = Db::getReportsCount($postId);
    $response = [
        'reportcount' => $reportCount
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
}
