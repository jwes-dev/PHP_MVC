<?php
class Email
{
    public static function Send($To, $Subject, $Body)
    {
        $From = "";
        $FriendlyName = "";
        $MailProvider = "";
        $Port = 0;
        $UserName = "";
        $Password = "";
        
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->CharSet = 'UTF-8'   ; 
        $mail->Host = "$MailProvider";
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->Port = 25;
        $mail->Username = "$UserName";
        $mail->Password = "$Password";    
        $mail->setFrom("$From", "$FriendlyName");
        $mail->addAddress("$To");
        $mail->isHTML(true);
        $mail->Subject = "$Subject";
        $mail->Body = $Body;
        $mail->AltBody= "";
        return $mail->send();
    }
}
?>