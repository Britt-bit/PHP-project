<?php
    include_once '../classes/User.php';
    include_once '../classes/Db.php';
    $email = $_POST['email'];
    $response = [];
    if (User::usernameCheck($email)) {
        $response['status'] = 'success';
    } else {
        $response['status'] = 'error';
    }
    header('Content-Type: application/json');
    echo json_encode($response);
