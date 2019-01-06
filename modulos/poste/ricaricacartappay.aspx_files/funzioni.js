// verfica che l'importo in Euro immesso sia nel formato standard 9999,99
function IsEuroImport(importo) {
	if (importo==0) return true
	var first_comma_sign = importo.indexOf(",")
	var last_comma_sign = importo.lastIndexOf(",")
	if (first_comma_sign != last_comma_sign || first_comma_sign <= 0) return false
	var lmax = first_comma_sign + 3
	if (first_comma_sign == last_comma_sign && importo.length == lmax) {
		if (navigator.appName == "Netscape") {
			var num=importo.replace(/\,/g,"").replace(/\./g,"")
			if(num.search(/[^0-9]/) != -1) return false
		}
		return true
	}
	else return false
}

// verfica che l'importo in Valuta immesso sia nel formato standard 9999,999
function IsValutaImport(importo) {
	if (importo==0) return true
	var first_comma_sign = importo.indexOf(",")
	var last_comma_sign = importo.lastIndexOf(",")
	if (first_comma_sign != last_comma_sign || first_comma_sign <= 0) return false
	var lmax = first_comma_sign + 4
	if (first_comma_sign == last_comma_sign && importo.length == lmax) {
		if (navigator.appName == "Netscape") {
			var num=importo.replace(/\,/g,"").replace(/\./g,"")
			if(num.search(/[^0-9]/) != -1) return false
		}
		return true
	}
	else return false
}


// verifica che il numero immesso abbia i decimali indicati dal parametro
function IsDecimal(value,NumFloat) {
	if (value==0) return true
	var charCode = (navigator.appName == "Netscape") ? e.which : e.keyCode
	var first_comma_sign = value.indexOf(",")
	var last_comma_sign = value.lastIndexOf(",")
	if (first_comma_sign != last_comma_sign || first_comma_sign <= 0) return false
	var lmax = first_comma_sign + NumFloat + 1
	if (first_comma_sign == last_comma_sign && value.length == lmax) {
		if (navigator.appName == "Netscape") {
			var num=value.replace(/\,/g,"").replace(/\./g,"")
			if(num.search(/[^0-9]/) != -1) return false
		}
		return true
	}
	else return false
}

function IsCodeline2(Codeline2) {
	var first_comma_sign = Codeline2.indexOf("+")
	var last_comma_sign = Codeline2.lastIndexOf("+")
	if (first_comma_sign != last_comma_sign || first_comma_sign <= 0) return false
	var num = Codeline2.replace(/\+/g,"")
	if(num.search(/[^0-9]/) != -1) return false
	var lmax = first_comma_sign + 3
	if (first_comma_sign == last_comma_sign && Codeline2.length == lmax) return true
	else return false
}

function IsContoCorrente(stringa) {
	var charCode = 0
	var IsOK = false
	var i = 0
	if (stringa.length == 0 ) return true
	while (1) {
		charCode = stringa.charCodeAt(i)
		IsOK =  ((charCode >= 48 && charCode <= 57) || (charCode >= 65 && charCode <=90) || (charCode >= 97 && charCode <=122) || ( (charCode != 47) && (charCode != 92) && (charCode != 58) && (charCode != 39) ) )
		if (! IsOK || ++i >=  stringa.length) return IsOK
	}
}

function CheckHostCode(stringa) {
// true = tutto bene: non ci sono caratteri di controllo Host
	var charCode = 0
	var IsOK = false
	var i = 0
	if (stringa.length == 0 ) return true
	while (1) {
		charCode = stringa.charCodeAt(i)
		IsOK =  ((charCode == 10 || charCode == 13) || ((charCode != 47) && (charCode != 92) && (charCode != 58) && (charCode != 39) && (charCode != 176) && (charCode >= 32 && charCode <= 127)))
		if (! IsOK || ++i >=  stringa.length) return IsOK
	}
}

// stringa data in formato GG/MM/YYYY
function IsDate(strDate) {
	var partOfDate = strDate.split("/")
	var d = partOfDate[0]
	var m = partOfDate[1] - 1	
	var y = partOfDate[2]
	var objDate = new Date(y, m, d)
	if (d != objDate.getDate() || m != objDate.getMonth() || y != objDate.getFullYear()) return false
	else {
		if (objDate.getFullYear() > 1850 && objDate.getFullYear() < 2079) return true
		else return false
	}
}

// verfica che il singolo valore immesso sia un numero oppure una virgola (per l'EURO)
function checkEuro(e) {
	var charCode = (navigator.appName == "Netscape") ? e.which : e.keyCode
	//status = charCode // see ASCII character value!
	if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 44) return false
	else return true
}

// verfica che il singolo valore immesso sia un numero
function checkInt(e) {
	var charCode = (navigator.appName == "Netscape") ? e.which : e.keyCode
	//status = charCode // see ASCII character value!
	if (charCode > 31 && (charCode < 48 || charCode > 57)) return false
	else return true
}

// verfica che il singolo valore immesso sia una lettera o invio
function checkLetter(e) {
	var charCode = (navigator.appName == "Netscape") ? e.which : e.keyCode
	//status = charCode // see ASCII character value!
	if ( (charCode >= 65 && charCode <=90) || (charCode >= 97 && charCode <=122) || charCode == 13 ) return true
	else return false
}

// verfica che il singolo valore immesso sia un numero o una lettera 
function checkIntandLetter(e) {
	var charCode = (navigator.appName == "Netscape") ? e.which : e.keyCode
	//status = charCode // see ASCII character value!
	if ((charCode >= 65 && charCode <=90) || (charCode >= 48 && charCode <=57) || (charCode >= 97 && charCode <=122)) return true
	else return false
}

// verfica che la stinga immessa sia composta di lettere
function IsAlfa(stringa) {
	var charcode 
	for (var i = 0; i < stringa.length; i++) {
		charcode = stringa.charCodeAt(i)
		if ( !( (charcode >= 65 && charcode <=90) || (charcode >= 97 && charcode <=122) ) ) return false
	}
	return true
}

// verifica che la stringa immessa sia un numero
function isNumber(inputStr) { 
	for (var i = 0; i < inputStr.length; i++) {
		var oneChar = inputStr.charAt(i)
		if (oneChar < "0" || oneChar > "9") return false
	}
	return true
}

function IsAlfaNum(stringa) {
	var check_comma = stringa.indexOf(",")
	var check_dot = stringa.indexOf(".")
	if (check_comma!=-1 || check_dot!=-1) return false
	if(stringa.search(/[^A-Z,0-9]/) != -1) return false
	else return true
}

function IsEmail(e_mail) {
	function check_invalid_char(e_mail) {
		if( ( e_mail.search(/[^a-z,A-Z,0-9,\x22,\x23,\x24,\x25,\x26,\x27,\x2A,\x2D,\x2E,\x3C,\x3E,\x40,\x5F,\x7E]/) ) != -1 ) return false
		else return true
	}

	function check_sign(e_mail) {
		var first_at_sign = e_mail.indexOf("@")
		var last_at_sign = e_mail.lastIndexOf("@")

		if ( last_at_sign == -1 ) return false

		var last_dot_sign = e_mail.lastIndexOf(".")
		if ( (first_at_sign == last_at_sign ) && ( first_at_sign > 0 ) && ( last_at_sign < (e_mail.length - 3) ) && ( last_dot_sign > (first_at_sign + 1) ) && ( last_dot_sign < (e_mail.length - 1) ) ) return true
		else return false
	}

	if (check_invalid_char(e_mail) && check_sign(e_mail) ) return true
	else return false
}

// verifica che la data di scadenza della carta di credito sia valida
function DateCreditCard(strDate) {
	var m = strDate.substring(0,strDate.indexOf('/'))
	var y = strDate.substring(strDate.indexOf('/')+1,strDate.length)
	if(m.length != 2 || y.length != 2 || m <= 0 || m > 12 || y < 0 || y == "-0") {
		alert("Inserire la data di scadenza nel formato mm/aa!")
		return false
	}
/*
	else {
		var dataoggi= new Date()
		var datascad= new Date(y,m,1) // aggiungo un mese
		if (datascad<dataoggi) {
			alert("La data di scadenza immessa è antecedente alla data attuale!")
			return false
		}
	}
*/
	return true
}

// verifica che strDate1 sia inferiore di strDate2
function OrderDate(strDate1,strDate2) {
	var partOfDate = strDate1.split("/")
	var objDate1 = new Date(partOfDate[2], partOfDate[1] - 1, partOfDate[0])
	var partOfDate = strDate2.split("/")
	var objDate2 = new Date(partOfDate[2], partOfDate[1] - 1, partOfDate[0])

	if (objDate1 <= objDate2) return true
	else return false
}

// conversione al carattere maiuscolo
function upperMe(field) {
	if (field.value != field.value.toUpperCase()) field.value = field.value.toUpperCase()
}

// elimina gli spazi a destra e a sinistra
function trim(strString) {
	var retStr = strString
	while (retStr.substring(0,1)==" ")
		retStr = retStr.substring(1,retStr.length)
	while (retStr.substring(retStr.length-1,retStr.length)==" ")
		retStr = retStr.substring(0,retStr.length-1)
	return retStr
}

// verifica che la validità del conto corrente immesso dall'utente
function CheckNumCC(Numero_CC) {
	var Tot_Disp = 0
	if (Numero_CC.substring(0,3) == "30/")
		var Num_CC = Numero_CC.substring(3,Numero_CC.length)
	else
		var Num_CC = Numero_CC

	//verifica lunghezza numero conto
	if (Num_CC.length != 4 && Num_CC.length != 6 && Num_CC.length != 8) return false
	for (var i = 1; i < Num_CC.length; i++) {
		var Appo_Molt = parseInt(Num_CC.substring(i-1, i),10)
		if (i % 2 != 0) {
			//cifre in posizione dispari
			Appo_Molt = Appo_Molt * 2
			if (Appo_Molt > 9) Appo_Molt = Appo_Molt - 9
		}
		//somma delle cifre in posizione pari alle cifre in posizione dispari precedentemente elaborate
		Tot_Disp = Tot_Disp + Appo_Molt
	}
	Tot_Disp = Tot_Disp % 10
	//controcodice calcolato
	if (Tot_Disp != 0) Tot_Disp = 10 - Tot_Disp
	i = Num_CC.length-1
	//controcodice digitato
	Appo_Molt = parseInt(Num_CC.substring(i, i+1),10)
	if (Tot_Disp != Appo_Molt) return false
	return true
}

function Lit2Euro(ImportoLit) {
	var fltPart = eval(ImportoLit / 1936.27)
	if (navigator.appName == "Netscape") {
		if (ImportoLit < 1936.27) fltPart = "0" + fltPart
	}
	var intPart = parseInt(fltPart,10)
	var fractPart = Math.round((fltPart - intPart) * 100)
	if(fractPart<10) fractPart = "0" + fractPart
	if(fractPart==100) {
		fractPart = 0
		intPart += 1
	}
	var strPart = intPart + "." + fractPart
	return new Number (strPart)
}

function Euro2Lit(ImportoEur) {
	var ImportoLit = parseInt (1936.27 * parseFloat(ImportoEur))
	return new Number (ImportoLit)
}

function EuroFormat(ImportoEuro) {
	if (navigator.appName == "Netscape") {
		if (ImportoEuro<1) var intPart=parseInt(0)
		else var intPart=parseInt(ImportoEuro,10)
	}
	else var intPart = parseInt(ImportoEuro,10)
	var fractPart = Math.round((ImportoEuro - intPart) * 100)
	if(fractPart<10) fractPart = "0" + fractPart
	if(fractPart==100) {
		fractPart = 0
		intPart += 1
	}
	var intPartStr = ""
	var intPartTmp = new String(intPart)
	var j = 0
	for(i=intPartTmp.length;i>0;i--) {
		intPartStr = intPartTmp.substring(i-1,i) + intPartStr
		if(j==2 && i > 1) {
			intPartStr = "." + intPartStr
			j = 0
		}
		else j++
	}
	return intPartStr + "," + fractPart
}

function ValutaFormat(ImportoEuro) {
	if (navigator.appName == "Netscape") {
		if (ImportoEuro<1) var intPart=parseInt(0)
		else var intPart=parseInt(ImportoEuro,10)
	}
	else var intPart = parseInt(ImportoEuro,10)
	var fractPart = Math.round((ImportoEuro - intPart) * 1000)
		
	if(fractPart<10) fractPart = "00" + fractPart
	else if	(fractPart<100) fractPart = "0" + fractPart
	
	if(fractPart==100) {
		fractPart = 0
		intPart += 1
	}
	var intPartStr = ""
	var intPartTmp = new String(intPart)
	var j = 0
	for(i=intPartTmp.length;i>0;i--) {
		intPartStr = intPartTmp.substring(i-1,i) + intPartStr
		if(j==2 && i > 1) {
			intPartStr = "." + intPartStr
			j = 0
		}
		else j++
	}
	return intPartStr + "," + fractPart
}


function LitFormat(ImportoLit) {
	var intPart = parseInt(ImportoLit,10)
	var intPartStr = ""
	var intPartTmp = new String(intPart)
	var j = 0
	for(i=intPartTmp.length;i>0;i--) {
		intPartStr = intPartTmp.substring(i-1,i) + intPartStr
		if(j==2 && i > 1) {
			intPartStr = "." + intPartStr
			j = 0
		}
		else j++
	}
	return intPartStr
}

function IsCodiceFiscale(CodiceFiscale) {
	var ArrCF= new Array()
	var indice=0
	var somma=0
	var checkdigit=0

	ArrCF["0"]=new Array(0,1)
	ArrCF["1"]=new Array(1,0)
	ArrCF["2"]=new Array(2,5)
	ArrCF["3"]=new Array(3,7)
	ArrCF["4"]=new Array(4,9)
	ArrCF["5"]=new Array(5,13)
	ArrCF["6"]=new Array(6,15)
	ArrCF["7"]=new Array(7,17)
	ArrCF["8"]=new Array(8,19)
	ArrCF["9"]=new Array(9,21)

	ArrCF["A"]=new Array(0,1)
	ArrCF["B"]=new Array(1,0)
	ArrCF["C"]=new Array(2,5)
	ArrCF["D"]=new Array(3,7)
	ArrCF["E"]=new Array(4,9)
	ArrCF["F"]=new Array(5,13)
	ArrCF["G"]=new Array(6,15)
	ArrCF["H"]=new Array(7,17)
	ArrCF["I"]=new Array(8,19)
	ArrCF["J"]=new Array(9,21)
	ArrCF["K"]=new Array(10,2)
	ArrCF["L"]=new Array(11,4)
	ArrCF["M"]=new Array(12,18)
	ArrCF["N"]=new Array(13,20)
	ArrCF["O"]=new Array(14,11)
	ArrCF["P"]=new Array(15,3)
	ArrCF["Q"]=new Array(16,6)
	ArrCF["R"]=new Array(17,8)
	ArrCF["S"]=new Array(18,12)
	ArrCF["T"]=new Array(19,14)
	ArrCF["U"]=new Array(20,16)
	ArrCF["V"]=new Array(21,10)
	ArrCF["W"]=new Array(22,22)
	ArrCF["X"]=new Array(23,25)
	ArrCF["Y"]=new Array(24,24)
	ArrCF["Z"]=new Array(25,23)

	CodiceFiscale=CodiceFiscale.toUpperCase()
	if (CodiceFiscale.length<16) {
		return confirm("Il Codice Fiscale inserito è errato. \nVuoi Continuare?")
		document.frmRegister.txtCodiceFiscale.focus
	}
	else {
		for(indice=1;indice<CodiceFiscale.length;indice++) {
			var c=CodiceFiscale.substring(indice-1,indice)
			if ((indice % 2)==0) somma+=ArrCF[c][0]
			else somma+=ArrCF[c][1]
		}

		var c=CodiceFiscale.substring(indice-1,indice)
		if (ArrCF[c][0]!=(somma % 26)) return confirm("Il Codice Fiscale inserito è errato. \nVuoi Continuare?")
		else return true
	}
}

function getYear(d) {
	var yyyy = d.getYear()
	if(yyyy < 100) yyyy = "19" + yyyy
	if(yyyy >= 100 && yyyy < 1000) yyyy = 1900 + yyyy
	return yyyy
}

function getMonth(d) {
	var mm = d.getMonth() + 1
	if(mm < 10) mm = "0" + mm
	return mm
}

function getDay(d) {
	var dd = d.getDate()
	if(dd < 10) dd = "0" + dd
	return dd
}

// Questa sezione viene utilizzata quando c'è un combo cmbPeriodo + i campi txtDataDa e txtDataA
var DateEnabled = false

function cmbPeriodo_onchange(f) {
	var v = f.cmbPeriodo.options[f.cmbPeriodo.selectedIndex].value
	if(v=="") {
		DateEnabled = true
		f.txtDataDa.value=""
		f.txtDataA.value=""
		f.txtDataDa.focus()
		return
	}
	DateEnabled = false
	if(v=="0") {
		f.txtDataDa.value=""
		f.txtDataA.value=""
		return
	}
	if(v=="1") {
		var d2 = new Date()
		var yyyy = getYear(d2)
		var	d1 = new Date(yyyy, d2.getMonth(), d2.getDate() - 7)
	}
	if(v=="2") {
		var d2 = new Date()
		var yyyy = getYear(d2)
		var	d1 = new Date(yyyy, d2.getMonth(), d2.getDate() - 15)
	}
	if(v=="3") {
		var d2 = new Date()
		var yyyy = getYear(d2)
		var	d1 = new Date(yyyy, d2.getMonth() - 1, d2.getDate())
	}
	if(v=="4") {
		var d2 = new Date()
		var yyyy = getYear(d2)
		var	d1 = new Date(yyyy, d2.getMonth() - 3, d2.getDate())
	}
	if(v=="5") {
		var d2 = new Date()
		var yyyy = getYear(d2)
		var	d1 = new Date(yyyy, 0, 1)
	}
	f.txtDataDa.value = getDay(d1) + "/" + getMonth(d1) + "/" + getYear(d1)
	f.txtDataA.value = getDay(d2) + "/" + getMonth(d2) + "/" + getYear(d2)
}

function txtDataDa_onfocus(f) {
	if(!DateEnabled) f.cmbPeriodo.focus()
}

function txtDataA_onfocus(f) {
	if(!DateEnabled) f.cmbPeriodo.focus()
}
// Fine Sezione periodo

// Funzioni controllo numero Carta di Credito
function checkTypeCartadiCredito(num,type) {
	if ((num.substr(0,2)=="37") && (type=="3")) return true //AMEX
	if ((num.substr(0,1)=="4") && (type=="1")) return true //VISA
	if (type=="4")
	{
		if ((num.substr(0,6)=="076018") || 
			(num.substr(0,6)=="402360") || 
			(num.substr(0,6)=="402361") || 
			(num.substr(0,6)=="417631") ||
			(num.substr(0,6)=="529948") ||
			(num.substr(0,6)=="403035")) return true //POSTEPAY-RRT - POSTEPAY STANDARD - POSTEPAY IMPRESA - POSTEPAY GIFT - POSTEPAY VIRTUAL

	}	
	if ((num.substr(0,1)=="5") && (type=="2")) return true //MASTERCARD
	return false
}

function checkNumberCartadiCredito(num, type) {
	// input stringa senza spazi ne "-"
	var i = 0
	var prod = new Number
	var checksum = new Number
	var indice = 16

	if (!checkTypeCartadiCredito(num,type)) return false

	indice= indice - num.length
	if (indice > 0) {
		for (i = 0; i < indice; i ++) num= "0" + num
	}
	for (i = 0; i < 16; i ++) {
		if (i % 2 == 1 ) {
			prod = num.charAt(i) * 1
			checksum = checksum + prod
		}
		else {
			prod = num.charAt(i) * 2
			if (prod > 9) prod = prod - 9
			checksum = checksum + prod
		}
	}

	checksum = checksum % 10

	if (checksum != 0) return false

	return true	
}

// verfica che il singolo valore immesso sia Enter
function checkEnter(e) {
	var charCode = (navigator.appName == "Netscape") ? e.which : e.keyCode
	// status = charCode // see ASCII character value!
	if (charCode != 13) return false
	else return true
}

function getCookieVal (offset) {
	var endstr = document.cookie.indexOf (";", offset);
	if (endstr == -1) endstr = document.cookie.length;
	return unescape(document.cookie.substring(offset, endstr));
}

function GetCookie (name) {
	var arg = name + "=";
	var alen = arg.length;
	var clen = document.cookie.length;
	var i = 0;
	while (i < clen) {
		var j = i + alen;
		if (document.cookie.substring(i, j) == arg) return getCookieVal (j);
		i = document.cookie.indexOf(" ", i) + 1;
		if (i == 0) break; 
	}
	return null;
}

function SetCookie (name, value) {
	var argv = SetCookie.arguments;
	var argc = SetCookie.arguments.length;
	var expires = (2 < argc) ? argv[2] : null;
	var path = (3 < argc) ? argv[3] : null;
	var domain = (4 < argc) ? argv[4] : null;
	var secure = (5 < argc) ? argv[5] : false;
	document.cookie = name + "=" + escape (value) +
		((expires == null) ? "" : ("; expires=" + expires.toGMTString())) +
		((path == null) ? "" : ("; path=" + path)) +
		((domain == null) ? "" : ("; domain=" + domain)) +
		((secure == true) ? "; secure" : "");
}

// Verifica la Sessione BPOL
function IsAuthSessionOn () 
{

	var strSMSessionCookie = "SMSESSION";
	var strSSSessionCookie = "FormsAuth";
	if ( 	(GetCookie(strSMSessionCookie) != null &&
		GetCookie(strSMSessionCookie) != "LOGGEDOFF") || 
		GetCookie(strSSSessionCookie) != null)
	{
		return true;
	}
	else 
	{
		return false;
	}
}

function IsTarga(targa) {
	//Verifica dei primi due caratteri digitati della targa digitati dall'utente
	if (!IsAlfa(targa.substring(0,2))) {
		alert("Attenzione. Il numero di targa inserito non è corretto")
		return false
	}
	if (targa.length != 7 && targa.length != 8) {
		alert("Attenzione. Il numero di targa inserito non è corretto")
		return false
	}
	return true
}

function UserAllowedChars (stringValue) {
/*
Ritorna true se la stringa passata è composta solo dai seguenti caratteri:
spazio		(32)
"				(34)
&				(38)
'				(39)
,				(44)
-				(45)
.				(46)
/				(47)
0-9			(48-57)
A-Z			(65-90)
a-z			(97-122)
*/
	for (var i = 0; i < stringValue.length; i++) {
		var c = stringValue.charCodeAt(i);
		if (c!=32 && c!=34 && c!=38 && c!=39 && (c<44 || c>57) && (c<65 || c>90) && (c<97 || c>122))
			return false
	}
	return true
}
