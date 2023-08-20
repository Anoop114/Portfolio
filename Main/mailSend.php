<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
$name;$eml;$sub;$msg;
if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $eml = $_POST['email'];
    $sub = $_POST['subject'];
    $msg = $_POST['message'];
}
if(isset($name) && isset($eml) && isset($sub) && isset($msg)){
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'anoopphi123@gmail.com';                     //SMTP username
        $mail->Password   = 'dqcprwbjbhstnhtw';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('anoopphi123@gmail.com', 'Portfolio');
        $mail->addAddress('Anoopkrsh22+Portfolio@gmail.com', $name);     //Add a recipient
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $sub;
        $mail->Body    = "Hello my name is <b>$name</b> <br><br>My Gmail is <b>$eml</b> <br><br>".$msg;
        $mail->AltBody = "Hello my name is $name \n and My Gmail is $eml \n".$msg;
    
        echo "pass";
        $mail->send();
    } catch (Exception $e) {
       // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        echo "";
    }
}else{
    echo "";
}




?>