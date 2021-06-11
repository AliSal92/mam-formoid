<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once 'vendor/autoload.php';
if(isset($_POST['email'])){

    $to = $_POST['email'];

    $data = $_POST['form']['data'];

    $message = '<h1>Message from your website</h1>';
    foreach ($data as $field){
        $message .= '<p><b>'.$field[0].': </b> '.$field[1].'</p>';
    }
    //Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Recipients
        $mail->setFrom('website@clubunique.com', 'clubunique.com');
        $mail->addAddress($to);

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Landing Page | Clubunique.com';
        $mail->Body    = $message;

        $mail->send();
        http_response_code(200);
        echo '{"success":"Your message has been sent successfully."}';
        exit();
    } catch (Exception $e) {
        http_response_code(500);
        echo '{"error":"Please try again later."}';
    }

}