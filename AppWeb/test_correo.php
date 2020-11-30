<?php
include ("head.php");


$CorreoDestino = "printepolis@gmail.com";
$Asunto = "Test";
$ContenidoDelCorreo = "<p>Hola Mundo </p>";
// if (EnviarCorreo($CorreoDestino, $Asunto, $ContenidoDelCorreo) == TRUE){
//     Toast("Se ha enviado el correo a ".$CorreoDestino." correctamente",4,"");
// } else {
//     Toast("ERRRO al enviar el correo a ".$CorreoDestino." correctamente",2,"");
// }



$mail_dest = $CorreoDestino;
$Asunto=  "Test";
$contenido=  $ContenidoDelCorreo;



$MailHost = Preference("Mail-Host", "", ""); var_dump($MailHost);
$MailPort = Preference("Mail-Port", "", ""); var_dump($MailPort);
$MailSMTPSecure = Preference("Mail-SMTPSecure", "", ""); var_dump($MailSMTPSecure);
$MailUsername = Preference("Mail-Username", "", ""); var_dump($MailUsername);
$MailPassword = Preference("Mail-Password", "", ""); var_dump($MailPassword);



use lib\PHPMailer\PHPMailer\PHPMailer;
use lib\PHPMailer\PHPMailer\SMTP;
use lib\PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = $MailHost;
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = $MailUsername;
    $mail->Password   = $MailPassword;                              // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = $MailPort;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom($MailUsername, 'Mailer');
    $mail->addAddress($CorreoDestino, $Asunto);     // Add a recipient
    // $mail->addAddress('ellen@example.com');               // Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    // Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


include ("footer.php");
?>