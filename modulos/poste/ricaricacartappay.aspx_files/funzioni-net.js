// funzioni-net.js.
//<script>

function CheckCAP(objSource, objArgs)
{
	//Viene chiamata solo quando il valore della text<>''
	var blnValid = true;
	var intNumber = objArgs; 
	var errorMessage = dom_getAttribute(objSource,'errormessage')
	if (intNumber=='00000') {
		if (!(bValidationSummaryOnSubmit)) BPOLalert(errorMessage);
		objArgs="";
		return false;
	}
	else {
		return true;
	}
}
function checkNumeroCartaPostePay (objSource, objArgs)
{
	// Viene chiamata solo quando il valore della text != ''


	// Verifico che il valore in input sia composto dav16 caratteri numerici
	var re = /^\d{16}$/;

	var blnValid = re.test(objArgs);
	
	if(blnValid){
		var intNumber = objArgs;
		blnValid = checkNumberCartadiCredito(intNumber,'4');
	}
	var errorMessage = dom_getAttribute(objSource,'errormessage')
	if (!blnValid){
		if (!(bValidationSummaryOnSubmit)) BPOLalert(errorMessage);
		objArgs='';
		return false;
	}
	else {
		return true;
	}
}
function CheckImportoEuro(objSource, objArgs)
{
	//Viene chiamata solo quando il valore della text<>''
	var blnValid = true;
	var intNumber = objArgs; 
	var re = /^0+\,00$/;
	var errorMessage = dom_getAttribute(objSource,'errormessage')

	if ((!errorMessage) || errorMessage == "") {
		errorMessage = "L'importo del bollettino non pu&ograve; essere uguale a zero!" 	
	}

	if (re.test(intNumber)) {
		if (!(bValidationSummaryOnSubmit)) BPOLalert(errorMessage);
		return false;
	}
	else {
		return true;
	}
}

function arrayContains(arrayObj, exprToSearch){
	var arrayElem;
	var exprFound=false;
	for(arrayElem in arrayObj){
		if(arrayObj[arrayElem]==exprToSearch){
			exprFound = true;
			break;
		}
	}
	return exprFound;
}

function isValidHostChar(charCode){
	var IsOK = false;
	if (((charCode>=65) && (charCode<=90)) ||
		((charCode>=48) && (charCode<=57)) ||
		((charCode>=97) && (charCode<=122)) ||
		(charCode==32) ||
		(charCode==33) ||
		((charCode>=40) && (charCode<=46)) ||
		((charCode>=59) && (charCode<=62)) ||
		(charCode==64)  ||
		(charCode==91)  ||
		(charCode==93)  ||
		(charCode==123)  ||
		(charCode==125)) 
	{
		IsOK =true;
	}
	return IsOK;
}

function CharCodeToString(charCode){
	if (charCode == 8) return "[BACKSPACE]";
	if (charCode == 9) return "[TAB]";
	if (charCode == 10) return "[INVIO]";
	if (charCode == 13) return "[INVIO]";
	if (charCode == 22) return "[PASTE]";
	if (charCode == 160) return "[NON-BREAKING SPACE]";
	return "[" + String.fromCharCode(charCode).toUpperCase() + "]";
}

function isAllowedCharCode(charCode, arrCharCode) {
	if(!arrCharCode) return false;
	for(i in arrCharCode) {
		if (charCode==parseInt(trim(arrCharCode[i]))) return true;
	}
	return false;
}

function CheckCaratteriHost(objSource, objArgs) {
	var charCode = 0;
	var position = 0;
	var invalidCharCount = 0;
	var invalidCharFound = new Array();
	var message = ""
	var stringToProcess = objArgs;
	var AllowedCharCode = dom_getAttribute(objSource, 'AllowedCharCode');
	var arrCharCode;
	if (AllowedCharCode) {
		arrCharCode = AllowedCharCode.split(",");
	}
	stringToProcess=stringToProcess.replace("\r\n","\n");
	stringToProcess=stringToProcess.replace("\r","\n");
	if (stringToProcess.length == 0) return true;
	for(position=0; position<stringToProcess.length; position++) { 
		charCode = stringToProcess.charCodeAt(position)
		if(!(isValidHostChar(charCode) || isAllowedCharCode(charCode, arrCharCode))){
			invalidCharCount++;
			if(!arrayContains(invalidCharFound, charCode)){
				invalidCharFound.push(charCode);
			}
		}
	}
	if(invalidCharCount>0){
		message = "Nel campo"
		var fieldName = dom_getAttribute(objSource, 'FieldName')

		if (fieldName) {
			message += " " + fieldName;
		}	
		if(invalidCharCount==1){ // singolare
			message += " &egrave; stato inserito un carattere non valido";
		} else { // plurale
			message += " sono stati inseriti " + invalidCharCount + " caratteri non validi";
		}

		for(elem in invalidCharFound){
			message += " " + CharCodeToString(invalidCharFound[elem]);
		}
		message += ". L'elenco dei caratteri speciali &egrave; presente in fondo alla pagina.";
		
		if (!(bValidationSummaryOnSubmit)){
			BPOLalert(message);
		} else {
			sCustomErrorMessage=entityEncode(message);
		}
		return false;
	} else {
		return true;
	}
}

function CheckCheckBox(objSource, objArgs)
{
	var errorMessage = dom_getAttribute(objSource,'errormessage')
	var objCheckBox=dom_getElementByID(dom_getAttribute(objSource, "controltovalidate"));
	if (!objCheckBox.checked) {
		if (!(bValidationSummaryOnSubmit)) BPOLalert(errorMessage);
		return false;
	}
	else {
		return true;
	}
}

function ReadErrorMessageFromValidator(ascxName, valID) {
	var objValidator=dom_getElementByID(ascxName + "_" + valID);
	return dom_getAttribute(objValidator, "errormessage");
}

function maxCaratteri(text,longitud,obj) 
{
	var maxlength = new Number(longitud); 
	if (text.value.length > maxlength){
	text.value = text.value.substring(0,maxlength);
	} 
	obj.value=maxlength - text.value.length
	return true;
}

function CheckCodiceFiscale(objSource, objArgs) {
	var errorMessage = "Codice Fiscale formalmente errato.";

	if (IsCodiceFiscaleBloccante(objArgs)) return true;

	if (!(bValidationSummaryOnSubmit)){
		BPOLalert(errorMessage);
	} else {
		sCustomErrorMessage=entityEncode(errorMessage);
	}
	return false;
}

function CheckValoreDiversoDaZero(objSource, objArgs) {
	var errorMessage = dom_getAttribute(objSource,'errormessage')
	var re = /^(?:(?:[+\-](?=\d))?(?:\d*))$/;
	
	if (!(re.test(objArgs) && (parseInt(objArgs) == 0))) return true;

	if (!(bValidationSummaryOnSubmit)){
		BPOLalert(errorMessage);
	} else {
		sCustomErrorMessage=entityEncode(errorMessage);
	}
	return false;
}

function IsCodiceFiscaleBloccante(CodiceFiscale) {

	var ArrCF = new Array();
	var indice = 0;
	var somma = 0;
	var checkdigit = 0;
	var re=/^[A-Z]{6}[L-NP-V\d]{2}[A-Z][L-NP-V\d]{2}[A-Z][L-NP-V\d]{3}[A-Z]$/;

	ArrCF["0"]=new Array(0,1);
	ArrCF["1"]=new Array(1,0);
	ArrCF["2"]=new Array(2,5);
	ArrCF["3"]=new Array(3,7);
	ArrCF["4"]=new Array(4,9);
	ArrCF["5"]=new Array(5,13);
	ArrCF["6"]=new Array(6,15);
	ArrCF["7"]=new Array(7,17);
	ArrCF["8"]=new Array(8,19);
	ArrCF["9"]=new Array(9,21);
	ArrCF["A"]=new Array(0,1);
	ArrCF["B"]=new Array(1,0);
	ArrCF["C"]=new Array(2,5);
	ArrCF["D"]=new Array(3,7);
	ArrCF["E"]=new Array(4,9);
	ArrCF["F"]=new Array(5,13);
	ArrCF["G"]=new Array(6,15);
	ArrCF["H"]=new Array(7,17);
	ArrCF["I"]=new Array(8,19);
	ArrCF["J"]=new Array(9,21);
	ArrCF["K"]=new Array(10,2);
	ArrCF["L"]=new Array(11,4);
	ArrCF["M"]=new Array(12,18);
	ArrCF["N"]=new Array(13,20);
	ArrCF["O"]=new Array(14,11);
	ArrCF["P"]=new Array(15,3);
	ArrCF["Q"]=new Array(16,6);
	ArrCF["R"]=new Array(17,8);
	ArrCF["S"]=new Array(18,12);
	ArrCF["T"]=new Array(19,14);
	ArrCF["U"]=new Array(20,16);
	ArrCF["V"]=new Array(21,10);
	ArrCF["W"]=new Array(22,22);
	ArrCF["X"]=new Array(23,25);
	ArrCF["Y"]=new Array(24,24);
	ArrCF["Z"]=new Array(25,23);

	CodiceFiscale=trim(CodiceFiscale.toUpperCase());

	if (CodiceFiscale.length < 16) {
		//if (!(bValidationSummaryOnSubmit)) BPOLalert("Il Codice Fiscale inserito &egrave; formalmente errato.");
		objArgs="";
		return false;
	}
	else {
		if (!re.test(CodiceFiscale)) {
			//BPOLalert("Il Codice Fiscale inserito &egrave; formalmente errato.");
			objArgs="";
			return false;
		}
		else {
			// return true;

			for(indice=1;indice<CodiceFiscale.length;indice++) {
				var c=CodiceFiscale.substring(indice-1,indice);
				if ((indice % 2)==0) {
					somma+=ArrCF[c][0];
				} else somma+=ArrCF[c][1];
			}

			var c=CodiceFiscale.substring(indice-1,indice)
			if (ArrCF[c][0]!=(somma % 26)) {
				//if (!(bValidationSummaryOnSubmit)) BPOLalert("Il Codice Fiscale inserito &egrave; formalmente errato.");
				return false;
			}

			else return true

		}
	}
}

function CheckIsDate(objSource, objArgs) {
	//utilizzata in combinazione con l'oggetto CustomDomValidetor
	//per la validazione lato client delle date

	var errorMessage = dom_getAttribute(objSource,'errormessage')

	if ((!errorMessage) || errorMessage == "") {
		errorMessage = "La Data non &egrave; valida. Il formato corretto &egrave; gg/mm/aaaa." 	
	}

	if (trim(objArgs)=="") return true;
	
	if (objArgs.length!=10) {
		if (!(bValidationSummaryOnSubmit)) BPOLalert(errorMessage);
		objArgs="";
		return false;
	}

	var partOfDate = objArgs.split("/");
	var d = partOfDate[0];
	var m = partOfDate[1] - 1;
	var y = partOfDate[2];
	var objDate = new Date(y, m, d);
	if (d != objDate.getDate() || m != objDate.getMonth() || y != objDate.getFullYear()) 
	{			
		if (!(bValidationSummaryOnSubmit)) { alert(errorMessage); }
		objArgs="";
		return false;
	}
	else {
		if (objDate.getFullYear() < 1900 || objDate.getFullYear() > 2079)

		{
			if (!(bValidationSummaryOnSubmit)) BPOLalert(errorMessage);
			objArgs="";
			return false;
		}
	}
	return true;
}

function ImportoEuroFormat_OnBlur(txt, autoComplCents) {
	var regEx
	if (!autoComplCents) {
		regEx = /^(?:(?:[1-9]|0(?=\,))\d{0,2}(?:\d*|(?:\.\d{3})*)\,\d{2})$/;
	} else {
		regEx = /^(?:(?:[1-9]|0(?=\,))\d{0,2}(?:\d*|(?:\.\d{3})*)(?:\,\d{2})?)$/;
	}
	var importo=txt.value;
	if (regEx.test(importo)) {
		importo = importo.replace(/\./g,"");
		importo = importo.replace(",",".");
		txt.value = EuroFormat(importo);
	}
}

function ImportoEuroFormat_onFocus(txt) {
	var regEx = /^(?:(?:[1-9]|0(?=\,))\d{0,2}(?:\d*|(?:\.\d{3})*)\,\d{2})$/;
	var otxtImportoEuro = document.forms[0].elements['BollettinoPremarcatoEdit1:txtImportoEuro'];
	var importo=txt.value;
	if (regEx.test(importo)) {
		importo = importo.replace(/\./g,"");
		if (txt.value != importo) {
			txt.value = importo;
			if (txt.select) txt.select();
		}
	}
}

function ManageEnterKeySubmit(e) {
	var key = window.event ? e.keyCode : e.which;
	if (key==13){
		var aInputTags = document.forms[0].elements;
		var obj;
		for(var i = 0; i<aInputTags.length; i++) {
			obj = aInputTags[i];
			objType = dom_getAttribute(obj, "type")
			if (typeof(objType) == 'string') objType = objType.toLowerCase();
			objDefautStatus = dom_getAttribute(obj, "DefaultSubmit");
			if(objType == "submit" && objDefautStatus != null) {
				if (!(dom_getAttribute(obj, "disabled"))) obj.click();
				return false;
			}
		}
	}
}

function CheckRadioButtonControlArray(aRadioBtn) {
	var checkedFound=false;
	for (var radio=0; radio<aRadioBtn.length; radio++) {
		checkedFound = checkedFound || aRadioBtn[radio].checked;
	}
	return checkedFound;
}

function ManageImageClickCmdButton(CmdButtonID) {
	var oCmdButton = document.forms[0].elements[CmdButtonID];
	if (CmdButtonID && !oCmdButton.disabled) { oCmdButton.click(); }
}

//Converte un intero a 16bit in formato esadecimale
//utilizzata per le funzioni BPOLalert, BPOLconfirm e BPOLprompt
function hexEncode(nCifre, intArg) {
	var hexOut = "";
	// Simpoli Base 16
	var hexDigit = new Array("0","1","2","3","4","5","6","7","8","9","A","B","C","D","E","F");
	var intNum = parseInt(intArg);
	// Eseguo la conversione di Base
	while(intNum > 15) {
		hexOut = hexDigit[intNum % 16] + hexOut;
		intNum = Math.floor(intNum / 16);
	}
	hexOut = hexDigit[intNum] + hexOut;
	// Se necessario aggiungo zeri a sinistra fino al formato specificato in nCifre
	while(hexOut.length < nCifre) {
		hexOut = hexDigit(0) + hexOut;
	}
	return hexOut;
}

//riconosce le entit HTML all'interno di una stringa e le converte in formato unicode
//utilizzata per le funzioni BPOLalert, BPOLconfirm e BPOLprompt
function entityEncode(strArg) {
	var arrEntity = new Array();
	
	arrEntity["nbsp"] = "&#160;";
	arrEntity["iexcl"] = "&#161;";
	arrEntity["cent"] = "&#162;";
	arrEntity["pound"] = "&#163;";
	arrEntity["curren"] = "&#164;";
	arrEntity["yen"] = "&#165;";
	arrEntity["brvbar"] = "&#166;";
	arrEntity["sect"] = "&#167;";
	arrEntity["uml"] = "&#168;";
	arrEntity["copy"] = "&#169;";
	arrEntity["ordf"] = "&#170;";
	arrEntity["laquo"] = "&#171;";
	arrEntity["not"] = "&#172;";
	arrEntity["shy"] = "&#173;";
	arrEntity["reg"] = "&#174;";
	arrEntity["macr"] = "&#175;";
	arrEntity["deg"] = "&#176;";
	arrEntity["plusmn"] = "&#177;";
	arrEntity["sup2"] = "&#178;";
	arrEntity["sup3"] = "&#179;";
	arrEntity["acute"] = "&#180;";
	arrEntity["micro"] = "&#181;";
	arrEntity["para"] = "&#182;";
	arrEntity["middot"] = "&#183;";
	arrEntity["cedil"] = "&#184;";
	arrEntity["sup1"] = "&#185;";
	arrEntity["ordm"] = "&#186;";
	arrEntity["raquo"] = "&#187;";
	arrEntity["frac14"] = "&#188;";
	arrEntity["frac12"] = "&#189;";
	arrEntity["frac34"] = "&#190;";
	arrEntity["iquest"] = "&#191;";
	arrEntity["Agrave"] = "&#192;";
	arrEntity["Aacute"] = "&#193;";
	arrEntity["Acirc"] = "&#194;";
	arrEntity["Atilde"] = "&#195;";
	arrEntity["Auml"] = "&#196;";
	arrEntity["Aring"] = "&#197;";
	arrEntity["AElig"] = "&#198;";
	arrEntity["Ccedil"] = "&#199;";
	arrEntity["Egrave"] = "&#200;";
	arrEntity["Eacute"] = "&#201;";
	arrEntity["Ecirc"] = "&#202;";
	arrEntity["Euml"] = "&#203;";
	arrEntity["Igrave"] = "&#204;";
	arrEntity["Iacute"] = "&#205;";
	arrEntity["Icirc"] = "&#206;";
	arrEntity["Iuml"] = "&#207;";
	arrEntity["ETH"] = "&#208;";
	arrEntity["Ntilde"] = "&#209;";
	arrEntity["Ograve"] = "&#210;";
	arrEntity["Oacute"] = "&#211;";
	arrEntity["Ocirc"] = "&#212;";
	arrEntity["Otilde"] = "&#213;";
	arrEntity["Ouml"] = "&#214;";
	arrEntity["times"] = "&#215;";
	arrEntity["Oslash"] = "&#216;";
	arrEntity["Ugrave"] = "&#217;";
	arrEntity["Uacute"] = "&#218;";
	arrEntity["Ucirc"] = "&#219;";
	arrEntity["Uuml"] = "&#220;";
	arrEntity["Yacute"] = "&#221;";
	arrEntity["THORN"] = "&#222;";
	arrEntity["szlig"] = "&#223;";
	arrEntity["agrave"] = "&#224;";
	arrEntity["aacute"] = "&#225;";
	arrEntity["acirc"] = "&#226;";
	arrEntity["atilde"] = "&#227;";
	arrEntity["auml"] = "&#228;";
	arrEntity["aring"] = "&#229;";
	arrEntity["aelig"] = "&#230;";
	arrEntity["ccedil"] = "&#231;";
	arrEntity["egrave"] = "&#232;";
	arrEntity["eacute"] = "&#233;";
	arrEntity["ecirc"] = "&#234;";
	arrEntity["euml"] = "&#235;";
	arrEntity["igrave"] = "&#236;";
	arrEntity["iacute"] = "&#237;";
	arrEntity["icirc"] = "&#238;";
	arrEntity["iuml"] = "&#239;";
	arrEntity["eth"] = "&#240;";
	arrEntity["ntilde"] = "&#241;";
	arrEntity["ograve"] = "&#242;";
	arrEntity["oacute"] = "&#243;";
	arrEntity["ocirc"] = "&#244;";
	arrEntity["otilde"] = "&#245;";
	arrEntity["ouml"] = "&#246;";
	arrEntity["divide"] = "&#247;";
	arrEntity["oslash"] = "&#248;";
	arrEntity["ugrave"] = "&#249;";
	arrEntity["uacute"] = "&#250;";
	arrEntity["ucirc"] = "&#251;";
	arrEntity["uuml"] = "&#252;";
	arrEntity["yacute"] = "&#253;";
	arrEntity["thorn"] = "&#254;";
	arrEntity["yuml"] = "&#255;";
	arrEntity["fnof"] = "&#402;";
	arrEntity["Alpha"] = "&#913;";
	arrEntity["Beta"] = "&#914;";
	arrEntity["Gamma"] = "&#915;";
	arrEntity["Delta"] = "&#916;";
	arrEntity["Epsilon"] = "&#917;";
	arrEntity["Zeta"] = "&#918;";
	arrEntity["Eta"] = "&#919;";
	arrEntity["Theta"] = "&#920;";
	arrEntity["Iota"] = "&#921;";
	arrEntity["Kappa"] = "&#922;";
	arrEntity["Lambda"] = "&#923;";
	arrEntity["Mu"] = "&#924;";
	arrEntity["Nu"] = "&#925;";
	arrEntity["Xi"] = "&#926;";
	arrEntity["Omicron"] = "&#927;";
	arrEntity["Pi"] = "&#928;";
	arrEntity["Rho"] = "&#929;";
	arrEntity["Sigma"] = "&#931;";
	arrEntity["Tau"] = "&#932;";
	arrEntity["Upsilon"] = "&#933;";
	arrEntity["Phi"] = "&#934;";
	arrEntity["Chi"] = "&#935;";
	arrEntity["Psi"] = "&#936;";
	arrEntity["Omega"] = "&#937;";
	arrEntity["alpha"] = "&#945;";
	arrEntity["beta"] = "&#946;";
	arrEntity["gamma"] = "&#947;";
	arrEntity["delta"] = "&#948;";
	arrEntity["epsilon"] = "&#949;";
	arrEntity["zeta"] = "&#950;";
	arrEntity["eta"] = "&#951;";
	arrEntity["theta"] = "&#952;";
	arrEntity["iota"] = "&#953;";
	arrEntity["kappa"] = "&#954;";
	arrEntity["lambda"] = "&#955;";
	arrEntity["mu"] = "&#956;";
	arrEntity["nu"] = "&#957;";
	arrEntity["xi"] = "&#958;";
	arrEntity["omicron"] = "&#959;";
	arrEntity["pi"] = "&#960;";
	arrEntity["rho"] = "&#961;";
	arrEntity["sigmaf"] = "&#962;";
	arrEntity["sigma"] = "&#963;";
	arrEntity["tau"] = "&#964;";
	arrEntity["upsilon"] = "&#965;";
	arrEntity["phi"] = "&#966;";
	arrEntity["chi"] = "&#967;";
	arrEntity["psi"] = "&#968;";
	arrEntity["omega"] = "&#969;";
	arrEntity["thetasym"] = "&#977;";
	arrEntity["upsih"] = "&#978;";
	arrEntity["piv"] = "&#982;";
	arrEntity["bull"] = "&#8226;";
	arrEntity["hellip"] = "&#8230;";
	arrEntity["prime"] = "&#8242;";
	arrEntity["Prime"] = "&#8243;";
	arrEntity["oline"] = "&#8254;";
	arrEntity["frasl"] = "&#8260;";
	arrEntity["weierp"] = "&#8472;";
	arrEntity["image"] = "&#8465;";
	arrEntity["real"] = "&#8476;";
	arrEntity["trade"] = "&#8482;";
	arrEntity["alefsym"] = "&#8501;";
	arrEntity["larr"] = "&#8592;";
	arrEntity["uarr"] = "&#8593;";
	arrEntity["rarr"] = "&#8594;";
	arrEntity["darr"] = "&#8595;";
	arrEntity["harr"] = "&#8596;";
	arrEntity["crarr"] = "&#8629;";
	arrEntity["lArr"] = "&#8656;";
	arrEntity["uArr"] = "&#8657;";
	arrEntity["rArr"] = "&#8658;";
	arrEntity["dArr"] = "&#8659;";
	arrEntity["hArr"] = "&#8660;";
	arrEntity["forall"] = "&#8704;";
	arrEntity["part"] = "&#8706;";
	arrEntity["exist"] = "&#8707;";
	arrEntity["empty"] = "&#8709;";
	arrEntity["nabla"] = "&#8711;";
	arrEntity["isin"] = "&#8712;";
	arrEntity["notin"] = "&#8713;";
	arrEntity["ni"] = "&#8715;";
	arrEntity["prod"] = "&#8719;";
	arrEntity["sum"] = "&#8721;";
	arrEntity["minus"] = "&#8722;";
	arrEntity["lowast"] = "&#8727;";
	arrEntity["radic"] = "&#8730;";
	arrEntity["prop"] = "&#8733;";
	arrEntity["infin"] = "&#8734;";
	arrEntity["ang"] = "&#8736;";
	arrEntity["and"] = "&#8743;";
	arrEntity["or"] = "&#8744;";
	arrEntity["cap"] = "&#8745;";
	arrEntity["cup"] = "&#8746;";
	arrEntity["int"] = "&#8747;";
	arrEntity["there4"] = "&#8756;";
	arrEntity["sim"] = "&#8764;";
	arrEntity["cong"] = "&#8773;";
	arrEntity["asymp"] = "&#8776;";
	arrEntity["ne"] = "&#8800;";
	arrEntity["equiv"] = "&#8801;";
	arrEntity["le"] = "&#8804;";
	arrEntity["ge"] = "&#8805;";
	arrEntity["sub"] = "&#8834;";
	arrEntity["sup"] = "&#8835;";
	arrEntity["nsub"] = "&#8836;";
	arrEntity["sube"] = "&#8838;";
	arrEntity["supe"] = "&#8839;";
	arrEntity["oplus"] = "&#8853;";
	arrEntity["otimes"] = "&#8855;";
	arrEntity["perp"] = "&#8869;";
	arrEntity["sdot"] = "&#8901;";
	arrEntity["lceil"] = "&#8968;";
	arrEntity["rceil"] = "&#8969;";
	arrEntity["lfloor"] = "&#8970;";
	arrEntity["rfloor"] = "&#8971;";
	arrEntity["lang"] = "&#9001;";
	arrEntity["rang"] = "&#9002;";
	arrEntity["loz"] = "&#9674;";
	arrEntity["spades"] = "&#9824;";
	arrEntity["clubs"] = "&#9827;";
	arrEntity["hearts"] = "&#9829;";
	arrEntity["diams"] = "&#9830;";
	arrEntity["quot"] = "&#34;";
	arrEntity["amp"] = "&#38;";
	arrEntity["lt"] = "&#60;";
	arrEntity["gt"] = "&#62;";
	arrEntity["OElig"] = "&#338;";
	arrEntity["oelig"] = "&#339;";
	arrEntity["Scaron"] = "&#352;";
	arrEntity["scaron"] = "&#353;";
	arrEntity["Yuml"] = "&#376;";
	arrEntity["circ"] = "&#710;";
	arrEntity["tilde"] = "&#732;";
	arrEntity["ensp"] = "&#8194;";
	arrEntity["emsp"] = "&#8195;";
	arrEntity["thinsp"] = "&#8201;";
	arrEntity["zwnj"] = "&#8204;";
	arrEntity["zwj"] = "&#8205;";
	arrEntity["lrm"] = "&#8206;";
	arrEntity["rlm"] = "&#8207;";
	arrEntity["ndash"] = "&#8211;";
	arrEntity["mdash"] = "&#8212;";
	arrEntity["lsquo"] = "&#8216;";
	arrEntity["rsquo"] = "&#8217;";
	arrEntity["sbquo"] = "&#8218;";
	arrEntity["ldquo"] = "&#8220;";
	arrEntity["rdquo"] = "&#8221;";
	arrEntity["bdquo"] = "&#8222;";
	arrEntity["dagger"] = "&#8224;";
	arrEntity["Dagger"] = "&#8225;";
	arrEntity["permil"] = "&#8240;";
	arrEntity["lsaquo"] = "&#8249;";
	arrEntity["rsaquo"] = "&#8250;";
	arrEntity["euro"] = "&#8364;";

	var slices, sl, re, out, slEnt, slResto, chrCode, chrUni;
	
	if(strArg){
		slices=strArg.split("&");
		out=slices.shift();
		re = /^[a-z][a-z0-9]+;/i;
		for (s in slices){
			sl=slices[s];
			if (re.test(sl)) {
				slEnt=sl.substring(0, sl.indexOf(";"));
				slResto=sl.substring(1+sl.indexOf(";"));
				if (arrEntity[slEnt]) {
					out+=arrEntity[slEnt]+slResto;
				} else {
					out+="&"+slEnt+";"+slResto;
				}
			} else {
				out+="&"+sl;
			}
		}
		slices=out.split("&");
		out=slices.shift();
		re = /^#[0-9]+;/i;
		for (s in slices) {
			sl=slices[s];
			if (re.test(sl)) {
				chrCode=sl.substring(1, sl.indexOf(";"));
				slResto=sl.substring(1 + sl.indexOf(";"));
				if (chrCode > 255) {
					chrUni = eval("\"\\u" + hexEncode(4, chrCode) + "\"")
				} else {
					chrUni = eval("\"\\x" + hexEncode(2, chrCode) + "\"")
				}
				out+=chrUni+slResto;
			} else {
				out+="&"+sl;
			}
		}
		return out;
	}
}

//alert javascript che accetta come parametro stringhe contenenti entit HTML.
//le entit riconosciute vengono convertite in formato unicode,
function BPOLalert(strArg) {
	alert(entityEncode(strArg));
}

//confirm javascript che accetta come parametro stringhe contenenti entit HTML.
//le entit riconosciute vengono convertite in formato unicode,
function BPOLconfirm(strArg) {
	return confirm(entityEncode(strArg));
}

//prompt javascript che accetta come parametri stringhe contenenti entit HTML.
//le entit riconosciute vengono convertite in formato unicode,
function BPOLprompt(strArg1, strArg2) {
	return prompt(entityEncode(strArg1), entityEncode(strArg2));
}


