<?php

use App\Formmail\Mailer;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;


require '../vendor/autoload.php';
$data = json_decode( file_get_contents('php://input') );

$config = [
    'host' => 'fzwz-kxnw.accessdomain.com',
    'port' => '587',
    'smtpAuth' => true,
    'username' => 'bhome@tzetze-estudio.com',
    'password' => 'FN82?{amps',
    'reply' => 'bhome@tzetze-estudio.com',
    'reply-name' => 'Form user',
    'reply-name' => 'subject',
    'alt-text' => 'Text for user contact',
    'mailTo' => [
        ['address' => 'bhome@tzetze-estudio.com', 'name' => 'Form'],
        ['address' => 'info@bhomeenterprise.ca', 'name' => 'Form']
    ],
    'subject' => 'Mail from bhome website'
];

$content = [
    '{{name}}' => utf8_decode($data->first_name),
    '{{last_name}}' => utf8_decode($data->last_name),
    '{{email}}' => utf8_decode($data->email),
    '{{subject}}' => utf8_decode($data->subject),
    '{{message}}' => utf8_decode($data->message),
];


$mailer = new Mailer($content, $config);

$mail = $mailer->sendMail();

if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message sent!';
}

//Section 2: IMAP
//IMAP commands requires the PHP IMAP Extension, found at: https://php.net/manual/en/imap.setup.php
//Function to call which uses the PHP imap_*() functions to save messages: https://php.net/manual/en/book.imap.php
//You can use imap_getmailboxes($imapStream, '/imap/ssl', '*' ) to get a list of available folders or labels, this can
//be useful if you are trying to get this working on a non-Gmail IMAP server.
function save_mail($mail)
{
    //You can change 'Sent Mail' to any other folder or tag
    $path = '{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail';

    //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
    $imapStream = imap_open($path, $mail->Username, $mail->Password);

    $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
    imap_close($imapStream);

    return $result;
}
