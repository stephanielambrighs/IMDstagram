<?php

include_once(__DIR__ . "/../classes/Db.php");

if(!empty($_POST)){
    $postId = $_POST['postId'];

    $reportCount = Db::getReportCount($postId);
    $response = [
        'reportcount' => $reportCount
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
}
