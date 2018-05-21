<?php
require_once "mailer/PHPMailerAutoload.php";


function send_pwd_reset_mail($email, $token)
{
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->CharSet = 'UTF-8';

    // WRITE THE SMTP SERVER DETAILS BELOW
    $mail->Host       = "mail.somesite.com";
    $mail->SMTPDebug  = 0;
    $mail->SMTPAuth   = true;
    $mail->Port       = 25;

    
    //GIVE THE USERNAME AND PASSWORD OF THE SMTP SERVER HERE
    $mail->Username   = "";
    $mail->Password   = "";  


    $mail->setFrom('someone@example.com', 'john Doe');
    $mail->addAddress("$Email");
    $mail->isHTML(true);


    $mail->Subject = 'Access Update';


    // WRITE THE EMAIL BODY WITH DESIGN BELOW
    $mail->Body = "";
    $mail->AltBody = 'Click to complete registration : <a href="http://previews.appley.io/AkamaiCDN/ContinueRegistration.php?ref=$token">Continue Registration</a>';
    return $mail->send();
}

function send_mail_event_ack($to)
{
    
}
?>