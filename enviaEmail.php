<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    #$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'ctpuzzletest@gmail.com';                     //SMTP username
    require "enviaEmailS.php";                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom("ctpuzzletest@gmail.com", "CT Puzzle Team");
    $mail->addAddress($destinoEmail);     //Add a recipient
    $mail->addReplyTo("ctpuzzletest@gmail.com", "CT Puzzle Team");
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $assuntoEmail;
    $mail->Body = $textoEmail;
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if (!$mail->Send()) {
        $erro = "Ocorreu um erro no envio do e-mail. " . $mail->ErrorInfo;
        require "modalErro.php";
        exit();
    }    
} catch (Exception $e) {
    $erro = "Ocorreu um erro no envio do e-mail. " . $mail->ErrorInfo;
    require "modalErro.php";
    exit();
}


?>