<?php
//connect.php
$server = 'localhost';
$username   = 'root';
$password   = '080223';
$database   = 'foro';
 
if(!mysql_connect($server, $username,  $password))
{
    exit('Error: no se ha podido conectar con la base de datos.');
}
if(!mysql_select_db($database))
{
    exit('Error: no se ha podido seleccionar la base de datos.');
}
?>

