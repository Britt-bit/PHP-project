<?php
    include_once '../classes/Request.php';
    $id = $_POST['id'];
    $uid = $_POST['uid'];
    $response = [];
    if (Request::DeleteRequest($id, $uid)) {
        $response['status'] = 'Declined';
    } else {
        $response['status'] = 'something went wrong.';
    }
    header('Content-Type: application/json');
    echo json_encode($response);