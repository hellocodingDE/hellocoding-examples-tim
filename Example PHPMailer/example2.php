<?php

$debug = true; // or
$debug = false;

require_once "vendor/autoload.php";

if(sendEMail('hellocodingfeedback@tim-riedl.de', 'Tim Riedl', 'Here is your Spiderman!', '<h1>Spiderman!</h1>', 'Spiderman!'))
{ echo "\nPasst! Schau mal in dein Postfach Spiderman ist da!\n"; }
else
{ echo "\nERROR! Ein interner Fehler ist aufgetreten! Die E-Mail konnte nicht korrekt zugestellt werden\n"; }

function sendEMail($receiver,$receiverName,$subject,$html,$text,$AttmFiles=array()){
    global $debug;

    $mail = new PHPMailer\PHPMailer\PHPMailer($debug);

    if ($debug)
    { $mail->SMTPDebug = PHPMailer\PHPMailer\SMTP::DEBUG_SERVER; }

    $mail->isSMTP();
    $mail->SMTPAuth   = true;
    $mail->Host       = "deinedomain.de";
    $mail->Port       = "465";
    $mail->Username   = "email@deinedomain.de";
    $mail->Password   = "";
    // $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS; // port 587
    $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS; // port 465
    $mail->CharSet    = 'utf-8';
    $mail->Debugoutput = 'html';
    $mail->SMTPOptions = array(
      'ssl' => array(
          'verify_peer' => false
          ,'verify_peer_name' => false
          ,'allow_self_signed' => true
      ),
      'tls' => array(
        'verify_peer' => false
        ,'verify_peer_name' => false
        ,'allow_self_signed' => true
      )
    );

    $mail->setFrom("email@deinedomain.de", 'Dein Name');
    $mail->addAddress($receiver, $receiverName);

    foreach($AttmFiles as $key => $value)
    { $mail->addAttachment($value, $key); }

    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $html;
    $mail->AltBody = $text;

    try {
        $mail->send();
        return true;
    } catch (PHPMailer\PHPMailer\Exception $e) {
        if($debug)
        { echo "Message could not be sent. Mailer Error: ".$mail->ErrorInfo; }
        return false;
    }
}
