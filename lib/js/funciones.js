// JavaScript Document

var x;

//x=$(document);

function simulHref(url)
{
	window.location = url;
}

function loadBasic(id_carga,url,id,campoAdd,campoAdd2)
{
	/*
		FUNCION DE CARGA BASICA DE UN URL CUALQUIERA PASANDOLE UN IDENTIFICADOR
		id_carga	id donde se va a cargar la pagina
		url			pagina de carga
		id			identificador
	*/
	//var core=$("#"+campoAdd).val();
	var core='cyberlux';
	if(campoAdd2)	id=$("#"+campoAdd2).val();
	//alert(core);
	$("#"+id_carga).html('<img src="../images/ajax-loader.gif"  align="baseline" />');
	$("#"+id_carga).load(url+'?id='+id+'&core='+core);

}

function udp_medidas(id_llamada,indice,url,id,id_carga)
{

	/*	id_carga	id donde se va a cargar la pagina
		url			pagina de carga
		id_llamada	id_donde se hace la llamada	esta viene en una cadena a descomprimir por ...
		indice el es indice de cada caja
	*/
	$("#"+id_carga).html('');
	var medidas=id_llamada.split('...');
	var largo=$("#"+medidas[0]+indice).val();
	var ancho=$("#"+medidas[1]+indice).val();
	var alto=$("#"+medidas[2]+indice).val();
	id_carga=id_carga+indice;


	$("#"+id_carga).load(url+'?largo='+largo+'&ancho='+ancho+'&alto='+alto+'&id='+id+'&id_carga='+id_carga);

}



function change_tabul(id_llamada,id_carga,url,id)
{

	/*	id_carga	id donde se va a cargar la pagina
		url			pagina de carga
		id_llamada	es indice de cada caja
		id			idenbtificador

	*/

	$("#"+id_carga).html('');
	var valor=$("#"+id_llamada).val();
	$("#"+id_carga).load(url+'?id='+id+'&valor='+valor);

}

function load_page(id_carga,url,id_llamada)
{
	/*	id_carga	id donde se va a cargar la pagina
		url			pagina de carga
		id_llamada	id_donde se hace la llamada	*/
	//alert(id_llamada);
	$("#"+id_carga).load(url+'?id_llamada='+id_llamada);

}

function load_pool(id_carga,url,id_tabla,id_edit)
{
			var id_tabla=$("#"+id_tabla).val();
			//alert(id_tabla);
			$("#"+id_carga).html('');
			$("#"+id_carga).load(url+'?id_tabla='+id_tabla+'&id_edit='+id_edit);
}

function load_multiple(id_carga,url,id_tabla){

	var id_tabla=$("#"+id_tabla).val();
	//alert(id_tabla);
	id_carga=id_carga.split(',');
	url=url.split(',');
	cuantos=id_carga.length;
	for(i=0;i<cuantos;i++){
			$("#"+id_carga[i]).html('');
			$("#"+id_carga[i]).load(url[i]+'?id_tabla='+id_tabla);

	}

}

function clear_caja(id)
{
	$("#"+id).val('');
}

function oculta_filas(id_fila,num_filas){
	//id_fila es la fila q se va a ocultar este debe tener un fortamo ejemplo fila_ o fina al cual se le agregara el indice
	//	del for para buscar el verdadero id
	//num_filas numero de filas a ocultar

	for(i=0;i<num_filas;i++){
		$("#"+id_fila+i).addClass('not_display');
	}

}

function mostrar_fila(id_fila,num_filas,posicion,id_llamada){
	/*	PARAMETROS DE LA FUNCION
		id_fila es la fila q se va a ocultar este debe tener un fortamo ejemplo fila_ o fina al cual se le agregara el indice
			del for para buscar el verdadero id
		num_filas numero de filas a ocultar
		posicion fila q se va a mostrar
		id_llamada este es el campo donde se va a colocar la ruta, es de acotar hay un campo oculto con el nombre h_+d_llamada es donde se guarda el valor de la
			posicion de la escaa en la base datos, con esto se evita hacer el ordenamiento en el mismo servidor lo cual garantiza mas rapides

	*/
	oculta_filas(id_fila,num_filas);
	$("#"+id_fila+posicion).removeClass('not_display');
	$("#"+id_llamada).val('');
	$("#h_"+id_llamada).val('');
	$("#id_"+id_llamada).val('');
	limpia_calcula_tabulador('valor_viaje','valor_escolta','valor_adelanto','valor_caleta','carga_monto');


}


function carga_ruta(id_llamada,valores_campo_ord){
	/*	PARAMETROS DE LA FUNCION
		id_llamada este es el campo donde se va a colocar la ruta, es de acotar hay un campo oculto con el nombre h_+d_llamada es donde se guarda el valor de la
			posicion de la escaa en la base datos, con esto se evita hacer el ordenamiento en el mismo servidor lo cual garantiza mas rapides
		valores_campo_ord contiene un strin separado por coma con la posicion de la ruta mas la descripcion de la ruta misma o zona
	*/
	campo=valores_campo_ord.split(',');
	valor_mostrar=$("#"+id_llamada).val();
	valor_oculto=$("#h_"+id_llamada).val();
	valor_oculto_id=$("#id_"+id_llamada).val();
	//alert('posicion '+campo[0]+' zona '+campo[1]+' text_visible '+valor_mostrar+' text oculto '+valor_oculto+' valor_oculto_id '+valor_oculto_id);
	if(valor_mostrar=='' && valor_oculto=='' && valor_oculto_id==''){
		$("#h_"+id_llamada).val(campo[0]);
		$("#"+id_llamada).val(campo[1]);
		$("#id_"+id_llamada).val(campo[2]);

	}
	else{
		texto_ordenado=ordenar_ruta(valor_mostrar,valor_oculto,valor_oculto_id,id_llamada,campo[1],campo[0],campo[2]);
		//alert(texto_ordenado);
		texto_ordenado=texto_ordenado.split('---');
		$("#"+id_llamada).val(texto_ordenado[0]);
		$("#h_"+id_llamada).val(texto_ordenado[1]);
		$("#id_"+id_llamada).val(texto_ordenado[2]);
	}

	calcula_tabulador('id_ruta','vehiculo_tipo','empresa_transportista','valor_viaje','valor_escolta','valor_adelanto','valor_caleta','carga_monto','valor_amarre');
}

function carga_ruta_ind(valor,id_carga){
	
	
	cvalor=$("#"+valor).val();
	

	if(cvalor!=0){
		campo=cvalor.split(',,');
			$("#"+id_carga).val(campo[1]);
			$("#id_"+id_carga).val(campo[0]);
			$("#h_"+id_carga).val('1');
			

	}else{
		$("#"+id_carga).val('');
	}

	calcula_tabulador('id_ruta','vehiculo_tipo','empresa_transportista','valor_viaje','valor_escolta','valor_adelanto','valor_caleta','carga_monto','valor_amarre');
}

function ordenar_ruta(vm,vo,vo_id,id_llamada,new_m,new_o,new_o_id){
	/*	PARAMETROS DE LA FUNCION
		vm valor actual de la caja de rutas
		vo valor actual de la caja oculta de posiciones
		vo valor actual de la caja oculta de id_zona
		c contador de longitud de las cajas
		new_o nuevo valor oculto
		new_o_id nuevo valor oculto del id zona
		new_m nuevo valor a mostrar
		swo	suiches para oculto
		swm suiches para mostrar
	*/
	vm=vm.split(', ');
	vo=vo.split(', ');
	vo_id=vo_id.split(', ');
	c=vm.length;
	swmenor=0;
	swigual=0;
	sm='';
	so='';
	so_id='';

	for(i=0;i<c;i++){// en este for se busca si el nuevo valor vo es menor a cualquiera ya colocado de serlo se colocara en ea posiion y correra adelante a los demas
		if (new_o==vo[i]){
			//alert('es igual');
			swigual=1;
			i=c+1;

		}//fin si es igual
		if(new_o<vo[i]){
		//	alert('es menor');
			for(j=c;j>=i;j--){
				vo[j]=vo[j-1];
				vo_id[j]=vo_id[j-1];
				vm[j]=vm[j-1];
			}//fin for cambia inserta uno menor
			vo[i]=new_o;
			vo_id[i]=new_o_id;
			vm[i]=new_m;
			swmenor=1;
			i=c+1;
		}//fin ver si es menor

	}
	if((swmenor!=1 )&& (swigual!=1)){// si eso nunca se cumpli el vo es mayor por lo tanto se insertara al final
		vo[c]=new_o;
		vo_id[c]=new_o_id;
		vm[c]=new_m;
	}
	for(i=0;i<vo.length;i++){
		if(i==0){
			sm=vm[i];
			so=vo[i];
			so_id=vo_id[i];
		}
		else{
			sm+=', '+vm[i];
			so+=', '+vo[i];
			so_id+=', '+vo_id[i];
		}
	}

	return s=sm+'---'+so+'---'+so_id;
}

function carga_data_vehiculo(id_vehiculo,vehiculo_tipo,vehiculo_capacidad,vehiculo_mensaje,seccion_ruta){
	/*	PARAMETROS DE LA FUNCION
		id_vehiculo			indica el id del vehiculo proporcionado en el pooldawn
		vehiculo_tipo		es el id del campo oculto donde se cargara el tipo de vehiculo
		vehiculo_capacidad	es el id del campo oculto donde se cargara la capacidad del vehiculo no sera usado por el momento
		vehiculo_mensaje	es el id oculto donde se cargara el mensaje de la capacidad del vehiculo

	*/

	id=$("#"+id_vehiculo).val();

	if(id!=0){

	//	alert('asin_data_vehiculo.php?id_vehiculo='+id_vehiculo+'&vehiculo_tipo='+vehiculo_tipo+'&vehiculo_capacidad='+vehiculo_capacidad+'&vehiculo_mensaje='+vehiculo_mensaje+'&seccion_ruta='+seccion_ruta+'&id='+id);
		//$("#"+vehiculo_mensaje).load('asin_data_vehiculo.php?id_vehiculo='+id_vehiculo+'&vehiculo_tipo='+vehiculo_tipo+'&vehiculo_capacidad='+vehiculo_capacidad+'&vehiculo_mensaje='+vehiculo_mensaje+'&placa='+placa+'&seccion_ruta='+seccion_ruta);
		$("#"+vehiculo_mensaje).load('asin_data_vehiculo.php?id_vehiculo='+id_vehiculo+'&vehiculo_tipo='+vehiculo_tipo+'&vehiculo_capacidad='+vehiculo_capacidad+'&vehiculo_mensaje='+vehiculo_mensaje+'&seccion_ruta='+seccion_ruta+'&id='+id);
	//alert('ya llamo');
	}else{
		$("#"+vehiculo_mensaje).html('');
		$("#"+vehiculo_tipo).val('');
		$("#"+vehiculo_capacidad).val();
		$("#"+seccion_ruta).addClass('not_display');

	}



}

function calcula_tabulador(ruta,vehiculo_tipo,empresa_transportista,valor_viaje,valor_escolta,valor_adelanto,valor_caleta,carga_monto,valor_amarre){
	/*	PARAMETROS DE LA FUNCION
		ruta 					contiene las escalas del comprobante de salida
		vehiculo_tipo 			contiene el tipo de vehiculo
		empresa_transportista 	empresa de transporte con lo cual se podra saber si tiene o no descuento
		valor_viaje				aqui se colocara el valor del viaje segun el destino salido del tabulador de costos
		valor_escolta			aqui se colocara el valor del viaje segun el destino salido del tabulador de costos en la opcion de escolta
		valor_adelanto			Segun la empresa esta aportara el n% por valor del viaje y a la empresa
		valor_caleta			valor segun el tipo de vehiculo
		carga_monto				donde se hara el load
	*/
	ruta=$("#"+ruta).val();
	ruta=ruta.split(', ');
	c_ruta=ruta.length;//cantidad de longitud del array ruta
	destino=ruta[c_ruta-1];// aqui se obtine el destino final del control(flete)
	vehiculo=$("#vehiculo").val();//optengo el  tipo de vehiculo
	empresa_transportista=$("#"+empresa_transportista).val();//obtengo el valor de la empreasa

	$("#"+carga_monto).load('asin_calcula_tabulador.php?destino='+destino+'&valor_escolta='+valor_escolta+'&valor_adelanto='+valor_adelanto+'&valor_caleta='+valor_caleta+'&empresa_transportista='+empresa_transportista+'&valor_viaje='+valor_viaje+'&vehiculo='+vehiculo+'&valor_amarre='+valor_amarre);

}

function limpia_calcula_tabulador(valor_viaje,valor_escolta,valor_adelanto,valor_caleta){
	/*	PARAMETROS DE LA FUNCION
		valor_viaje				aqui se colocara el valor del viaje segun el destino salido del tabulador de costos
		valor_escolta			aqui se colocara el valor del viaje segun el destino salido del tabulador de costos en la opcion de escolta
		valor_adelanto			Segun la empresa esta aportara el n% por valor del viaje y a la empresa
		valor_caleta			valor segun el tipo de vehiculo
	*/
	$("#"+valor_viaje).val('');
	$("#"+valor_escolta).val('');
	$("#"+valor_adelanto).val('');
	$("#"+valor_caleta).val('');
/* deveria ser mas por este via
	vv=$("#valor_viaje").val(); 		ve=$("#valor_escolta").val();
	vdc=$("#valor_desvio").val();		vdl=$("#valor_desvio_l").val();
	vrc=$("#reparto_monto").val();		vrl=$("#repartol_monto").val();
	vc=$("#valor_caleta").val();		vce=$("#valor_caleta_especial").val();
	va=$("#valor_adelanto").val(); 		vd=$("#valor_devolucion").val();
	vam=$("#valor_amarre").val();
	$("#valor_sin_escolta").val(vtse);					$("#valor_con_escolta").val(vtce);
*/
}

function carga_desvio(valor,id_carga,id_valor_desvio){
	/*	PARAMETROS DE LA FUNCION
		valor				lo q se va a colocar en la caja de desvio la zona de desvio
		id_carga			el campo de carga
		id_valor_desvio		costo del desvio
	*/

	valor=$("#"+valor).val();
	if(valor!=0){
		campo=valor.split(',,');//se divide el campo de zona
		valor_destino=$("#id_ruta").val();	
		if(valor_destino!=campo[0]){
			valor_base=$("#"+id_carga).val();
			valor_base_id=$("#id_"+id_carga).val();
					
			if(valor_base!=0){
				ValRep=BuscarRepetido(valor_base_id,campo[0],',');
				if(ValRep==0){//se verifica que no este repetido
					$("#"+id_carga).val($("#"+id_carga).val()+', '+campo[1]);
					$("#id_"+id_carga).val($("#id_"+id_carga).val()+','+campo[0]);
				}		
			}else {
				$("#"+id_carga).val(campo[1]);
				$("#id_"+id_carga).val(campo[0]);	
			}
	
		}
		
		
		
	}else{
		$("#"+id_carga).val('');
		$("#id_"+id_carga).val('');
	}
	//proceso para calcular precios	
	desvio_ids=$("#id_"+id_carga).val();
	vehiculo=$("#vehiculo").val();

	$("#load_desvio").load('asin_calcula_desvio.php?desvio_ids='+desvio_ids+'&vehiculo='+vehiculo+'&destino='+valor_destino);
	//calculadora final	
	calcular_totales();
}

function BuscarRepetido(cadena,valor,separador){
	retorno=0;
	
	VBusqueda=cadena.split(separador);
	
	for(i=0;i<VBusqueda.length;i++){
	if(VBusqueda[i]==valor) retorno=1;

	}
		
	return retorno;
}

function carga_reparto(valor,id_carga,id_repar_cantidad){

	/*	PARAMETROS DE LA FUNCION
		valor				lo q se va usar para calcular el monto de reparto
		id_carga			el campo de carga
		id_repar_cantidad		campo donde se lee el valor para calculo

	*/
	cantidad=$("#"+id_repar_cantidad).val();
	$("#"+id_carga).val(valor*cantidad);
	vvr=$("#"+id_carga).val();
	valor_viaje=$("#valor_viaje").val();
	

	//calcular el los totales
	calcular_totales();
	
}

function calcular_totales(){
	
	vv=$("#valor_viaje").val(); 		ve=$("#valor_escolta").val();
	vdl=$("#valor_desvio").val();		vdc=$("#valor_desvio_c").val();
	vrc=$("#reparto_monto").val();		vrl=$("#repartol_monto").val();
	vc=$("#valor_caleta").val();		vce=$("#valor_caleta_especial").val();
	va=$("#valor_adelanto").val(); 		vd=$("#valor_devolucion").val();
	vam=$("#valor_amarre").val();
				
	vtse=parseFloat(vv) + parseFloat(vdc) + parseFloat(vdl) + parseFloat(vrc) + parseFloat(vrl) + parseFloat(vc) + parseFloat(vce) + parseFloat(vd);
	vtce=parseFloat(vtse) + parseFloat(ve);
	$("#valor_sin_escolta").val(vtse);					$("#valor_con_escolta").val(vtce);
}



function cargar_factura(fac_num,carga_factura,fac_con,cf,fac_img,fac_mon,fac_cli){

	/*	PARAMETROS DE LA FUNCION ESTA ES LA CARGA DE LOS PRODUCTOS
		fac_num			id del campo del numero de factura
		carga_factura	aqui es donde se va a cargar el load de las facturas
		fac_con			el cmapo que identifica la fila
		cf				campo que lleva la cuenta de las filas
		fac_img			id donde se carga la imagen de eliminar o add
		fac_mon			campo donde se carga el monto
		fac_cli			campo donde se cargara el cliente
	*/


	vcf=$("#"+cf).val();//obtengo la cantida de facturas ingresadas hasta el momento
	idc=$("#"+fac_con).val();
	//alert('vfc '+vcf+' idc '+idc+' cf '+cf);
	num_fac_ing=$("#"+fac_num+idc).val();

	//////////////////////////////////////////////////////////////////////////////
	/*for(i=0;i<cf;i++){
		nf=$("#"+id_num_fac+i).val();
		if(num_fac_ing==nf){
			$("#"+id_num_fac+cf).val()='';
			i=cf;
		}
	}*/
	//////////////////////////////////////////////////////////////////////////////
	//alert('alerta 1');
	parametros=num_fac_ing;//numero ingresado de la factura
	parametros+=','+fac_num;//id del campo de la factura
	parametros+=','+carga_factura;//id donde se cargaran los asincronos en load
	parametros+=','+fac_con;//id del camp q tiene la posicion de la factura
	parametros+=','+cf;//id del campo contador de las facturas
	parametros+=','+fac_img;//id donde se cargara la imagen
	parametros+=','+fac_mon;//id del campo donde se carga el monto
	parametros+=','+fac_cli;//id del campo donde se carga el cliente
                //  alert(parametros);
	$("#"+carga_factura).load('asin_fac_trans.php?parametros='+parametros);




}

function cargar_traslado(fac_num,carga_factura,fac_con,cf,fac_img,fac_mon,fac_cli){

	/*	PARAMETROS DE LA FUNCION ESTA ES LA CARGA DE LOS PRODUCTOS
		fac_num			id del campo del numero de factura
		carga_factura	aqui es donde se va a cargar el load de las facturas
		fac_con			el cmapo que identifica la fila
		cf				campo que lleva la cuenta de las filas
		fac_img			id donde se carga la imagen de eliminar o add
		fac_mon			campo donde se carga el monto
		fac_cli			campo donde se cargara el cliente
	*/

	vcf=$("#"+cf).val();//obtengo la cantida de facturas ingresadas hasta el momento
	idc=$("#"+fac_con).val();
	//alert('vfc '+vcf+' idc '+idc+' cf '+cf);
	num_fac_ing=$("#"+fac_num+idc).val();
	//////////////////////////////////////////////////////////////////////////////
	/*for(i=0;i<cf;i++){
		nf=$("#"+id_num_fac+i).val();
		if(num_fac_ing==nf){
			$("#"+id_num_fac+cf).val()='';
			i=cf;
		}
	}*/
	//////////////////////////////////////////////////////////////////////////////
	parametros=num_fac_ing;//numero ingresado de la factura
	parametros+=','+fac_num;//id del campo de la factura
	parametros+=','+carga_factura;//id donde se cargaran los asincronos en load
	parametros+=','+fac_con;//id del camp q tiene la posicion de la factura
	parametros+=','+cf;//id del campo contador de las facturas
	parametros+=','+fac_img;//id donde se cargara la imagen
	parametros+=','+fac_mon;//id del campo donde se carga el monto
	parametros+=','+fac_cli;//id del campo donde se carga el cliente
	$("#"+carga_factura).load('asin_tras_trans.php?parametros='+parametros);


}

function avilita_add_factura(parametros){
	/*PARAMETROS DE LA FUNCION
		parametros 	contiene una serie de parametros traidos desde la primera llamada en el onchange de fac_num_
					se describen a continuacion

		parametros[0]num_fac_ing;//numero ingresado de la factura
		parametros[1]','+fac_num;//id del campo de la factura
		parametros[2]','+carga_factura;//id donde se cargaran los asincronos en load
		parametros[3]','+fac_con;//id del camp q tiene la posicion de la factura
		parametros[4]','+cf;//id del campo contador de las facturas
		parametros[5]','+fac_img;//id donde se cargara la imagen
		parametros[6]','+fac_mon;//id del campo donde se carga el monto
		parametros[7]','+fac_cli;//id del campo donde se carga el cliente
	*/
	p_r=parametros.split(',');

	//alert(p_r[3]);
	cfa=$("#"+p_r[3]).val();
	cf=$("#"+p_r[3]).val();
	cf++;// incrementamos el indice de las flas
	cfpre=cfa-1;
	//


	$("#"+p_r[5]+cfa).html('<img src="../images/pluss.png" alt="Adicionar Factura" Title="Adicionar Factura" style="cursor:pointer"  onclick="add_fila(parametros)" />');
	$("#fac_sta_"+cfa).val(1);
	mat=$("#monto_facturas").val();
	mon_fac=$("#"+p_r[6]+cfa).val();
	mat=parseFloat(mat) + parseFloat(mon_fac);
	$("#monto_facturas").val(mat);





}

function avilita_add_factura_tras(parametros){
	/*PARAMETROS DE LA FUNCION
		parametros 	contiene una serie de parametros traidos desde la primera llamada en el onchange de fac_num_
					se describen a continuacion

		parametros[0]num_fac_ing;//numero ingresado de la factura
		parametros[1]','+fac_num;//id del campo de la factura
		parametros[2]','+carga_factura;//id donde se cargaran los asincronos en load
		parametros[3]','+fac_con;//id del camp q tiene la posicion de la factura
		parametros[4]','+cf;//id del campo contador de las facturas
		parametros[5]','+fac_img;//id donde se cargara la imagen
		parametros[6]','+fac_mon;//id del campo donde se carga el monto
		parametros[7]','+fac_cli;//id del campo donde se carga el cliente
	*/
	p_r=parametros.split(',');

	//alert(p_r[3]);
	cfa=$("#"+p_r[3]).val();
	cf=$("#"+p_r[3]).val();
	cf++;// incrementamos el indice de las flas
	cfpre=cfa-1;
	//


	$("#"+p_r[5]+cfa).html('<img src="../images/pluss.png" alt="Adicionar Factura" Title="Adicionar Factura" style="cursor:pointer"  onclick="add_fila_traslado(parametros)" />');
	$("#fac_sta_"+cfa).val(1);
	mat=$("#monto_facturas").val();
	mon_fac=$("#"+p_r[6]+cfa).val();

}

function avilita_add_factura_nota(parametros){

	/*PARAMETROS DE LA FUNCION
		parametros 	contiene una serie de parametros traidos desde la primera llamada en el onchange de fac_num_
					se describen a continuacion

		parametros[0]num_fac_ing;//numero ingresado de la factura
		parametros[1]','+fac_num;//id del campo de la factura
		parametros[2]','+carga_factura;//id donde se cargaran los asincronos en load
		parametros[3]','+fac_con;//id del camp q tiene la posicion de la factura
		parametros[4]','+cf;//id del campo contador de las facturas
		parametros[5]','+fac_img;//id donde se cargara la imagen
		parametros[6]','+fac_mon;//id del campo donde se carga el monto
		parametros[7]','+fac_cli;//id del campo donde se carga el cliente
	*/
	p_r=parametros.split(',');

	//alert(p_r[3]);
	cfa=$("#"+p_r[1]).val();
	cf=$("#"+p_r[1]).val();
	//cf++;// incrementamos el indice de las flas
	cfpre=cfa-1;
	//
	parametros=parametros+','+cf;
//	alert(p_r[3]);

	$("#"+p_r[3]+cfa).html('<img src="../images/pluss.png" alt="Adicionar Factura" Title="Adicionar Factura" style="cursor:pointer"  onclick="add_fila_nota(parametros)" />');


}



function add_fila(parametros){
	/*PARAMETROS DE LA FUNCION
		parametros 	contiene una serie de parametros traidos desde la primera llamada en el onchange de fac_num_
					se describen a continuacion

		parametros[0]num_fac_ing;//numero ingresado de la factura
		parametros[1]','+fac_num;//id del campo de la factura
		parametros[2]','+carga_factura;//id donde se cargaran los asincronos en load
		parametros[3]','+fac_con;//id del camp q tiene la posicion de la factura
		parametros[4]','+cf;//id del campo contador de las facturas
		parametros[5]','+fac_img;//id donde se cargara la imagen
		parametros[6]','+fac_mon;//id del campo donde se carga el monto
		parametros[7]','+fac_cli;//id del campo donde se carga el cliente
	*/
	//	cf	el indice me indica enq  fina voy por lo tanto paso el valor a cf el contador de filas

	p_r=parametros.split(',');
	//alert(p_r.length);
	//alert(' parametros '+p_r[8]);
	fa=$("#"+p_r[4]).val(); // fila anterior
	cf=$("#"+p_r[4]).val();//fila nueva
	cf++;

	//campos o ids no enviados por los parametros
	tabla_carga='tabla_facturas';//tabla donde se cargan las facturas
	tr_carga='factura_'+cf;//tr en el q se carga la nueva linea de factura
	fac_sta='fac_sta_'+cf;//indica si la factura esta eliminada o no
	fac_con=p_r[3].replace(fa,cf);//indica el contador de las facturasde esta nueva fila

	fac_cli=p_r[7]+cf;//donde se cargara el clliente de la factura
	fac_num=p_r[1]+cf;//campo de la factura
	fac_mon=p_r[6]+cf;//campo del monto de la factura
	fac_img=p_r[5]+cf;//campo de la imagen
	//campos o ids no enviados por los parametros


	$("#"+tabla_carga).append('<tr id="'+tr_carga+'"></tr>');
	campos_ocultos='<input type="hidden" id="'+fac_sta+'" name="'+fac_sta+'"  />';
	campos_ocultos+='<input type="hidden" id="'+fac_con+'" name="'+fac_con+'" value="'+cf+'"  />';
	campos_ocultos+='<input type="hidden" id="cf" name="cf" value="'+cf+'"  />';
	//$("#"+tr_carga).append(campos_ocultos);//aqui se estan agregando los campos ocultos q sirven de controladores de las facturas

	//creo valores para los campos porq lafuncion pasada de esta manera crea confucion si no lo hago
	fac_num_='fac_num_';	id_c_f='id_carga_factura';	fac_con_='fac_con_'+cf;
	id_cf='cf';				fac_img_='fac_img_';					fac_mon_='fac_mon_';		fac_cli_='fac_cli_';

	//parte interna del tr lo q realmente se ve
	td_factura='<td align="center">';
	td_factura+=campos_ocultos;
	td_factura+='<input name="'+fac_cli+'"  id="'+fac_cli+'" type="text" class="form_caja_proceso_cliente" value="" readonly="readonly"/>';
	td_factura+='<td align="center"><input name="'+fac_num+'"  id="'+fac_num+'" type="text" class="form_caja_proceso_numero" value="" ';
	td_factura+=' onchange="cargar_factura(fac_num_,id_c_f,fac_con_,id_cf,fac_img_,fac_mon_,fac_cli_)" onKeyPress="return acceptNum(event)" /></td>';
	td_factura+='<td align="center"><input name="'+fac_mon+'"  id="'+fac_mon+'" type="text" class="form_caja_proceso_numero" value=""  readonly="readonly"/></td>';
	td_factura+='<td align="center" id="'+fac_img+'"><img src="../images/pluss.png" alt="" /></td>';
	$("#"+tr_carga).append(td_factura);	    //cargo la parte interna

	$("#"+p_r[5]+fa).html('');
	$("#"+p_r[4]).val(cf);








}


function add_fila_nota(parametros){
	/*PARAMETROS DE LA FUNCION
		parametros 	contiene una serie de parametros traidos desde la primera llamada en el onchange de fac_num_
					se describen a continuacion

		parametros[0]num_fac_ing;//numero ingresado de la factura
		parametros[1]','+fac_num;//id del campo de la factura
		parametros[2]','+carga_factura;//id donde se cargaran los asincronos en load
		parametros[3]','+fac_con;//id del camp q tiene la posicion de la factura
		parametros[4]','+cf;//id del campo contador de las facturas
		parametros[5]','+fac_img;//id donde se cargara la imagen
		parametros[6]','+fac_mon;//id del campo donde se carga el monto
		parametros[7]','+fac_cli;//id del campo donde se carga el cliente
	*/
	//	cf	el indice me indica enq  fina voy por lo tanto paso el valor a cf el contador de filas

	p_r=parametros.split(',');
	//alert(p_r.length);
	//alert(' parametros '+p_r[8]);
	fa=$("#"+p_r[4]).val(); // fila anterior
	cf=$("#"+p_r[4]).val();//fila nueva
	cf++;

	//campos o ids no enviados por los parametros
	tabla_carga='tabla_facturas';//tabla donde se cargan las facturas
	tr_carga='factura_'+cf;//tr en el q se carga la nueva linea de factura
	fac_sta='fac_sta_'+cf;//indica si la factura esta eliminada o no
	//fac_con=p_r[3].replace(fa,cf);//indica el contador de las facturasde esta nueva fila

	fac_cli='fac_cli_'+cf;//donde se cargara el clliente de la factura
	fac_num=p_r[1]+cf;//campo de la factura
	fac_mon=p_r[6]+cf;//campo del monto de la factura
	fac_img=p_r[3]+cf;//campo de la imagen
	//campos o ids no enviados por los parametros


	$("#"+tabla_carga).append('<tr id="'+tr_carga+'"></tr>');
	campos_ocultos='<input type="hidden" id="'+fac_sta+'" name="'+fac_sta+'"  />';
	campos_ocultos+='<input type="hidden" id="'+fac_con+'" name="'+fac_con+'" value="'+cf+'"  />';
	campos_ocultos+='<input type="hidden" id="cf" name="cf" value="'+cf+'"  />';
	//$("#"+tr_carga).append(campos_ocultos);//aqui se estan agregando los campos ocultos q sirven de controladores de las facturas

	//creo valores para los campos porq lafuncion pasada de esta manera crea confucion si no lo hago
	fac_num_='fac_num_';	id_c_f='id_carga_factura';	fac_con_='fac_con_'+cf;
	id_cf='cf';				fac_img_='fac_img_';					fac_mon_='fac_mon_';		fac_cli_='fac_cli_';

	//parte interna del tr lo q realmente se ve
	td_factura='<td align="center">';
	td_factura+=campos_ocultos;
	td_factura+='<input name="'+fac_cli+'"  id="'+fac_cli+'" type="text" class="form_caja_proceso_cliente" value=""  onchange="add_fila_nota(fac_num_,id_c_f,fac_con_,id_cf,fac_img_,fac_mon_,fac_cli_)" />';
	td_factura+='<td align="center"></td>';
	td_factura+='<td align="center" id="'+fac_img+'"><img src="../images/pluss.png" alt="" /></td>';
	$("#"+tr_carga).append(td_factura);	    //cargo la parte interna

	$("#"+p_r[5]+fa).html('');
	$("#"+p_r[4]).val(cf);








}
///funcion aplica un css especifico con la clace css()

//FUNCIONES DE EL TRASLADO ADICION DE FILA
function add_fila_traslado(parametros){
	/*PARAMETROS DE LA FUNCION
		parametros 	contiene una serie de parametros traidos desde la primera llamada en el onchange de fac_num_
					se describen a continuacion

		parametros[0]num_fac_ing;//numero ingresado de la factura
		parametros[1]','+fac_num;//id del campo de la factura
		parametros[2]','+carga_factura;//id donde se cargaran los asincronos en load
		parametros[3]','+fac_con;//id del camp q tiene la posicion de la factura
		parametros[4]','+cf;//id del campo contador de las facturas
		parametros[5]','+fac_img;//id donde se cargara la imagen
		parametros[6]','+fac_mon;//id del campo donde se carga el monto
		parametros[7]','+fac_cli;//id del campo donde se carga el cliente
	*/
	//	cf	el indice me indica enq  fina voy por lo tanto paso el valor a cf el contador de filas

	p_r=parametros.split(',');
	//alert(p_r.length);
	//alert(' parametros '+p_r[8]);
	fa=$("#"+p_r[4]).val(); // fila anterior
	cf=$("#"+p_r[4]).val();//fila nueva
	cf++;

	//campos o ids no enviados por los parametros
	tabla_carga='tabla_facturas';//tabla donde se cargan las facturas
	tr_carga='factura_'+cf;//tr en el q se carga la nueva linea de factura
	fac_sta='fac_sta_'+cf;//indica si la factura esta eliminada o no
	fac_con=p_r[3].replace(fa,cf);//indica el contador de las facturasde esta nueva fila

	fac_cli=p_r[7]+cf;//donde se cargara el clliente de la factura
	fac_num=p_r[1]+cf;//campo de la factura
	fac_mon=p_r[6]+cf;//campo del monto de la factura
	fac_img=p_r[5]+cf;//campo de la imagen
	//campos o ids no enviados por los parametros


	$("#"+tabla_carga).append('<tr id="'+tr_carga+'"></tr>');
	campos_ocultos='<input type="hidden" id="'+fac_sta+'" name="'+fac_sta+'"  />';
	campos_ocultos+='<input type="hidden" id="'+fac_con+'" name="'+fac_con+'" value="'+cf+'"  />';
	campos_ocultos+='<input type="hidden" id="cf" name="cf" value="'+cf+'"  />';
	//$("#"+tr_carga).append(campos_ocultos);//aqui se estan agregando los campos ocultos q sirven de controladores de las facturas

	//creo valores para los campos porq lafuncion pasada de esta manera crea confucion si no lo hago
	fac_num_='fac_num_';	id_c_f='id_carga_factura';	fac_con_='fac_con_'+cf;
	id_cf='cf';				fac_img_='fac_img_';					fac_mon_='fac_mon_';		fac_cli_='fac_cli_';

	//parte interna del tr lo q realmente se ve
	td_factura='<td align="center">';
	td_factura+=campos_ocultos;
	td_factura+='<input name="'+fac_cli+'"  id="'+fac_cli+'" type="text" class="form_caja_proceso_cliente" value="" readonly="readonly"/>';
	td_factura+='<td align="center"><input name="'+fac_num+'"  id="'+fac_num+'" type="text" class="form_caja_proceso_numero" value="" ';
	td_factura+=' onchange="cargar_traslado(fac_num_,id_c_f,fac_con_,id_cf,fac_img_,fac_mon_,fac_cli_)" onKeyPress="return acceptNum(event)" /></td>';
	td_factura+='<td align="center"><input name="'+fac_mon+'"  id="'+fac_mon+'" type="text" class="form_caja_proceso_numero" value=""  readonly="readonly"/></td>';
	td_factura+='<td align="center" id="'+fac_img+'"><img src="../images/pluss.png" alt="" /></td>';
	$("#"+tr_carga).append(td_factura);	    //cargo la parte interna

	$("#"+p_r[5]+fa).html('');
	$("#"+p_r[4]).val(cf);
}


function popup_basic(url) {

var opciones= "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, width=800, height=600, top=10, left=200";
window.open(url,"",opciones);
}


function completo(cajaEntrada,cajaData,separador,indMayor){
	/* FUNCION PARA LLENADO DE VARIAS CAJAS DE UN FORMULARIO DADO SE USA PARA USAR LA FUNCION TDE DOMPLETO DE IMPORTACION DE PROFIT UNA EMIULACION DE ESTE
		cajaEntada		caja de entrada de data
		cajaData		caja que contiene informacion adicional separada por algun separador
		separador		separador pra la caja data
		indMayor		indice mayor de el formulario

	*/

	for(i=0;i<indMayor;i++){
	//desconcatenamos la variable de cjaData
		if($("#"+cajaData+i).val()){
			rCajaData=$("#"+cajaData+i).val();
			dataDesCon=rCajaData.split('##');
			//ponemos a 6 prq el el valor completo por ser notas de entrega q posiblemente esten ya facturadas
			//alert('aqui'+dataDesCon[6]+' val '+rCajaData);
			$("#"+cajaEntrada+i).val(dataDesCon[6]);
		}
	}
}

function valIntru(maximo,minimo,caja,validador){
	/* FUNCION PAARA VALIDACION DE IMPORTES DE PEDIDOS
		maximo		permitido
		minimo		permitido
		caja 		donde se introduce el valor
		validador 	caja que colocaremos la alarma
	*/
	var valorCaja=$("#"+caja).val();

	//comprobamos
	if(valorCaja<minimo || valorCaja>maximo){
		$("#"+caja).addClass('form_error');
		$("#"+caja).val(0);
	}else{
			$("#"+caja).removeClass('form_error');
	}
}

function valIntruMan(maximo,minimo,caja,validador){
	/* FUNCION PAARA VALIDACION DE IMPORTES DE PEDIDOS MANIPULADOS
		maximo		permitido
		minimo		permitido
		caja 		donde se introduce el valor
		validador 	caja que colocaremos la alarma
	*/
	var valorCaja=$("#"+caja).val();
	var valorMaximo=$("#"+maximo).val().split('##');
	var valMax=parseInt(valorMaximo[0]);

	//comprobamos
	if(valorCaja<minimo || valorCaja>valMax){
		$("#"+caja).addClass('form_error');
		$("#"+caja).val(0);
		alert('Este valor es muy alto!');
	}else{
			$("#"+caja).removeClass('form_error');
	}
}


function loadAsincMul(strinSubmitAsin){
	/* FUNCION PAARA VALIDACION DE IMPORTES DE PEDIDOS
					nombre: asinSubmitAsin
					divisores  ## de los strines mayores
						url				direccion del archivo
						campos			campos que se pasaran de el formulario
						idCarga			idCarga de el asincrono
						campoVal		campo de validacion
						url, campos, idCarga, campoVal   --> url##campos##idCarga##campoVal

					segundo divisor @@ de los string secundarios


			*/
	strinDescom=strinSubmitAsin.split('##');
	$("#"+strinDescom[2]).load(strinDescom[0]+'?parametros='+strinDescom);
}

/////////////////////////////////FUNCIONES DE MANEJO DE LA PANTALLA//////////////////////////////////////////////
function paginadora(mov,cambios,total){
	/*
		funcion que se encarga de cambiar el indice de las guias
		mov			direccion de la paginacion a anterior s siguiente
		cambios		caja que contiene la posicion actual
		totao		de guias
	*/
	//alert('hace paginadora');
	var total=$("#"+total).val();
	var camb=$("#"+cambios).val();
	if(mov=='a') ncamb=parseInt(camb)-1;
	if(mov=='s') ncamb=parseInt(camb)+1;
	if(ncamb>=0 && ncamb<total)	$("#"+cambios).val(ncamb);
	if(total>0){

		//busca las quias a mostrar hasta ahorita
		load_page('cargaDataAsin','asinAccData.php');

	}
}

function cargarCS(idCarga,url,guias,indice){

	/*ESTA FUNCION SE ENCARGA DE DESCONCATENAR LA VARIABLE DE GUIAS PARA OCTENER CON EL INDICE LA QUIA QUE SE QUIERE VER*/
	var arrGuia=$("#"+guias).val().split('##');
	var indice=$("#"+indice).val();

	$("#"+idCarga).load(url+'?id='+arrGuia[indice]);

}

function montarMerca(idCarga,htm){
//	alert('aquoi'+idCarga+htm);
	$("#"+idCarga).html(htm);
}
/////////////////////////////////FUNCIONES DE MANEJO DE LA PANTALLA//////////////////////////////////////////////



//funcetion oara determinar el ancho de la pantalla
function ancho(error){
	//determino el ancho de la pantalla
	var ancho = screen.availWidth;

	if(ancho<=500)
		window.location.replace("movil/index.php?error="+error);
	else
		window.location.replace("modulos/index.php?error="+error);

}

//--------------------------------------------------MERVIN FUNCIONES------------------------------------------------------------
String.prototype.trim = function() {
	return this.replace(/^\s+|\s+$/g,"");
}
String.prototype.ltrim = function() {
	return this.replace(/^\s+/g,"");
}
String.prototype.rtrim = function() {
	return this.replace(/\s+$/g,"");
}

function imprimir_Comprobante_cheque(numero,sucursal,id_nomina,id_sucursal){
	var inser2=document.getElementById("capa_superior");
    inser2.className="capa_s";
    document.getElementById("capa_superior1").className="sombra12";
    inser2.style.display="block";
    document.getElementById("capa_superior1").style.display="block";
    var html="";

    html="<div id=\"cerrar_not\" align=\"center\" onmouseout=\"this.style.background='url(../images/icon_close.png)';style.cursor='none';\" onmouseover=\"this.style.background='url(../images/icon_close_o.png)'; this.style.cursor='pointer';\" title=\"Cerrar\" onclick=\"cerrar();\"></div>";
    html+='<div><table border="0">';
    html+='<tr class="tablas_listados_datos_imp"><td>Banco:</td><td><select id="id_banco" name="id_banco" class="form_pool"><option value="0">...Seleccionar...</option><option value="Banesco" >Banesco</option><option value="Mercantil">Mercantil</option><option value="Provincial">Provincial</option><option value="Venezuela">Venezuela</option><option value="100% Banco" selected>100% Banco</option></select></select></td></tr>';
	html+='<tr class="tablas_listados_datos_par"><td>Numero de Cheque:</td><td><input type="text" name="num_cheque" id="num_cheque"></td></tr>';
	html+='<tr class="tablas_listados_datos_imp"><td>Monto Orden de Pago:</td><td><input type="text" name="monto_orden" id="monto_orden" value="'+document.getElementById("pago_afiliado"+numero).value+'"></td></tr>';
	html+='<tr class="tablas_listados_datos_imp"><td>Fecha:</td><td><input type="text" name="fecha_desde" id="fecha_desde" onkeyup="mascara(this,\'/\',patron,true);" ></td></tr>';
	html+='<tr class="tablas_listados_datos_par"><td>Observaciones:</td><td><textarea id="observaciones" name="observaciones" cols="25" rows="7"></textarea></td></tr>';
	html+='<tr class="tablas_listados_datos_imp"><td colspan="2" align="center"><input type="button" name="imprimir_cheq" id="imprimir_cheq" value="Imprimir" onclick="imprimir_cheque('+numero+',\''+sucursal+'\','+id_nomina+','+id_sucursal+');"></td></tr></div>';
	inser2.innerHTML=html;

	//calendario('fecha_desde');
}

function cheque_Validado(numero,sucursal,parametros,id_nomina,id_sucursal){
	var inser2=document.getElementById("capa_superior");
    inser2.className="capa_s";
    document.getElementById("capa_superior1").className="sombra12";
    inser2.style.display="block";
    document.getElementById("capa_superior1").style.display="block";
    var campos=parametros.split('|');

    var html="";
    html="<div id=\"cerrar_not\" align=\"center\" onmouseout=\"this.style.background='url(../images/icon_close.png)';style.cursor='none';\" onmouseover=\"this.style.background='url(../images/icon_close_o.png)'; this.style.cursor='pointer';\" title=\"Cerrar\" onclick=\"cerrar();\"></div>";
    html+='<div><table border="0">';
    html+='<tr class="tablas_listados_datos_imp"><td>Banco:</td><td><input type="text" name="id_banco" id="id_banco" disabled value="'+campos[0]+'"></td></tr>';
	html+='<tr class="tablas_listados_datos_par"><td>Numero de Cheque:</td><td><input type="text" name="num_cheque" id="num_cheque" disabled value="'+campos[1]+'"></td></tr>';
	html+='<tr class="tablas_listados_datos_imp"><td>Monto Orden de Pago:</td><td><input type="text" name="monto_orden" id="monto_orden" disabled value="'+campos[2]+'"></td></tr>';
	html+='<tr class="tablas_listados_datos_imp"><td>Fecha:</td><td><input type="text" name="fecha_desde" id="fecha_desde" disabled value="'+campos[4]+'" ></td></tr>';
	html+='<tr class="tablas_listados_datos_par"><td>Observaciones:</td><td><textarea id="observaciones" name="observaciones" disabled cols="25" rows="7">'+campos[3]+'</textarea></td></tr>';
	html+='<tr class="tablas_listados_datos_imp"><td colspan="2" align="center"><input type="button" name="imprimir_cheq" id="imprimir_cheq"  value="Imprimir" onclick="imprimir_cheque('+numero+',\''+sucursal+'\','+id_nomina+','+id_sucursal+');"></td></tr></div>';
	inser2.innerHTML=html;
}

function imprimir_cheque(numero,sucursal,id_nomina,id_sucursal){
	var resp;
	var validar=/^[0-9]{1,}$/;
	var validar1=/^[0-9\,\.]{1,}$/;
	var bandera=0;
	var var_opcional='';
	var empresa='';
	if (!validar.test(document.getElementById("num_cheque").value) || document.getElementById("num_cheque").value==0){
		alert("Debe ingresar un numero valido en el campo numero de cheque.");
		return;
	}
	if (!validar1.test(document.getElementById("monto_orden").value) || document.getElementById("monto_orden").value=='0'){
		alert("Debe ingresar un numero valido en el campo Monto Cheque.");
		return;
	}
	if (document.getElementById("fecha_desde").value=="" || document.getElementById("fecha_desde").value.length<10){
		alert('Debe ingresar una fecha correcta');

		return;
	}

	if (document.getElementById("descripcion"+numero).value=='0'){
		if (document.getElementById("descripcion1")){
			if (document.getElementById("descripcion1").value=='' && document.getElementById("descripcion"+numero).selectedIndex==0){
				alert('Debe Ingresar una empresa');
				return;
			}else{
				empresa=document.getElementById("descripcion1").value+"|"+document.getElementById("descripcion1").value;
			}
		}else{
			alert('Debe seleccionar una empresa');
			return;
		}

	}else{
		empresa=document.getElementById("descripcion"+numero).value;
	}

	/*if (sucursal=="0" || sucursal==''){
		alert('Debe seleccionar una sucursal valida');
		return;
	}*/
	if (document.getElementById("id_banco").value=='0'){
		alert('Debe seleccionar un banco');
		return;
	}
	//alert(document.getElementById('fecha_realizacion').value);
	if (document.getElementById('fecha_realizacion')!=null){
				var_opcional="&fecha_realizacion="+document.getElementById('fecha_realizacion').value;
		}else{
				var_opcional="&fecha_realizacion=01/01/1900";
		}
	//alert(var_opcional);
	resp=confirm("Esta seguro que desea imprimir el cheque");
	if (resp==true){


	window.open("nomina_solicitud_fondos_pdf.php?descripcion="+empresa+"&monto_neto="+document.getElementById("monto_neto"+numero).value+"&iva="+document.getElementById("iva"+numero).value
	+"&monto_iva="+document.getElementById("monto_iva"+numero).value+"&retencion="+document.getElementById("retencion"+numero).value+"&retencion_monto="+document.getElementById("retencion_monto"+numero).value+"&pago_caja="+document.getElementById("pago_caja"+numero).value
	+"&pago_afiliado="+document.getElementById("pago_afiliado"+numero).value+"&sucursal="+sucursal+"&num_cheque="+document.getElementById("num_cheque").value+"&banco="+document.getElementById("id_banco").value+"&observaciones="+encodeURIComponent(document.getElementById("observaciones").value)
	+"&monto_final="+document.getElementById("monto_orden").value+'&id_nomina='+id_nomina+'&fecha_desde='+document.getElementById('fecha_desde').value+'&num_sucursal='+id_sucursal+var_opcional+'&anulado='+document.getElementById('anulado'+numero).value);
	var funcion=document.getElementById('imprimir'+numero).getAttribute('onclick');
	var encontrado=funcion.lastIndexOf('imprimir_Comprobante_cheque');
	if (encontrado>=0){
		document.getElementById('imprimir'+numero).setAttribute('onclick',"cheque_Validado("+numero+",'"+sucursal+"','"+document.getElementById("id_banco").value+"|"+document.getElementById("num_cheque").value+"|"+document.getElementById("monto_orden").value+"|"+document.getElementById("observaciones").value+"|"+document.getElementById("fecha_desde").value+"',"+id_nomina+");");
		document.getElementById('imprimir'+numero).innerHTML='<img alt="Ver Cheque" title="ver cheque" src="../images/papel_impreso.png" />';
                if (numero!='')
                    document.getElementById('anulado'+numero).value=0;
	}
	cerrar();
	}
}

function reiniciar(num){

	if (num==1){
		if (document.getElementById('descripcion').selectedIndex!=0)
			document.getElementById('descripcion1').value="";
	}else if (num==2){
		document.getElementById('descripcion').selectedIndex=0;
	}
}

var patron = new Array(2,2,4)
var patron2 = new Array(2,2)
var patron3 = new Array(1,8,1)



function mascara(d,sep,pat,nums,siguiente){
//function mascara(d,sep,pat,nums,form,foco){

	var longitud=0;
//	alert(tipo_busqueda);
	if(d.valant != d.value){
		val = d.value
		largo = val.length //val.length, cuenta la cantidad de caracteres de una cadena
		val = val.split(sep) //var.split(arg) separa la variable var segun el valor del argumento arg parecido a explode en php
		val2 = ''

		for(r=0;r<val.length;r++){
			val2 += val[r]
		}

		///evalua que solo sean numeros
//		alert(val.length);
		if(pat!='1,8,1'){
			if(nums){
				for(z=0;z<val2.length;z++){
					if(isNaN(val2.charAt(z))){ //isNaN(), evalua si en la cadena hay numeros, si los hay devuleve false caso contrario true
						letra = new RegExp(val2.charAt(z),"g") //RegExp(modelo,atributo),  El objeto de expresión regular describe un patrón de caracteres. modelo indica el patrón de la expresión regular, atributo: especifica los atributos globales ( "g"), mayúsculas y minúsculas ( "i"), y coincide con varias líneas ( "m")
						val2 = val2.replace(letra,"")
					}
				}
			}
		}
		///
		val = ''
		val3 = new Array()
		anio = new Array()
		for(s=0; s<pat.length; s++){
			val3[s] = val2.substring(0,pat[s]) //substring(ind1,ind2): Devuelve una subcadena del objeto string que comienza en la posición dada por el menor de los argumentos y finaliza en la posición dada por el otro argumento. Si se omite este último argumento la subcadena extraida va desde laposición indicada por el único argumento hasta el final de la cadena. Si los argumentos son literales se convierten a enteros como un parseInt().
			val2 = val2.substr(pat[s]) //substr(inicio,largo): Devuelve una subcadena extraida del objeto string comenzando por la posición dada por el primer argumento, inicio, y con un número de caracteres dado por el segundo argumento, largo. Si se omite este último argumento la subcadena extraida va desde inicio hasta el final de la cadena.
			//alert("s="+s+" y n="+pat.length);
			//if(s==pat.length-1){ anio = val2.substr(pat[s]) }
		}

		//i=1;
		for(q=0;q<val3.length; q++){
			if(q==0){
				val = val3[q]
			}
			else{
				if(val3[q] != ""){
					val += sep + val3[q];
					//i=i+1;
//					if(q==pat.length-1){ anio2 = val3.substr(pat[s]) }
				}
			}

			//alert(q+","+val3.length);
		}
		d.value = val
		d.valant = val
		if(anio.length==4){ document.form_suceso.hora_suceso.focus(); }
	}

}

function cerrar(){
        	var divv2=document.getElementById("capa_superior");
        	var divv3=document.getElementById("capa_superior1");
        	divv3.removeAttribute('class');
        	divv2.removeAttribute('class');
        	divv2.innerHTML="";
        }

function enviar_Formulario(boton,parametro){
	var validar=/^[0-9]{1,}$/
	if (!validar.test(document.getElementById(parametro).value)){
		alert("Debe ingresar un numero valido.");
		return;
	}
	document.getElementById("boton").value=boton;
	//alert(document.forms[0].elements[0].value);
	document.form1.submit();
}

function elim_Punto(campo,evento){
	var campo1=document.getElementById(campo);
	if (campo1.value.lastIndexOf(".")>=0 && evento==1) alert('No se permite el punto (.) en este campo, solamente la coma (,) para los decimales.');
	campo1.value=campo1.value.replace('.','');
}

	function limpiar1(){
		//alert(document.form1.elements.length);
		for (i=0;i<document.form1.elements.length;i++){
			if (document.form1.elements[i].type=='hidden' || document.form1.elements[i].type=='text' || document.forms[formulario].elements[i].type=="textarea")
				document.form1.elements[i].value='';
			else if (document.form1.elements[i].type=='select-one')document.form1.elements[i].selectedIndex=0;
		}
	}

//----------------------------------------------FIN MERVIN FUNCIONES------------------------------------------------------------


