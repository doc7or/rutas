<?php

$dbh = mssql_connect('127.0.0.1','sa','123456');
//$dbh = mssql_connect('127.0.0.1','sa','123456');
//$dbh = mssql_connect('10.10.1.60','sa','123456');
//$dbh = mssql_connect('10.10.1.8','admbes','cybes2009');
//$conecbdt=mssql_select_db('transporte',$dbh) ;
//$conecbdb=mssql_select_db('BESMgmt',$dbh) ;
//$conecbdc=mssql_select_db('CYBERLUX',$dbh) ;

if($dbh) {
 echo "true\r\n";
 	
}
?>

