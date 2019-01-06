// JavaScript Document
//Mervin Mujica
//funciones de ajax 
var conexion1;
var divi;
var variable_1=0;
var msg;
function crearXMLHttpRequest() 
{
  var xmlHttp=null;
  if (window.ActiveXObject) 
    xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
  else 
    if (window.XMLHttpRequest) 
      xmlHttp = new XMLHttpRequest();
  return xmlHttp;
}

function general(urld){
	  url = urld;
  conexion1=crearXMLHttpRequest();
  conexion1.onreadystatechange = procesarEventos1;
  conexion1.open("GET", url, true);
  conexion1.send(null);
	}
        
        function general1(param,url){
  conexion1=crearXMLHttpRequest();
  conexion1.onreadystatechange = procesarEventos_inser;
  conexion1.open("POST", url, true);
   conexion1.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  conexion1.send(param);
	}
       
function procesarEventos()
{

 // var detalles = document.getElementById("comentarios");
  if(conexion1.readyState == 4)
  {
    //detalles.innerHTML = conexion1.responseText;
conexion1.responseText
	var inser = document.getElementById(divi);
	  inser.innerHTML=conexion1.responseText;
  if (variable_1==1){
  	alert(msg);
  }else if (variable_1==2){
  	document.getElementById(msg).style.display="block";
  }
  } 
  else 
  {
	  var inser = document.getElementById(divi);
	  inser.innerHTML="Cargando ..."
    //detalles.innerHTML = 'Cargando...';
  }
}

function procesarEventos1()
{
 // var detalles = document.getElementById("comentarios");
  if(conexion1.readyState == 4)
  {
    //detalles.innerHTML = conexion1.responseText;

        var inser = document.getElementById(divi);
        var resp=conexion1.responseText;
       // alert(resp+" aa "+divi);
        vec=resp.split("*");//se separa lo que se devuelve del archivo php por * y el primer elemento es la opcionq entra en el switch lo segundo es lo q se va a ejecutar
		//alert(" aa "+vec[1]);
        switch(vec[1]){
            case "alert":
                alert(vec[2]);
                break;
            case "nada":
                inser.innerHTML=vec[2];
                document.getElementById("lista_archivos").removeChild(inser);
                break;
            case "solici":
                document.getElementById("campo_estruc").style.display="none";
                document.getElementById("escribir").style.display="none";
                document.getElementById(divi).innerHTML=vec[2];
            break;
            case "alert-html":{
            	alert(vec[2]);
            	document.getElementById(divi).innerHTML=vec[3];
            	break;
            }
            case "correo":{
            	document.getElementById(divi).innerHTML=vec[2];
            	if (vec[3]!="")
            	window.open("formato.php?id="+vec[3]);
            	break;
            }
               default:
                   document.getElementById(divi).innerHTML=conexion1.responseText;
                   break;
        }
        
	  
//conexion1.responseText;
//alert(conexion1.responseText);
//alert($dividir[0]);
	
  }
  else 
  {
	  var inser = document.getElementById(divi);
	//  inser.innerHTML="<img src='images/cargando_3.gif' />"
    //detalles.innerHTML = 'Cargando...';
  }
}


function procesarEventos_inser()
{
  if(conexion1.readyState == 4)
  {
      
      var inser = document.getElementById(divi);
        var resp=conexion1.responseText;
        //alert(resp+" aa "+divi);
        vec=resp.split("*");//se separa lo que se devuelve del archivo php por * y el primer elemento es la opcionq entra en el switch lo segundo es lo q se va a ejecutar

        switch(vec[0]){
            case "alert":
                alert(vec[1]);
                break;
             default:
                 inser.innerHTML=vec[0];
                 document.getElementById("alertas_num").value=vec[1];
                 break;
        }
  
  }else 
  {

  }
}


function procesarEventos_n()
{
 // var detalles = document.getElementById("comentarios");
  if(conexion1.readyState == 4)
  {
    //detalles.innerHTML = conexion1.responseText;
 // var inser = document.getElementById(divi);
	 // inser.innerHTML="";
	
    var miTabla = document.getElementById("cuerpoTabla");
    var fila = document.createElement("tr");
    var celda0 = document.createElement("td");
    var celda1 = document.createElement("td");
    var celda2 = document.createElement("td");
$dividir=conexion1.responseText;
//alert($dividir);
$dividir1=$dividir.split("//");
  if ($dividir1[2]=="1"){
		  capa_boton=document.getElementById("boton_agre");
		  capa_boton.innerHTML='<input class="botones" type="button" name="a" onclick="suma()" value="Agregar Codigo"/>';
		  }
	fila.setAttribute("id",$dividir1[1]);
	celda0.innerHTML='<a href="javascript:remover(\''+$dividir1[1]+'\');">Eliminar</a>';
    celda1.innerHTML = $dividir1[0];
    if ($dividir1[2]==null)
    $dividir1[2]='';
    celda2.innerHTML = "<div id='b"+$dividir1[1]+"'>"+$dividir1[2]+" </div>";
    fila.appendChild(celda0);
    fila.appendChild(celda1);
    fila.appendChild(celda2);
    miTabla.appendChild(fila);
  } 
  else 
  {
	  //var inser = document.getElementById(divi);
	  //variable_im="<img src='images/cargando_3.gif' /><br /><span>CARGANDO...</span>";
	 // inser.innerHTML=variable_im;
    //detalles.innerHTML = 'Cargando...';
  }
}

	function kadabra(zap) {
			if (document.getElementById) {
				var abra = document.getElementById(zap).style;
				if (abra.display == "block") {
					abra.display = "none";
					} else {
					abra.display = "block"
					} 
				return false
				} else {
				return true
				}
			}
			
function kadabra1(zap) {
	var capas=new Array(5);
	capas[0]="mensa_revi";
	capas[1]="mensa_proce";
	capas[2]="mensa_term";
	capas[3]="mensa_elim";
	capas[4]="mensa_direc";
	var abra;
	for (i=0;i<5;i++){
		abra = document.getElementById(capas[i]).style;
		if (capas[i]!=zap)
		abra.display = "none";
	}
}

function TiempoSistema(){
 var t = parseInt(document.getElementById("hora_h").value);
 var days = parseInt(t/86400);
 t = t-(days*86400);
 var hours = parseInt(t/3600);
 t = t-(hours*3600);
 var minutes = parseInt(t/60);
 t = t-(minutes*60);
 var content = "";
 if(days)content+=days+" días";
 if(hours||days){ if(content)content+=", "; content+=hours+" horas"; }
 if(content)content+=", "; content+=minutes+" minutos y "+t+" segundos.";
 document.getElementById('hora').value = content;
}

