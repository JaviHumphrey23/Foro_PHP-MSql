<?php
//signin.php
include 'connect.php';
include 'header.php';
 
echo '<h3>Iniciar sesión</h3>';
 
$_SESSION['signed_in'] = false;
echo '<h4>Has cerrado sesión. <a href="index.php">Volver al inicio</a> </h4>';

 
include 'footer.php';
?>