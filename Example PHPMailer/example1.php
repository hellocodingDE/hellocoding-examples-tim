<?php

$debug = true; // or
// $debug = false;

require_once "vendor/autoload.php";

try {
        // neue instanz der klasse erstellen
        $mail = new PHPMailer\PHPMailer\PHPMailer($debug);

        // gibt einen ausführlichen log aus
        if ($debug) { $mail->SMTPDebug = PHPMailer\PHPMailer\SMTP::DEBUG_SERVER; }
// }

        // authentifiziere dich über den smtp-login
        $mail->isSMTP();
        $mail->SMTPAuth = true;

        // login
        $mail->Host       = "deinedomain.de";
        $mail->Port       = "465";
        $mail->Username   = "email@deinedomain.de";
        $mail->Password   = 'password';
        // $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
        $mail->SMTPOptions = array(
            'ssl' => array(
                  'verify_peer' => false,
                  'verify_peer_name' => false,
                  'allow_self_signed' => true
            ),
            'tls' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $mail->setFrom("email@deinedomain.de", 'Dein Name');
        $mail->addAddress("hellocodingfeedback@tim-riedl.de", "Tim Riedl");
        // $mail->addAttachment("/home/webuser/Schreibtisch/Spiderman.png", "Spiderman.png");

        $mail->isHTML(true);
        $mail->Subject = utf8_encode("Hello World");
        $mail->Body    = utf8_encode("<h1>Hello</h1>");
        $mail->AltBody = utf8_encode("Hallo");

        $mail->send();

} catch (PHPMailer\PHPMailer\Exception $e) {
    echo "Message could not be sent. Mailer Error: ".$mail->ErrorInfo;
}
