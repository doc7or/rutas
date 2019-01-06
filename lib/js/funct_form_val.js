// JavaScript Document

//DECLARACION DE ARAYS
my_message = new Array();

//DECLARACION DE VALORES DE LOS ARRAYS

////////////////////////ARRAYS DE AYUDA////////////////////////////

//esta opcion es para la ayuda de cajas q no necesiten texto de ayuda
my_message[0]='';
//este es el texto pra la cedula
my_message[1]='Indique la cedula esta debe ser con un m&aacute;ximo de 8 d&iacute;gitos y un m&iacute;nimo de 6, recuerde que solo debe ser&nbsp; n&uacute;meros. <font color="#FF0000">Importante el sistema no le permitir&aacute; ingresar cedulas repetidas, cuando lo haga se borrara oblig&aacute;ndole a colocar una no existente.</font>';
//texto pra los emails
my_message[2]='Indique un email el cual debe contener el siguiente formato cuenta@empresa.com Cuenta de&nbsp; correo, empresa ejemplo Hotmail.com, gmail.com, etc';
//tipos de usuarios
my_message[3]='Indique un tipo de usuario, recuerde que cada tipo de usuario tiene sus diferentes niveles de acceso.';
//almacenes para usuarios
my_message[4]='Asocie el usuario a uns sucursal a la cual este pertenezca.';
//status del usuario
my_message[5]='Puede inactivar un usuario o volverlo a activar seleccionando la opci&oacute;n que corresponda.';
//usuario
my_message[6]='Indique un usuario, recuerde que ser&aacute; m&aacute;s la clave su identificaci&oacute;n de acceso. Usuario ejemplo: Mar&iacute;a P&eacute;rez mperez o bien su email. <font color="#FF0000">Importante el usuario debe ser &uacute;nico, si el usuario que coloca existe, el programa lo borrara oblig&aacute;ndole a colocar uno no existente.</font>';
//clave de usuario
my_message[7]='Indique su clave o password, este puede ser conformado por letras n&uacute;meros o los siguientes caracteres especiales solamente (<font color="#FF0000">@-_.</font>). Ejemplo mar345, rob@77_8u, etc. Recomendaci&oacute;n ingrese una clave que pueda recordar con facilidad, &nbsp;pero que a la vez sea segura.';
//repetir clave 
my_message[8]='Repita su clave, el sistema la &nbsp;eliminara si no es igual a la clave proporcionada en el campo anterior. &nbsp;';
//direccion de la sucursal
my_message[9]='Ingrese la direcci&oacute;n del sucursal.';
//indique el estado
my_message[10]='Indique  el estado este a su vez sirve para filtrar la ciudad o zona.';
//zona
my_message[11]='Indique la ciudad o zona que corresponda.';
//nueva zona
my_message[12]='Indique una nueva zona a para el sistema .<font color="#FF0000" > El sistema le impedir&aacute; crear dos zonas del mismo nombre para el mismo estado, de hacerlo el sistema la borrara.</font>';
//este es el texto pra el rif
my_message[13]='Indique el rif este debe ser con un m&aacute;ximo de 7 d&iacute;gitos, seguidos de un guion (-) y el digito de confirmaci&oacute;n, recuerde que solo debe ser&nbsp; n&uacute;meros ejemplo 1234567-0. <font color="#FF0000">Importante el sistema no le permitir&aacute; ingresar rif repetidos, cuando lo haga se borrara oblig&aacute;ndole a colocar una no existente.</font>';
//naturaeza del rif
my_message[14]='Seleccione  la naturaleza N (Natural); &nbsp;J (Jur&iacute;dica)';
//telefono
my_message[15]='Indique  un tel&amp;eacute;fono de contacto solo digite los n&amp;uacute;meros no use guiones ni espacios  ejemplo: 02413458074';
//direcciond de la empresa
my_message[16]='Indique la direcci&oacute;n de la empresa';
//nombre de la empresa
my_message[17]='Indique la nombre de la empresa, si es natural este nombre viene a ser el nombre de la persona';
//codigo de area telefonico
my_message[18]='C&oacute;digo de &aacute;rea telef&oacute;nico, ya sea fijo o m&oacute;vil.';
//numero teleonico
my_message[19]='Ingrese el n&uacute;mero de tel&eacute;fono recuerde debe ser solo num&eacute;ricos, y de 7 d&iacute;gitos.';
//responsable de la empresa
my_message[20]='Nombre del responsable o persona de contacto de la empresa.';
//tipo de empresa
my_message[21]='Indique que tipo de empresa es transportista o escolta.';
//adelanto
my_message[22]='Indique el porcentaje de adelanto que recibir&aacute; esta empresa.';
//empresa especial
my_message[23]='Indique el porcentaje de bono que recibir&aacute; esta empresa por ser especial.';
//empresa asociada
my_message[24]='Seleccione la empresa a la que pertenece, recuerde que si es independiente, debe seleccionar la empresa que corresponde a su nombre de no  existir, dir&iacute;jase al modulo de empresas y agr&eacute;guela.';
//nombre de el responsable de la sucursal
my_message[25]='Nombre del responsable o persona de contacto de la sucursal.';
//placa del vehiculo
my_message[26]='Indique la  placa de el veh&iacute;culo, recuerde esta debe ser &uacute;nica no podr&aacute; ingresar placas  repetidas de hacerlo el sistema se la borrara para que ingrese una valida.';
//placa del vehiculo
my_message[27]='Escriba la marca de este veh&iacute;culo.';
//tipo de vehiculo
my_message[28]='Indique el  tipo de veh&iacute;culo al que corresponda';
//empresa del vehiculo
my_message[29]='Indique la empresa a la que pertenecer&aacute; este vehiculo.de no existir dir&iacute;jase a m&oacute;dulo empresas y agregue la empresa a la cual pertenece este veh&iacute;culo.';
//observacion del vehiculo
my_message[30]='En este campo indique cualquier comentario que considere pertinente del veh&iacute;culo,  como por ejemplo: (remodelaci&oacute;n del veh&iacute;culo, etc.). De ser un usuario auditor,  de considerarlo pertinente, adicione aqu&iacute; cualquier observaci&oacute;n. ';
//tipo del vehiculo
my_message[31]='Seleccione el tipo de veh&iacute;culo, este dato es necesario para determinar el  tabulador para este veh&iacute;culo.';
//activacion del vehiculo
my_message[32]='Esta opci&oacute;n est&aacute; habilitada solo para el usuario auditor. Usted podr&aacute; inactivar  un veh&iacute;culo, si se encuentra incongruencias en los datos del mismo; as&iacute; como  activarlo de ser pertinente. Coloque las observaciones necesarias en el campo  de observaci&oacute;n.';
//abreviatura del tipo de vehiculo
my_message[33]='Indique la abreviatura del tipo de veh&iacute;culo, esta debe ser de 4 caracteres  pueden ser letras o n&uacute;meros ola combinaci&oacute;n de&nbsp;  ambas. Ejemplo NPRC para un NPR CAVA. No se permitir&aacute;n abreviaturas repetidas,  el sistema las borrara de usarlas.';
//detalle  del tipo de vehiculo
my_message[34]='El detalle sirve para colocar mas informaci&oacute;n acerca del tipo de veh&iacute;culo,  como puede ser el nombre completo.';
//caleta  del tipo de vehiculo
my_message[35]='Indique el costo de la caleta a usar por este tipo de veh&iacute;culo.';
//metraje minimo del tipo de vehiculo
my_message[36]='Metraje cubico m&iacute;nimo de este tipo de veh&iacute;culo.';
//metraje maximo  del tipo de vehiculo
my_message[37]='Metraje cubico m&aacute;ximo de este tipo de veh&iacute;culo.';

////////////////////////ARRAYS DE AYUDA////////////////////////////

// listas de caracteres
var digits = "0123456789";
var charLettersBase = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
var charLettersEspanol = "�������������";
var whitespace = " \t\n\r";
var charMail = "-_@";
var charNumFloat = ".,-"; 
var phoneChars = "()-+ ";
var charNameAdd = " .";
var charNumMenos = "-"; 


//DECARACON VALIDACION DE FORMULARIOS GENERICAS
/*
	my_form = new Array();
	columnas i=id_campo; j=tipo_campo; 
	tipos campo:
	1 	texto ordinarios select
	2 	radios
	3 	chek
	4 	mail
	5 	numeros solos
	6 	numeros float
	7 	cedula
	8	rif
	9	alfa
	10  alfa_mail_pl valida q los caracteres emitidos sean validos para mails , claves , contracese;as y usuarios
	11  nombres y apellidos
	
	ejemplo 
		my_form[0][0]='cedula';
		my_form[0][1]=1;
																
		
		
*/

//DECLARACION DE VARIABLES GLOBALES

//VALIDACION DEL FORMULARIOS GENERICA/////////////////////////////////////////////////////////////////////////////////////////////

//PRINCIPAL/////
function valida_form(my_form_column,my_form_tipo,myForm,myPase,myErrorMessage,strinSubmitAsin){
	//my_form_column array q trae los id de los campos
	//my_form_tipo aray que contiene el tipo de validacion que se le debe hacer al campo
	//myForm id del formulario con el q se trabaja
	//myPase id campo de pase seguro
	//myErrorMessage id donde se cargara el mensaje de error
	//valEnvio valida el envio para si se hace submit de una o no
	//strinSubmitAsin   string a pasar con los campos y los datos de el formulario asincrono en la occion de envio se valida que sea asincrono y hay mismo se revisa la desconcatenacion
	
	var cuantos=my_form_column.length;
	//alert(my_form_tipo[0]+'---'+my_form_tipo[1]+'---'+my_form_tipo[2]);
	
	var mensaje_error='Los campos se&ntilde;alados en rojo contienen errores de formato u omisi&oacute;n. Rev&iacute;selos por favor para continuar.';
	var error_activo=0;
	for(j=0;j<cuantos;j++){
		//alert(j);
		var swch=false;
		$("#"+my_form_column[j]).removeClass('form_error');
		
		//case of para buscar la funcion correspondiente
		switch (my_form_tipo[j])
			{
				case 1:	
				  swch=valida_texto_select(my_form_column[j]);
				  break;
				case 2:
				  swch=valida_radio(my_form_column[j]);		
				  break;
				case 3:
				  swch=valida_chek(my_form_column[j]);				  
				  break;
				case 4:
				  swch=valida_mail(my_form_column[j]);				  
				  break;
				case 5:
				  swch=valida_numeros_solos(my_form_column[j]);
					break;
				case 6:
				  swch=valida_numeros_float(my_form_column[j]);
				  break;
				case 7:
				  swch=valida_cedula(my_form_column[j]);
				 	break;
				case 8:
				  swch=valida_rif(my_form_column[j]);
				 break;
				case 9:
				  swch=valida_alfa(my_form_column[j]);
				  break;
				case 10:
				  swch=valida_alfa_mail_pl(my_form_column[j]);
				  break;
				case 11:
				  swch=valida_nombres(my_form_column[j]);
				  break;
				case 12:
				  swch=valida_telefono(my_form_column[j]);
				  break;
				 case 13:
				  swch=valida_placa(my_form_column[j]);
				  break;
			}//FIN SWITCH
		//si en la iteracion hubo un error esta caja se pintara en error
	
	//alert('despues de las funciones'+j)
		if (swch) {
			$("#"+my_form_column[j]).addClass('form_error');
			error_activo=1;
		}
	}///FIN DEL FOR
	if(error_activo==1) {
		//alert('si entra aqui'+myErrorMessage);
		$("#"+myErrorMessage).html(mensaje_error); 
		return 0;
		}
	else {
		$("#"+myErrorMessage).html(''); 
		$("#"+myPase).val(true); 
		//si el envio pasa validacion 0 si pasa para q si
		//alert(valEnvio);
		if(strinSubmitAsin==null)	formSubmit(myForm);
		if(strinSubmitAsin){
			//estosucede que se le pasan valores especiales de validadion y envio de este formulario a otro funcion
			//enviamos mediante el metodo $.post
			//desempaqetamos el strin enviado en sus diferentes niveles
			//nivel 0 se parado por ## url+'##'+form+'##'+idCarga+'##'+campoVal 			
			
			var cadena=strinSubmitAsin.split('##');
			$.post(cadena[0], $("#form1").serialize(), function(data){
				if(data.length >0) {					
					$('#cargaAsinc').html(data);
				}
			});
			
		}
	}

}

//VALIDAR TEXTOS ORDINARIOS.... ESTA FUNCION SOLO COMPURUEBA SI UN CAMPO ESTA VACIO O ES CERO DE ESTARLO DEVUELVE FALSE Y ADDICIONA LA CLASE DE FORM ERROR 
function valida_texto_select(id_campo){
	var s = $("#"+id_campo).val();
	var nulo = isNull(s);
	if (nulo) return true;	
}

//VALIDAR RADIOS ... ESTA FUNCION SOLO COMPURUEBA SI SE ESCOJI UNA OPCION DE SER REQUERIDO Q LA ESCOJA
function valida_radio(id_campo){
	var s = $("#"+id_campo).val();
	var nulo = isNull(s);
	if (nulo) return true;
	
	
}
//VALIDAR CHEK.... ESTA FUNCION SOLO VALIDA SI SE ESCOGIO ALGUNA OPCION DEL CKECK
function valida_chek(id_campo){
	var s = $("#"+id_campo).val();
	if (s!='') return true;
	else return false;
	
}


//VALIDAR MAIL.... ESTA FUNCION SOLO COMPURUEBA SI UN CAMPO ESTA VACIO DE ESTARLOR DEVUELVE FALSE Y ADDICIONA LA CLASE DE FORM ERROR

function valida_mail(id_campo)
{
	var s = $("#"+id_campo).val();
	var filter=/^[A-Za-z][A-Za-z0-9_]*@[A-Za-z0-9_]+\.[A-Za-z0-9_.]+[A-za-z]$/;
	var nulo = isNull(s);
	if (nulo) return false;
   	if (filter.test(s)) return false;
   	else return true;
}

//VALIDAR NUMEROS SOLOS.... ESTA FUNCION VALIDA Q LA CAJA CONTENGA SOLO NUMEROS
function valida_numeros_solos(id_campo){
	var s_sn = $("#"+id_campo).val();
	for (i_sn=0;i_sn<s_sn.length;i_sn++){
		
			if(!isDigit(s_sn.charAt(i_sn))) {
				return true;
				i_sn=s_sn.length;
			}
	}
}

//VALIDAR ALFA.... ESTA FUNCION VALIDA Q LA CAJA CONTENGA SOLO ALFABETICOS
function valida_alfa(id_campo){
//	alert('entra a esta validacion');
	var s_a = $("#"+id_campo).val();
	if(s_a.length>0){
		for (i_a=0;i_a<s_a.length;i_a++){
			
				if(!isLetter(s_a.charAt(i_a))) {
					return true;
					i_a=s_a.length;
				}
		}
	}
	else return true;
}

//VALIDAR ALFA NOMBRES Y APELLIDOS.... ESTA FUNCION VALIDA Q LA CAJA CONTENGA SOLO ALFABETICOS
function valida_nombres(id_campo){
//	alert('entra a esta validacion');
	var s_a = $("#"+id_campo).val();
	if(s_a.length>0){
		for (i_a=0;i_a<s_a.length;i_a++){
			
				if(!isLetterName(s_a.charAt(i_a))) {
					return true;
					i_a=s_a.length;
				}
		}
	}
	else return true;
}

//VALIDAR ALFA.... ESTA FUNCION VALIDA Q LA CAJA CONTENGA SOLO ALFABETICOS
function valida_alfa_mail_pl(id_campo){
//	alert('entra a esta validacion');
	var s_amp = $("#"+id_campo).val();
	if(s_amp.length>0){
		for (i_amp=0;i_amp<s_amp.length;i_amp++){
			
				if(!isChartMail(s_amp.charAt(i_amp))) {
					return true;
					i_amp=s_amp.length;
				}
		}
	}
	else return true;
}
//VALIDAR NUMEROS FLOAT.... ESTA FUNCION VALIDA Q LA CAJA CONTENGA SOLO NUMEROS O NUMERON FLOTANTES CON PUNTO Y COMA DECIMALES
function valida_numeros_float(id_campo){
	//alert('Dios mio');
	var s_nf = $("#"+id_campo).val();
	if(s_nf.length>0){
		for (i_nf=0;i_nf<s_nf.length;i_nf++){
			
				if(!isFloat(s_nf.charAt(i_nf))) {
					return false;
					i_nf=s_nf.length;
				}
		}
	}
	else return true;
	
}

//VALIDAR NUMEROS CEDULA.... ESTA FUNCION VALIDA Q LA CAJA CONTENGA SOLO NUMEROS Y TENGA LAS DIMENCIONES DE UNA CEDULA
function valida_cedula(id_campo){
	var s_c = $("#"+id_campo).val();
	if(s_c.length>6 && s_c.length<9)
	{
		for (i_c=0;i_c<s_c.length;i_c++){
				if(!isDigit(s_c.charAt(i_c))) {
					return true;
					i_c=s_c.length;
				}
		}
	}
	else
	{
		return true;
	}
}

//VALIDAR NUMEROS RIF.... ESTA FUNCION VALIDA Q LA CAJA CONTENGA SOLO NUMEROS Y TENGA LAS DIMENCIONES DE UN RIF
function valida_rif(id_campo){
	var s_r = $("#"+id_campo).val();
	if(s_r.length==10)//validamos q el rif solo sea de 10 digitos
	{
		s_r_d=s_r.split('-');//divido el string para validar 
		if(s_r_d.length==2)
		{//si es de longitud 2 sequimos de no serlos devolvemos true para decir q es incorrecto el rif
			if(s_r_d[1].length==1){
				for (i_r=0;i_r<s_r.length;i_r++){
					
						if(!isDigitMenos(s_r.charAt(i_r))) {
							return true;
							i_r=s_r.length;
						}
				}
			}
			else
			{
				return true;
			}
		}
		else
		{
			return true;
		}
	}
	else
	{
		return true;
	}
	
}

//VALIDAR NUMEROS TELEFONOS.... ESTA FUNCION VALIDA Q LA CAJA CONTENGA SOLO NUMEROS Y TENGA LAS DIMENCIONES DE UN TELEFONOS
function valida_telefono(id_campo){
	var s_r = $("#"+id_campo).val();
	if(s_r.length==7)//validamos q el rif solo sea de 10 digitos
	{
		
				for (i_r=0;i_r<s_r.length;i_r++){
					
						if(!isDigit(s_r.charAt(i_r))) {
							return true;
							i_r=s_r.length;
						}
				}
		
	}
	else
	{
		return true;
	}
	
}

//VALIDAR PLCAS DE VEHICULOS
function valida_placa(id_campo){
	var s_p = $("#"+id_campo).val();
	if(s_p.length>4 && s_p.length<8)//validamos q pa placa sea de 6 o 7 digitos solamente
	{
		
				for (i_r=0;i_r<s_p.length;i_r++){
					
						if(!isLetterOrDigit(s_p.charAt(i_r))) {
							return true;
							i_r=s_p.length;
						}
				}
		
	}
	else
	{
		return true;
	}
	
}

//FUNCION PARA VALIDAR LAS CLAVES SON IGUALES
function valida_rpass(r_pass,clave){
//	alert('rpass '+r_pass+' clave '+clave);
	rpass=$("#"+r_pass).val();
	clave=$("#"+clave).val();
	if(rpass!=clave){
		$("#"+r_pass).val('');
	
	}
}






//VALIDACION DEL FORMULARIOS GENERICA///

//ENVIO DE FORMULARIO SUBMIT
function formSubmit(myForm)
{
	//	alert('si envia');
	document.getElementById(myForm).submit();
}

//DETERMINA SI ES NULO CERO O VACIO
function isNull(valor)
{
	if(valor=='' || valor==0) return true;
}

function isLetter (c)
{
    if( (charLettersBase.indexOf(c)!= -1) || (charLettersEspanol.indexOf(c)!= -1) ) return true;
}

function isLetterName (c)
{
    if( (charLettersBase.indexOf(c)!= -1) || (charLettersEspanol.indexOf(c)!= -1) || (charNameAdd.indexOf(c)!= -1)  ) return true;
}

function isChartMail (c)
{
    if( (charLettersBase.indexOf(c)!= -1) || (charMail.indexOf(c)!= -1) || isDigit(c) ) return true;
}

function isFloat (c)
{
    if( (digits.indexOf(c) != -1 ) || (charNumFloat.indexOf(c) != -1 ) )  return true;
}

// c es un digito
function isDigit (c)
{    if ( ( digits.indexOf( c ) != -1 ) )  return true;
}

// c es un digito rif o telefonos o cualquiera de igual manera separados con -
function isDigitMenos (c)
{    if ( ( digits.indexOf( c ) != -1 ) || (charNumMenos.indexOf(c) != -1 ))  return true;
}

// c es letra o digito
function isLetterOrDigit (c)
{   if (isLetter(c) || isDigit(c))  return true;
}

//VALIDACION DEL FORMULARIOS GENERICA/////////////////////////////////////////////////////////////////////////////////////////////

///CONFIRMACION DE EDICION///
function confirmEdit(cMsg,myForm){
	if(confirm('Confrme que desea editar '+cMsg)){
		formSubmit(myForm);
	}
}
///CONFIRMACION DE ELIMINACION///
function filtros(url,listaParametros){
	//alert(listaParametros);
	v_parametro = new Array();
	urlParame='?';
		s_parametros=listaParametros.split(',');//divido el string para validar 
		
		for (i=0;i<s_parametros.length;i++){
			//s_parametros[i];//lo q me contiene esta s_parametros variable sera el parametro q pasare por la funcion
			v_parametro[i]=$("#"+s_parametros[i]).val();
			if(i==0){
				urlParame+=s_parametros[i]+'='+v_parametro[i];	
			}else{
				urlParame+='&'+s_parametros[i]+'='+v_parametro[i];	
			}
			
	}
		document.location.href=url+urlParame;
	
}

///CONFIRMACION DE ELIMINACION///
function confirmDeletePer(cMsg, dURL){
	if(confirm('Confrme que desea eliminar '+cMsg)){
		document.location.href=dURL;
	}
}

///CONFIRMACION DE ANULACION///
function confirmDelete(cMsg, dURL){
	if(confirm('Confrme que desea anular '+cMsg)){
		document.location.href=dURL;
	}
}

//FUNCIONES DE AYUDA//
function message_help(id_menssage){
	//id_menssage este  id es el numero de el mensaje en el arreglo my_message
		$("#tr_message").html('<div id="mensaje_ayuda">'+my_message[id_menssage]+'</div>');
	
		
	
	}

//FUNCIONES PARA CPMPROBAR EXISTENCIA DE UN  DATO PARA NO REPETIR EL MISMO DE SER NECESARIO USARSE///
function existence(tabla,campo,id_campo_carga,id_tabla_edit,valor_id_tabla_edit,id_tabla_add,valor_id_tabla_add,id_sucursal,valor_sucursal){
	//alert('ENTRAMOS'+id_tabla_add);
		var url='asin_existence.php';
		var valor_campo=$("#"+id_campo_carga).val();
		if(valor_id_tabla_add){
		
			valor_id_tabla_add=$("#"+valor_id_tabla_add).val();
		}
		
		$("#load_datos_help").load(url+'?tabla='+tabla+'&campo='+campo+'&valor_campo='+valor_campo+'&id_campo_carga='+id_campo_carga+'&id_tabla_edit='+id_tabla_edit+'&valor_id_tabla_edit='+valor_id_tabla_edit+'&id_tabla_add='+id_tabla_add+'&valor_id_tabla_add='+valor_id_tabla_add+'&id_sucursal='+id_sucursal+'&valor_sucursal='+valor_sucursal);
		
		
	}


function res_existence(id_campo_carga){
		$("#"+id_campo_carga).val('');
		
	}
//FUNCIONES PARA CPMPROBAR EXISTENCIA DE UN  DATO PARA NO REPETIR EL MISMO DE SER NECESARIO USARSE///

///FUNCION PARA VALIDAR INGRESO DE SOLO NUMEROS,LETRAS,LETRAS NUMEROS,TEXTO MAIL//
var nav4 = window.Event ? true : false;
function acceptNum(evt){
	//ESTAS ME PRESENTABAN PROBLEMAS CON FIREFOX Y IE LAS DEJO POR CUALQIER URGENCIA
// NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57
//var key = nav4 ? evt.which : evt.keyCode;
//return (key <= 13 || (key >= 48 && key <= 57));
//if ((event.keyCode > 32 && event.keyCode < 48) || (event.keyCode > 57 && event.keyCode < 97)  || (event.keyCode > 96 && event.keyCode < 127) ) event.returnValue = false;

var keyPressed = (evt.which) ? evt.which : event.keyCode
return !(keyPressed > 31 && (keyPressed < 46 || keyPressed > 57));

}

function acceptNumCed(evt){
var keyPressed = (evt.which) ? evt.which : event.keyCode
return !(keyPressed > 31  && (keyPressed < 45 || keyPressed > 46)  && (keyPressed < 48 || keyPressed > 57));
}

function acceptNumFloat(evt){
var keyPressed = (evt.which) ? evt.which : event.keyCode
return !(keyPressed > 31  && (keyPressed < 45 || keyPressed > 46)  && (keyPressed < 48 || keyPressed > 57));
}

function acceptNumRif(evt){
var keyPressed = (evt.which) ? evt.which : event.keyCode
return !(keyPressed > 31  && (keyPressed < 44 || keyPressed > 45)  && (keyPressed < 48 || keyPressed > 57));
}

function acceptNumAlfa(evt){
	var keyPressed = (evt.which) ? evt.which : event.keyCode
	return !(keyPressed > 31 && (keyPressed < 48 || keyPressed > 57) && (keyPressed < 65 || keyPressed > 90) && (keyPressed < 97 || keyPressed > 122));
}

function acceptAlfa(evt){
	//acepta alfabeticos ademas de puntos y vacios
	var keyPressed = (evt.which) ? evt.which : event.keyCode
	return !(keyPressed > 31  && (keyPressed < 65 || keyPressed > 90) && (keyPressed < 97 || keyPressed > 122));
}

function acceptAlfaNombres(evt){
	//acepta alfabeticos ademas de puntos y vacios
	var keyPressed = (evt.which) ? evt.which : event.keyCode
	return !(keyPressed > 31 && (keyPressed != 32)  && (keyPressed != 46) && (keyPressed < 65 || keyPressed > 90) && (keyPressed < 97 || keyPressed > 122));
}



function acceptNumAlfaMail(evt){
	var keyPressed = (evt.which) ? evt.which : event.keyCode
	return !(keyPressed > 31 && (keyPressed < 45 || keyPressed > 46) && (keyPressed < 48 || keyPressed > 57) && (keyPressed < 64 || keyPressed > 90) && (keyPressed != 95) && (keyPressed < 97 || keyPressed > 122) );
}
///FUNCION PARA VALIDAR INGRESO DE SOLO NUMEROS,LETRAS,LETRAS NUMEROS,TEXTO MAIL//

//DESABILITAR PEGAR//
function EliminarPegar(e) {
return !(e.keyCode==86 && e.ctrlKey)
}
//DESABILITAR PEGAR//

//FUNCION QUE CHECHA UNA LISTA MUY LARGA
function checarTodos(check,cantidad){

	
	for(i=0;i<cantidad;i++){
		document.getElementById(check+i).checked=true;
		
	}
}

//FUNCION QUE DE CHECHA UNA LISTA MUY LARGA
function unChecarTodos(check,cantidad){
	
	for(i=0;i<cantidad;i++){
		document.getElementById(check+i).checked=false;
		
	}
}

function submitFrom(myForm,caja)
{
	$("#"+caja).val('1');
	formSubmit(myForm);
}

function validar_monto(event,campo){
                 var validar1=/^[0-9\.]{1,}$/; 
                 if (event.keyCode!=8){
                 if (!validar1.test(document.getElementById(campo).value)){
                        alert('Debe colocar un monto de factura Valido');
                        return;
                    }
                 }    
}
