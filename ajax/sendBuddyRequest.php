<?php

    /* use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php'; */

    include_once '../classes/Request.php';
    include_once '../classes/Db.php';
    $id = $_POST['id'];
    $uid = $_POST['uid'];
    $email = $_POST['email'];
    $person = $_POST['person'];
    $response = [];
    if (Request::sendRequest($id, $uid, $email, $person)) {
        $response['status'] = 'success';

        /* //send email

        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'Buddiez.PHP@gmail.com';                     // SMTP username
            $mail->Password   = '4@1dgbo(w@93G8B';                               // SMTP password
            //$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            //$mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            $mail->Port       = 465;
            $mail->SMTPSecure = "ssl";

            //Recipients
            $mail->setFrom('Buddiez.PHP@gmail.com', 'Buddiez team');
            $mail->addAddress($email);     // Add a recipient

            $mail->smtpConnect(
                array(
                    "ssl" => array(
                        "verify_peer" => false,
                        "verify_peer_name" => false,
                        "allow_self_signed" => true
                    )
                )
            );

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'New Buddy request';
            $mail->Body    = 'You have a request from'. $person . '.';
            //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        } */
    } else {
        $response['status'] = 'something went wrong.';
    }
    header('Content-Type: application/json');
    echo json_encode($response);