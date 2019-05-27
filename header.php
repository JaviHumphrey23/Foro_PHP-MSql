<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="Foro creado a traves de PHP y MySQL." />
    <meta name="keywords" content="foro, web, php, mysql" />
    <title>Foro creado con PHP y MySQL</title>
    <link   rel="stylesheet" href="style.css" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Marvel|Roboto|Work+Sans" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" /> <!-- Etiqueta para indicar al dispositivo movil lo que tiene que hacer -->
</head>
<body>
<div id="wrapper">
    <h1>Foro</h1>
    <div id="menu">
        <div id="submenu">
        <a class="item" href="index.php">Categorías</a>  &nbsp;  &nbsp; 
        <a class="item" href="create_topic.php">Crear un tema</a>  &nbsp;  &nbsp;
        <a class="item" href="create_cat.php">Crear una categoría</a>

         
      <?php      
      session_start(); //Crea una sesión o reanuda la actual basada en un identificador de sesión pasado mediante una petición GET o POST, o pasado mediante una cookie.
      error_reporting(0); //Establece cuáles errores de PHP son notificados (0 es ninguno)
echo '<div id="userbar">';

    if($_SESSION['signed_in']) //Comprobamos is se ha iniciado una sesión
    {
        echo '<div id="sesion_ini">Hola ' . $_SESSION['user_name'] . '. ¿No eres tú? <a href="signout.php">Salir</a></div>';
    }
    else
    {
        echo '<a href="signin.php">Iniciar sesión</a> o <a href="signup.php">Crear una cuenta</a>';

    }

echo '</div>';
?>
</div>
    <div id="submenu_display_mini">
        <select  onchange="location = this.value">
            <option>Elija un apartado</option>
            <option value="index.php">Categorías</option>
            <option value="create_topic.php">Crear un tema</option>
            <option value="create_cat.php">Crear una categoría</option>
        </select>
    </div>
</div>
<br><br><br><br><br>
        <div id="content">