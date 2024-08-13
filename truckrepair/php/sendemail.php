<?php
include "../../phpconfig/allfunction.php";
date_default_timezone_set('Asia/Manila');

$cashierid = $_SESSION['login_user'];
$bridz = $_SESSION['branch'];


$emailadd = $_POST['selectedEmail'];
$emailArray = explode(',', $emailadd);
$sender = "maquilingbuildersdepotstore@gmail.com";
$subject = "JOB ORDER";
$message = "<html>
<head>
<title>HTML email</title>
</head>
<body>".$_POST["modalContent"]."</body>
</html>";

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\b";
$headers .= 'From: Maquiling Builders Depot' . "\r\n";
$headers .= 'Cc: maquilingbuildersdepotstore@gmail.com' . "\r\n";

if (mail(implode(',', $emailArray), $subject, $message, $headers))
{
    echo "Message sent successfully...";
}
else
{
    echo "Message could not be sent...";
}
?>