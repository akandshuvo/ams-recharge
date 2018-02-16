<?php
require 'mailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.mailtrap.io';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'a24b27f3bb5e4e';                 // SMTP username
$mail->Password = '19ca5824ba8d12';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 25;                                    // TCP port to connect to

$mail->setFrom('from@example.com', 'Mailer');
$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
$mail->addAddress('ellen@example.com');               // Name is optional
$mail->addReplyTo('info@example.com', 'Information');
$mail->addCC('cc@example.com');
$mail->addBCC('bcc@example.com');

$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Here is the subject';
$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
?>
<script>
    new PNotify({
        title: 'Success!',
        text: 'Email Has been sent to <?php echo "akandshuvo@hotmail.com";?>',
        delay: 6000,
        type: 'error',
        desktop: {
            desktop: true
        }
    });
</script>

<?php
} else {
?>
<script>
    PNotify.desktop.permission();
    (new PNotify({
        title: 'Desktop Success',
        text: 'If you\'ve given me permission, I\'ll appear as a desktop notification. If you haven\'t, I\'ll still appear as a regular PNotify notice.',
        type: 'success',
        desktop: {
            desktop: true
        },
        Mobile: {
            swipe_dismiss: true, //- Let the user swipe the notice away.
            styling: true // Styles the notice to look good on mobile.
        }
    })).get().click(function(e) {
        if ($('.ui-pnotify-closer, .ui-pnotify-sticker, .ui-pnotify-closer *, .ui-pnotify-sticker *').is(e.target)) return;
        alert('Hey! You clicked the desktop notification!');
    });
</script>

<?php
}
?>