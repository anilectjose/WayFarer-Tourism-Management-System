<?php
$connection=mysqli_connect("localhost","root","","tms1");
$guideid=$_GET['guideid'];
$bid=$_GET['bid'];
$sdate=$_GET['sdate'];
$edate=$_GET['edate'];
echo $guideid;
$sql1="INSERT INTO `guideassign`(`bookid`, `sdate`, `edate`, `guideid`) VALUES ('$bid', '$sdate','$edate', '$guideid')";

          if(mysqli_query($connection,$sql1))
          {
             header("location:verifymail.php?bid=$bid&guideid=$guideid");
           }


?>