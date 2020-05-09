<?php
include_once(__DIR__ . "/Db.php");


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
class Request
{

    public function getRequest($id)
    {
        $conn = Db::getConnection();

        $statement = $conn->prepare("SELECT * FROM buddy WHERE buddy_id = :id OR seeker_id = :id ");
        $statement->bindParam(':id', $id);
        $statement->execute();
        $request = $statement->fetch();
        return $request;
    }

    public function getbuddyrequest()
    {
    }


    public function sendRequest($id, $uid, $email, $person)
    {
        try {
            $conn = Db::getConnection();

            $statement = $conn->prepare("INSERT INTO buddy (buddy_id, seeker_id, request) VALUES (:buddy_id, :seeker_id , 1)");
            $statement->bindParam(':buddy_id', $id);
            $statement->bindParam(':seeker_id', $uid);
            $statement->execute();

            //send email

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

                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'New Buddy request';
                $mail->Body    = 'You have a request from'. $person . '.';
                //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                return true;
            } catch (Exception $e) {
                return false;
            }


            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function AcceptRequest($id, $uid)
    {
        try {
            $conn = Db::getConnection();

            $statement = $conn->prepare("UPDATE buddy SET `accepted`= 1, `request`= 0 WHERE `buddy_id`= $id AND`seeker_id`= $uid");
            $statement->execute();

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function DeleteRequest($id, $uid)
    {
        try {
            $conn = Db::getConnection();

            $statement = $conn->prepare("UPDATE buddy SET `accepted`= 0, `request`= 0  WHERE `buddy_id`= $id AND`seeker_id`= $uid OR `buddy_id`= $uid AND`seeker_id`= $id");
            $statement->execute();

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function getseeker($id)
    {

        $conn = Db::getConnection();

        $statement = $conn->prepare("select user_id, firstname, lastname from user WHERE user_id in(SELECT seeker_id FROM buddy WHERE buddy_id = :id) LIMIT 1");
        $statement->bindParam(':id', $id);
        $statement->execute();
        $request = $statement->fetch();
        return $request;
    }

    public function getbuddy($id)
    {

        $conn = Db::getConnection();

        $statement = $conn->prepare("select user_id, firstname, lastname from user WHERE user_id in(SELECT buddy_id FROM buddy WHERE seeker_id = :id) LIMIT 1");
        $statement->bindParam(':id', $id);
        $statement->execute();
        $request = $statement->fetch();
        return $request;
    }

    public function mailto($email)
    {
        $to = $email;
        $subject = 'Buddy Request';
        $message = '
                <html>
                    <head>
                        <title>You have a Buddy request</title>
                    </head>
                    <body>
                        <p>You have a buddy request.</p>                  
                    </body>
                </html>';
        $headers  = "Content-type: text/html; charset=utf-8 \r\n";
        $headers .= "From: Buddiez <info@buddiez.com>\r\n";
        mail($to, $subject, $message, $headers);
    }
}
