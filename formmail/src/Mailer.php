<?php

namespace App\Formmail;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Mailer
{
    protected $data;
    protected $config;
    function __construct($data, $config)
    {
        $this->data = $data;
        $this->config = $config;
    }
    public function sendMail()
    {

        //Create a new PHPMailer instance
        $mail = new PHPMailer();

        //Tell PHPMailer to use SMTP
        $mail->isSMTP();

        //Enable SMTP debugging
        //SMTP::DEBUG_OFF = off (for production use)
        //SMTP::DEBUG_CLIENT = client messages
        //SMTP::DEBUG_SERVER = client and server messages
        $mail->SMTPDebug = SMTP::DEBUG_OFF;

        //Set the hostname of the mail server
        $mail->Host = $this->config['host'];
        //Use `$mail->Host = gethostbyname('smtp.gmail.com');`
        //if your network does not support SMTP over IPv6,
        //though this may cause issues with TLS

        //Set the SMTP port number:
        // - 465 for SMTP with implicit TLS, a.k.a. RFC8314 SMTPS or
        // - 587 for SMTP+STARTTLS
        $mail->Port = $this->config['port'];

        //Set the encryption mechanism to use:
        // - SMTPS (implicit TLS on port 465) or
        // - STARTTLS (explicit TLS on port 587)
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

        //Whether to use SMTP authentication
        $mail->SMTPAuth = $this->config['smtpAuth'];

        $mail->Username = $this->config['username'];
        $mail->Password = $this->config['password'];

        // $mail->setFrom('contacto@titikadelmar.com', 'Contact form');

        //Set an alternative reply-to address
        //This is a good place to put user-submitted addresses
        $mail->addReplyTo($this->config['reply'], $this->config['reply-name']);

        //Set who the message is to be sent to
        foreach($this->config['mailTo'] as $address ) {
            $mail->addAddress($address['address'], $address['name']);
        }

        //Set the subject line
        $mail->Subject = $this->config['subject'];

        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        $content = file_get_contents('contents.html');

        foreach( $this->data as $key => $val) {
            $content = str_replace($key, $val, $content);
        }
        $mail->msgHTML($content, __DIR__);

        //Replace the plain text body with one created manually
        $mail->AltBody = $this->config['alt-text'];
        return $mail;
    }
}
