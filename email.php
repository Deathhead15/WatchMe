<?php
require 'PHPMailer-master/PHPMailerAutoload.php';

$mail = new PHPMailer;

$mail->isSMTP();                                            // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';                             // Specify main and backup server
$mail->SMTPAuth = true;                                     // Enable SMTP authentication
$mail->Username = 'watchmeinc2015@gmail.com';                   // SMTP username
$mail->Password = 'dirkrhys15';                             // SMTP password
$mail->SMTPSecure = 'tls';                                  // Enable encryption, 'ssl' also accepted
$mail->Port = 587;                                          //Set the SMTP port number - 587 for authenticated TLS
$mail->setFrom('watchmeinc2015@gmail.com');                 //Set who the message is to be sent from
$mail->addReplyTo('', '');                                  //Set an alternative reply-to address
$mail->addAddress('');                                      // Name is optional
$mail->addCC('');
$mail->addBCC('');
$mail->WordWrap = 50;                                        // Set word wrap to 50 characters
$mail->addAttachment('');                                    // Add attachments
$mail->addAttachment('', '');                               // Optional name
$mail->isHTML(true);                                        // Set email format to HTML
$mail->Subject = 'Watch Me INC. Activation Code';
$mail->Body    = 'This is the Test Email message <b>in bold!</b>';
$mail->AltBody = 'This is the Test Email message in bold!';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
