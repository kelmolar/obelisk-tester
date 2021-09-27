<?
// using opening tag <? vs <?php because jareds godaddy server only recognizes short tags

//    ini_set('display_errors', 1);
//    ini_set('display_startup_errors', 1);
//    error_reporting(E_ALL);
//    ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/sessions'));
//    ini_set('session.gc_probability', 1);
//    
//    //https://thisinterestsme.com/fix-php-sessions-not-saving/
//    //https://thisinterestsme.com/check-if-session-started-php/    
////    echo "session_status = " . session_status() . PHP_EOL;
//    // results:
//    //0 – PHP_SESSION_DISABLED: Sessions are currently disabled.
//    //1 – PHP_SESSION_NONE: Sessions are enabled, but no session has been started.
//    //2 – PHP_SESSION_ACTIVE: Sessions are enabled and a session has been started.
//    if(session_status() == PHP_SESSION_NONE)
//    {
//        session_start();
//    }    

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'include/Exception.php';
require 'include/PHPMailer.php';
require 'include/SMTP.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                                 // debugging: 0 = none, 1 = errors and messages, 2 = messages only
    $mail->isSMTP();                                      // Set mailer to use SMTP
    //$mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
    //$mail->Host = 'p3plcpnl0151.prod.phx3.secureserver.net;relay-hosting.secureserver.net'; 
    $mail->Host = 'localhost';
    $mail->SMTPAuth = false;                               // Enable SMTP authentication
//    $mail->SMTPAuth = true;
//    $mail->Username = 'byo@movestrongbyo.com';                 // SMTP username
//    $mail->Password = 'sendRequests_471';                           // SMTP password
    //$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->SMTPSecure = 'none';
    $mail->SMTPAutoTLS = false;
    $mail->ENCRYPTION = "none";  //this is essential
//    $mail->SMTPSecure = 'tls';
    //$mail->Port = 465;                                    // TCP port to connect to
    $mail->Port = 25;
//    $mail->Port = 587;
//    $mail->Port = 465;

    //Recipients
//    $mail->setFrom('byo@movestrongbyo.com', 'MovestrongBYO');
    $mail->setFrom('byo@relay-hosting.secureserver.net', 'MovestrongBYO');
    $mail->addReplyTo('info@movestrongfit.com', 'Movestrong Support');
    
    $customerEmail = $_POST['contact'];    
    
    $mail->addAddress($customerEmail);
    $mail->addCC('info@movestrongfit.com');

    $mail->IsHTML(true); 

    $ftsHTML_Link = "";
    $ftsRaw_Link = "";
    $fgHTML_Link = "";
    $fgRaw_Link = "";
    
    if($_POST['layoutLoc_Rig'] != "NONE")
    {
        $ftsHTML_Link = "<p><img src='". $_POST['layoutLoc_Rig'] . "' /></p>";
        $ftsRaw_Link =$_POST['layoutLoc_Rig'];
    }
    if($_POST['layoutLoc_FG'] != "NONE")
    {
        $fgHTML_Link = "<p><img src='". $_POST['layoutLoc_FG'] . "' /></p>";
        $fgRaw_Link = $_POST['layoutLoc_FG'];
    }  
    
    
    $mail->Subject = 'BYO Quote Request';
    $mail->Body = '
    <html>
    <body>
    <div>
    <p> Hello from the Movestrong BYO, </p>
    <p> A new BYO Quote Request has been submitted. Please, view the following links. </p>'
    . $ftsRaw_Link . '<br>'
    . $fgRaw_Link . '<br>'
    . '<p> Thank you and regards, <br>
    The Movestrong BYO Program</p>
    <p> Please, do not reply to this email. For questions or comments please respond to info@movestrongfit.com. Thank you.</p>
    </div>'
    . $ftsHTML_Link    
    . $fgHTML_Link
    . '</body>
    </html>
    ';
    
    
    $mail->AltBody = 
    "Hello from the Movestrong BYO, \n\n".
    "A new BYO Quote Request has been submitted. Please, copy & paste the following links into your browser. \n\n".
    "Thank you and regards, \n\n".
    "The Movestrong BYO Program \n\n".
    "Rig Layout: \n\n".
    $ftsRaw_Link .
    "Fitground Layout: \n\n" .
    $fgRaw_Link .
    "Please, do not reply to this email. For questions or comments please respond to info@movestrongfit.com. Thank you.";
    
    if($mail->send())
        echo 'Message has been sent';
    else
       echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;        
} 
catch (Exception $e) 
{
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}

?>