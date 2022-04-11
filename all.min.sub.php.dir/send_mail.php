<?php

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


function send_smtp($subject,$body,$to)
{
    $mail = new PHPMailer(true);

    try {
        //Server settings
        // $mail->SMTPDebug = 2;                                       //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'mail.loangarage.co.in';                //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'sales@loangarage.co.in';               //SMTP username
        $mail->Password   = 'Abbasmiya@2021';                       //SMTP password
        $mail->SMTPSecure = 'ssl';                                  //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('sales@loangarage.co.in', 'Loangarage');
        $mail->addAddress($to);                                      //Add a recipient
    
    
        //Content
        $mail->isHTML(true);                                         //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $body;
    
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}


function otp_send($sub,$to)
{
    $msg="Please validate your request at loangarage.co.in with this OTP";
    return send_smtp($sub,$msg,$to);
}

function send_mail($to,$sub,$msg)
{
    if(!empty( $to ) && !empty( $sub ) && !empty( $msg ))
    {
        return send_smtp($sub,$msg,$to);
    }
    else
    {
        return;
    }
}

