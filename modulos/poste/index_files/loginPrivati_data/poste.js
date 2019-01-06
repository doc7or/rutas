

//funzione visualizza data corrente client.
function visData(){
var days=new Array("Domenica","Luned&igrave;","Marted&igrave;","Mercoled&igrave;","Gioved&igrave;","Venerd&igrave;","Sabato");
var months=new Array("Gennaio","Febbraio","Marzo","Aprile","Maggio","Giugno","Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre");
var dateObj=new Date();
var lmonth=months[dateObj.getMonth()];
var anno=dateObj.getFullYear();
var date=dateObj.getDate();
var wday=days[dateObj.getDay()];
document.write(" " + wday + " " + date + " " + lmonth + " " + anno);}


var bName = navigator.appName;
var bVer = parseInt(navigator.appVersion);

var NS6 = (bName == "Netscape" && bVer >=5 && bVer < 7); //alternativa check su getElementById
var NS4= document.layers;
var IE4=  document.all;

//LAYER SWITCHING CODE

     if (NS4) {
       layerStyleRef="layer.";
       layerRef="document.layers[";
       styleSwitch="]"; layerDoc=".document."
     }
	 else if (IE4) {
        layerStyleRef="layer.style.";
        layerRef="document.all[";
        styleSwitch="].style"; layerDoc=".";
     }
	 else if (NS6) { 
       layerStyleRef="style.";
       layerRef="document.getElementById(";
       styleSwitch=").style"; layerDoc=".";
     }	
     else {
		//vedi un po' tu che vuoi fare. Se uno ha un browser per conto suo?
     }

	 menutop = new Array ()
menutop[0]="menuopenso";
menutop[1]="menuopenco";
menutop[2]="menuopenlp";
menutop[3]="menuopenbp";
menutop[4]="Pmenuopenso";
menutop[5]="Pmenuopenpo";
menutop[6]="Pmenuopenbp";
 
function showLayer(layerName){
        if (NS4 || IE4 || NS6) {
                eval(layerRef+'"'+layerName+'"'+styleSwitch+'.visibility="visible"');
        }       
}
        
   function hideLayer(layerName){
        if (NS4 || IE4 || NS6) {
                eval(layerRef+'"'+layerName+'"'+styleSwitch+'.visibility="hidden"');
                }       
        }
		
		function hideAll () {
	for (i_loc=0; i_loc < menutop.length; i_loc ++) {
		hideLayer (menutop[i_loc]);
	}return false;
}



function setVariables(){
}

function checkLocation(){
}

function checkLocationA(){ystart=eval(y);xstart=eval(x);}
var val50 =1936.27
var dec5 =2
var val51 =(1/val50)
var dec =2

function kommaclean(string){
        i=string.indexOf(",");
        while(i != -1)
        {
                string = string.substring(0,i) + '.' + string.substring(i+1, string.length);
                i=string.indexOf(",");
        }
        i=string.lastIndexOf(".");
        j=string.indexOf(".")
        while(j != i)
        {
                string = string.substring(0,j) + string.substring(j+1, string.length);
                i=string.lastIndexOf(".");
                j=string.indexOf(".");
        }
        return string;
}
function convert(f){
        invalstring = f.input.value
        invalstring = kommaclean(invalstring)
        inval = parseFloat(invalstring);
        if (f.direction.value=='fromeuro'){
                decuit = 3;
                decin  = 3
;
        }else{
                decuit = 3;
                decin  = 3;
                
        }
        inval = parseFloat(formatfloat(inval, decin))
        if (!(inval>0)){
                uitval = 0;
                inval  = 0;
        }else{
                if (f.direction.value=='fromeuro'){
                uitval = inval * val50 + 0.005;
                }else{
                uitval = inval * val51 + 0.005;
                }
        }
        f.result.value=formatfloat(uitval,decuit);
        f.input.value=formatfloat(inval,decin);
}
dec = 3
function formatfloat(fl, dec){
        str=""+fl;
        i = str.indexOf(".");
        if (i<0){
                i=str.length;
                str=str+".00000000000";
        }else{
                if(i==0){
                        i=1;
                        str="0"+str;
                }else{
                        str=str+"00000000000";
                }
        }
        return str.substring(0,i+dec);
}
function newwin (url) {
	window.open(url);
}
function apripopup(purl,ptitle,pwidth,pheight,presisable){

window.open(purl,ptitle,'width='+pwidth+',height='+pheight+',location=0,menubar=0,personalbar=0,resizable='+presisable+',toolbar=0,status=0,scrollbars=1');
return false;
}
function rnd_logo() {
	var now = new Date();
	// incrementare di 1 n_logos quando si aggiunge un nuovo logo
	var n_logos = 6;
	var sec_divide = now.getSeconds();
	rnd_number = (sec_divide % n_logos) + 1;
	document.write("<a href=\"http://www.poste.it\" target=\"_top\"><img src=\"/img/tb/logo_foto0", rnd_number, ".jpg\" width=\"245\" height=\"46\" border=\"0\" alt=\"Home\"></a>");
}

function write_style_tag() {
	cok = "PIlayout"
	val = GetCookie(cok)
	if (val == 2) {document.write("<link rel=\"stylesheet\" href=\"/standard_grande.css\">")}
	else {document.write("<link rel=\"stylesheet\" href=\"/standard.css\">")}
}

function cambiaEsigenza(param){
	this.location.href=param;
}

function cambiaProdotto(param){
	this.location.href=param;
}

//restyle funzione per la modifica dei valori nell'header
<!--



function getCookieVal (offset) {
    var endstr = document.cookie.indexOf (";", offset);
    if (endstr == -1) endstr = document.cookie.length;
    return unescape(document.cookie.substring(offset, endstr));
}
function GetCookie (nomeCookie) {
	var arg = nomeCookie + "=";
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

function IsLoggedOn() {
	return (GetCookie("PCom_Tipo") != null);
}

function IsConsumer() {
	return (GetCookie("PCom_Tipo") == "C");
}

function IsBusiness() {
	return (GetCookie("PCom_Tipo") == "B");
}

function getLinkObject(id) {
    if (document.getElementById(id)) {
      return document.getElementById(id);
    }
    else if (document.all) {
      return document.all[id];
    }
}

function check()
{
	if(IsLoggedOn())
	{
		var principale = getLinkObject("link_principale");
		var logout = getLinkObject("link_logout");
		
//		alert(principale.innerHTML);

		if(IsConsumer())
		{
			principale.href="https://www.poste.it/online/personale/myposte";
			logout.href="https://www.poste.it/online/personale/logout.html";
			principale.innerHTML = "MyPoste <strong>Privati</strong>";
			logout.innerHTML = "Esci";
		}
		else if(IsBusiness())
		{
			principale.href="https://registrazioneimprese.poste.it/registrazione/web/index.jsp";
			logout.href="https://registrazioneimprese.poste.it/registrazione/web/logout.jsp";
			principale.innerHTML = "MyPoste <strong style=color:#ff0000;>Business</strong>";
			logout.innerHTML = "Esci";
		}
		
	}
}
	