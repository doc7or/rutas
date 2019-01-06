<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	
	<title>Sistema de Transporte Sistrans</title>
	<link rel="stylesheet" type="text/css" href="../css/tecladoJquery/style.css" />
</head>
<body>
	<div id="containerInputs">
		<font class="textLogin">Usuario&nbsp;&nbsp;&nbsp;:&nbsp; </font><input type="text" id="login" />
        <font class="textLogin">Password&nbsp;:&nbsp;</font><input type="password" name="pass" id="pass" />
        <input  type="button" name="botonEntrar" id="botonEntrar"  value="Entrar"  />
        
    </div>
<div id="container">
  
	
</div>

<script type="text/javascript" src="../lib/js/jquery/jquery.min.js" ></script>
<script type="text/javascript" >
	$('#login').focus(function(){	$("#container").load('teclado.html');	});
	$('#pass').focus(function(){	$("#container").load('teclado2.html');	});
//	$('#login').focus();
</script>

</body>
</html>
