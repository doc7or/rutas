?php

$dbh = mssql_connect('192.168.0.11','sa','123456');
//$dbh = mssql_connect('sistemas03','','');
//$dbh = mssql_connect('127.0.0.1','','');
$conecbdt=mssql_select_db('transporte',$dbh) ;
$conecbdc=mssql_select_db('CYBERLUX',$dbh) ;

if($conecbdt) {
 echo "true\r\n";
 	if($conecbdc){ echo "cyber true\r\n"; } else { echo "no cyber\r\n";  }
} else {
	echo "fubar\r\n";
}
?>

