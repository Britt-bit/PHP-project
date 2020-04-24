<?php
    include_once '../classes/Request.php';
    $id = $_POST['id'];
    $uid = $_POST['uid'];
    $response = [];
    if (Request::AcceptRequest($id, $uid)) {
        $response['status'] = 'Accepted';
    } else {
        $response['status'] = 'something went wrong.';
    }
    header('Content-Type: application/json');
    echo json_encode($response);