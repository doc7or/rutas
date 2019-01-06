//////funcion value radio button///
function getRadioButtonSelectedValue(ctrl)
{
    for(i=0;i<ctrl.length;i++)
        if(ctrl[i].checked) return ctrl[i].value;
}
//////funcion value radio button///



/////jqueys///////
function asociarClase(id)
{
		
  var x=$("#"+id);
  x.addClass("not_display");
}

function desasociarClase(id)
{
  var x=$("#"+id);
  x.removeClass("not_display");
}



function all_filas(num)
{
	for(i=0;i<=num;i++)
	{
		var fila='tr_curso_'+i;
		var llamar='llamar_luego_'+i;
		var participantes='participantes_'+i;
		asociarClase(fila);
		asociarClase(llamar);
		asociarClase(participantes);
	}	
	
}

function respuesta(num_fila)
{

	//all_filas(5);
	fila='tr_curso_'+num_fila;
	desasociarClase(fila);
	
	
}
function respuesta_data(num_fila)
{
	var llamar='llamar_luego_'+num_fila;
	var participantes='participantes_'+num_fila;	
	var selec = $('#respuesta_'+num_fila).val();
	
	if(selec==1)
	{	
		asociarClase(llamar);
		desasociarClase(participantes);	
	}
	if(selec==2 || selec==0)
	{	
		asociarClase(llamar);
		asociarClase(participantes);
	}
	if(selec==3){	
		asociarClase(participantes);
		desasociarClase(llamar);	
	}
	
}

function item_fila(num_fila,num_colum)
{

	all_filas(5);
	fila='fila_'+num_fila;
	desasociarClase(fila);
	
	for(i=0;i<=3;i++)
	{
		tabla='tabla_'+num_fila+'_'+i;
			asociarClase(tabla);	

	}
	colum='tabla_'+num_fila+'_'+num_colum;
	desasociarClase(colum);	
}

