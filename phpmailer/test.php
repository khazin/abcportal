<?php


/*
	PHPMailer tutorial
	Please visit alexwebdevelop.com
*/



/* Include PHPMailer autoloader */
require_once '../phpmailer/PHPMailerAutoload.php';

/* PHPMailer object */
$mail = new PHPMailer();

/* Sender (name is optional) */
$mail->setFrom('lithanm6@gmail.com', 'Admin');

/* Recipient (name is optional) */
$mail->addAddress($email, 'User1');

/* Subject */
$mail->Subject = 'Test Email';

/* Reply-to address */
//$mail->addReplyTo('vader@empire.com', 'Lord Vader');

/* CC */
//$mail->addCC('admiral@empire.com', 'Fleet Admiral');

/* BCC */
//$mail->addBCC('luke@rebels.com', 'Luke Skywalker');

/* Send message as HTML */
$mail->isHTML(TRUE);

/* Message body */
$mail->Body = "<html>Your new password: $newpassword[0]</html>";

/* Plain text alternative */
$mail->AltBody = "Your new password: $newpassword[0]";

/* Attachment */
//$mail->addAttachment('/home/darth/star_wars.mp3', 'Star_Wars_music.mp3');

/* Binary stream from a database blob field */
//$mysql_data = $mysql_row['blob_data'];
//$mail->addStringAttachment($mysql_data, 'db_data.db');

/* Binary network stream */
//$pdf_url = 'http://remote-server.com/file.pdf';
//$mail->addStringAttachment(file_get_contents($pdf_url), 'file.pdf');

/* Use a custom SMTP server */
$mail->isSMTP();

/* SMTP host */
$mail->Host = 'smtp.gmail.com';

/* SMTP TCP port */
$mail->Port = 465;

/* Use TSL secure connection */
$mail->SMTPSecure = 'ssl';

/* Enable authentication */
$mail->SMTPAuth = TRUE;

/* SMTP username */
$mail->Username = 'lithanm6@gmail.com';

/* SMTP password */
$mail->Password = 'H245hyt12';

/* Send the message */
if (!$mail->send())
{
    echo "Error: " . $mail->ErrorInfo;
}
else
{
    echo "Message sent.";
}
