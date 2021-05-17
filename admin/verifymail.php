<?php 
 $connection=mysqli_connect("localhost","root","","tms1");
session_start();
$bid=$_GET['bid'];
$guideid=$_GET['guideid'];
$ap1=mysqli_query($connection,"SELECT * from `Tblguide` WHERE `Guided`='$guideid'");
while($row = mysqli_fetch_array($ap1))
   {
   	$emailId=$row['GuideEmail'];
   }
$ap=mysqli_query($connection,"SELECT * FROM `tblbooking`,`tblusers` WHERE tblusers.EmailId=tblbooking.UserEmail AND tblbooking.BookingId='$bid'");

// Import PHPMailer classes into the global namespace 
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 
 
require 'PHPMailer/Exception.php'; 
require 'PHPMailer/PHPMailer.php'; 
require 'PHPMailer/SMTP.php'; 
 
$mail = new PHPMailer; 
 
$mail->isSMTP();                      // Set mailer to use SMTP 
$mail->Host = 'smtp.gmail.com';       // Specify main and backup SMTP servers 
$mail->SMTPAuth = true;               // Enable SMTP authentication 
$mail->Username = 'mockuser1@protonmail.com';   // SMTP username 
$mail->Password = 'usermock@#123';   // SMTP password 
$mail->SMTPSecure = 'tls';            // Enable TLS encryption, `ssl` also accepted 
$mail->Port = 587;                    // TCP port to connect to 
 
// Sender info 
$mail->setFrom('sender@emagazine.com', 'WayFarer'); 
$mail->addReplyTo('reply@emagazine.com', 'WayFarer'); 
while($rw = mysqli_fetch_array($ap))
   {
   	$name=$rw['FullName'];
   	$Contact=$rw['MobileNumber'];
   	$email=$rw['EmailId'];
   }
// Add a recipient 
$mail->addAddress($emailId); 
 
//$mail->addCC('cc@example.com'); 
//$mail->addBCC('bcc@example.com'); 
 
// Set email format to HTML 
$mail->isHTML(true); 
 
// Mail subject 
$mail->Subject = 'Email from WayFarer'; 
 
// Mail body content 
$bodyContent .= '<html>
<head>
<meta charset="utf-8">
</head>

<body background="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS4hVvyxHSVWVWGu8Uqq1bOi0x7KAhUG22svA&usqp=CAU" style="background-size: cover;">
    <center>
<h1 style="margin-top: 50px;">Welcome to <b style="color:crimson;">WayFarer</b></h1>
<p>Hai,</p>
<p>Your new work has been assigned by the admin (Let us have some cheers for that)</p>
Below given are the details of the booking <br>
<table border="1" style="margin-top:30px">
  <tr>
    <th scope="row">Mail From</th>
    <td>WayFarer Admin</td>
  </tr>
  <tr>
    <th scope="row">Username</th>
    <td>'.$name.'</td>
  </tr>
  <tr>
    <th scope="row">Contact</th>
    <td>'.$Contact.'</td>
  </tr>
  <tr>
  <th scope="row">Email</th>
  <td>'.$email.'</td>
</tr>
</table>
<div style="margin-top:30px">
Explore from here--->> <a href="http://localhost/Tourism%20Management%20System%20-TMS/tms/index.php"> WayFarer</a></div>
</center>
</body>
</html>'; 
$mail->Body    = $bodyContent; 
 
// Send email 
if(!$mail->send()) { 
    echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
} else { 
    echo 'Message has been sent.'; 
} 

    header("location:verifymail2.php?bid=$bid&guideid=$guideid");
?>

