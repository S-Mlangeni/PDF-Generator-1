<?php
session_start();

// For PHP mailer:
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Requiring the Composer autoloader for Dompdf:
require 'vendor/autoload.php';

$username = htmlspecialchars($_POST["username"]); /* "htmlspecialchars" is
used to convert as submitted javascript code, which could redirect to a malicious
site, to html characters or plain text */
$jobPosition = htmlspecialchars($_POST["jobPosition"]);
$availableDate = htmlspecialchars($_POST["availableDate"]);
$availableTime = htmlspecialchars($_POST["availableTime"]);
if (empty($_POST["specialNote"])) {
    $specialNote = "None";
} else {
    $specialNote = htmlspecialchars($_POST["specialNote"]);
}

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$ourpdf = new Dompdf();
//Using output buffer function to generate html content:
ob_start();
?>

<!--Html content for ouput buffer below-->
<div class="wrapper">
    <h1 style="align-self: center">Interview Confirmation Letter </h1>
    <p>Dear <?php echo $username ?>,</p>
    <p>I am contacting you to confirm the date and time of your job interview for 
        <?php echo $jobPosition ?> position.
    </p>
    <p>The goal of this interview is for us to get to know you better. We also want 
        to learn about your goals and expectations to see if this position is a 
        good match for you.
    </p>
    <p>Here are the interview details:</p>
    <ul>
        <li><?php echo $availableDate ?></li>
        <li><?php echo $availableTime ?></li>
        <li>SM, Woodmead Drive, Woodmead</li>
        <li><?php echo $username ?> : <?php echo $jobPosition ?></li>
        <li>Special Note(s) : <?php echo "$specialNote" ?></li>
    </ul>
    <p>In case you have any additional questions, please don't hesitate to ask.</p>
    <p>We are looking forward to get to know you in person!</p>
    <p>Kind regards,</p>
    <p>SM</p>
</div>

<style>
    .wrapper h1 {
       text-align: center;
    } /* Note that css flexbox and grid are not supported by Dompdf */
</style>

<?php
$htmlContent = ob_get_clean();
$ourpdf->loadHtml($htmlContent);

// (Optional) Setup the paper size and orientation
$ourpdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$ourpdf->render();

if (isset($_POST["checkbox"])) {
    $ourdoc = $ourpdf->output();
    $_SESSION["thepdf"] = $ourdoc;
    include "./email.php";
} else {
    // Output the generated PDF to Browser
    $ourpdf->stream("File.pdf", Array("Attachment"=>0));
    /* Array input allows the pdf to be either downloaded 
    or previewed. When "Attachment" is set to 0, pdf will
    will be previewed in browser, and when it is set to 1,
    pdf will be downloaded. */ 
}
?>