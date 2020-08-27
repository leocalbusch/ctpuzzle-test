<?php

    require("PHPMailer/src/PHPMailer.php");
    require("PHPMailer/src/SMTP.php");

    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';
    $mail->IsSMTP(); // enable SMTP
    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "calbusch.com.br";
    $mail->Port = 465; // or 587
    $mail->IsHTML(true);
    $mail->Username = "ctpuzzletest@calbusch.com.br";
    $mail->Password = "sSBAb&DLcN";
    $mail->SetFrom("ctpuzzletest@calbusch.com.br", "CT Puzzle Team");
    $mail->AddReplyTo("ctpuzzletest@calbusch.com.br", "CT Puzzle Team");
    $mail->Subject = $assuntoEmail;
    $mail->Body = $textoEmail;
    $mail->AddAddress($destinoEmail);
    if (!$mail->Send()) {
        $erro = "Ocorreu um erro no envio do e-mail. " . $mail->ErrorInfo;
        require "modalErro.php";
        exit();
    }

?>