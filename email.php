<?php
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require 'vendor/autoload.php';

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    //Loading of php dotenv file for development environment only (not required for prod. env.)
    if (file_exists(".env")) {
        require("vendor/autoload.php");
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();
    }

    try {
        //Server settings - Using Gmail SMTP with TLS encryption:
        $mail->SMTPDebug = 0;//SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->SMTPSecure = "TLS";            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->Username   = 'tkt4332@gmail.com';//$_ENV["USERNAME"];                     //SMTP username
        $mail->Password   = 'simz1653';//$_ENV["PASSWORD"];                               //SMTP password


        //Recipients
        $mail->setFrom('tkt4332@gmail.com', "TK from SM");
        //$mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
        $mail->addAddress($_POST["useremail"]);               //Name is optional
        $mail->addReplyTo('tkt4332@gmail.com');
        //$mail->addCC('_______@gmail.com');
        //$mail->addBCC('bcc@example.com');

        //Attachments
        //File attachment:
        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //$mail->addAttachment('./public/droplet.jpg', 'new.jpg');    //Optional name
        //String attachment:
        $mail->addStringAttachment($_SESSION["thepdf"], "Confirmation Letter.pdf");

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Interview Confirmation Letter';
        $mail->Body    = 'Please find your attached <b>confirmation letter</b> below.';
        $mail->AltBody = 'Please find your attached confirmation letter below.';

        $mail->send();
        
        $alert = "<script>alert('Email has been sent.')</script>";
        echo $alert;

        //header("Location: index.php"); /* Redirecting */
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
?>