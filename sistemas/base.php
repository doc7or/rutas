<?php 
include("lib/core.lib.php");
$error=$_REQUEST['error'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/cyberlux.css" rel="stylesheet" type="text/css" />
<title><?=SYSTEM_NAME?></title>
<script type="text/javascript" src="lib/js/jquery/jquery-1.2.1.js"></script>
<script type="text/javascript" src="lib/js/funciones.js"></script>
<script language="javascript">
	function validar()
	{
		var login = $("#losgin").val();
		if(login=='')
		{
			document.form1.login.focus();
			return false;
		}
	}
</script>
</head>

<body id="todo">
    <div id="contenedor" >
		  <div id="header" ></div>
          <div id="menu" ></div>
		  <div id="contenido" > 
          	<div id="menu_visual" ></div>
            <div id="espacio_trabajo" ></div>
		  </div>
		  <div id="footer" ></div>
	</div>
</body>
</html>
