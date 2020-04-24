<?php
    include_once '../classes/Request.php';
    include_once '../classes/Db.php';
    $id = $_POST['id'];
    $uid = $_POST['uid'];
    $response = [];
    if (Request::sendRequest($id, $uid)) {
        $response['status'] = 'success';
    } else {
        $response['status'] = 'something went wrong.';
    }
    header('Content-Type: application/json');
    echo json_encode($response);