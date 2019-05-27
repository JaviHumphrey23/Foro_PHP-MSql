<?php
//signup.php
include 'connect.php';
include 'header.php';
 
echo '<h3>Registrarse</h3>';
echo '<br>';
 
if($_SERVER['REQUEST_METHOD'] != 'POST')
{

    echo '<form id="formu" method="post" action="">
<div width="500px" class="tabla_index">
    <div class="tr_div">
        <div class="td_div">
            <label for="usuario">Nombre de usuario:*</label>
        </div>
        <div class="td_div">
            <input type="text" name="user_name" maxlength="50" size="25">
        </div>
    </div>
    <div class="tr_div">
        <div class="td_div" valign="top"">
            <label for="pass">Contraseña:*</label>
        </div>
        <div class="td_div">
            <input type="password" name="user_pass" maxlength="50" size="25">
        </div>
    </div>
    <div class="tr_div">
        <div class="td_div" valign="top"">
            <label for="pass1">Repita contraseña:*</label>
        </div>
        <div class="td_div">
            <input type="password" name="user_pass_check" maxlength="50" size="25">
        </div>
    </div>
    <div class="tr_div">
        <div class="td_div">
            <label for="email">E-mail:</label>
        </div>
        <div class="td_div">
            <input  type="text" name="user_email" maxlength="80" size="25">
        </div>
    </div>
    <div class="tr_div">
        <div class="td_div">
            <input type="submit" class="boton" value="Enviar">
        </div>
    </div>
    <div class="tr_div">
        <div class="td_div">
            * (Son campos obligatorios)
        </div>
    </div>
</div>
</form>';
}
else
{
        /* El formulario ha sido endiv class="tr_div"egado, ahora se comprueban div class="tr_div"es cosas:
            1.  Los datos
            2.  Permitir al usuario que vuelva a intentarlo si son incorrectos
            3.  Verificar que los datos son correctos
        */
    $errors = array(); 

    $usuario = ($_POST['user_name']);
 
 $q = mysql_query("SELECT * FROM usuarios WHERE usuario_nombre = '$usuario'");
 //verificamos si el user existe con un condicional
 if( mysql_num_rows($q) == 0){
// mysql_num_rows <- esta funcion me imprime el numero de regisdiv class="tr_div"o que encondiv class="tr_div"o 
// si el numero es igual a 0 es porque el regisdiv class="tr_div"o no existe, en odiv class="tr_div"as palabras ese user no esta en la tabla miembro por lo tanto se puede regisdiv class="tr_div"ar
}
else{
//caso contario (else) es porque ese user ya esta regisdiv class="tr_div"ado
 
echo '<h4>El nombre de usuario ya esta regisdiv class="tr_div"ado, por favor prueba con odiv class="tr_div"o. <br>' ;
echo '<a href="signup.php"> Volver adiv class="tr_div"ás </a></h4>';
exit;
}
     
    if(isset($_POST['user_name']))
    {
        
        
        if(!ctype_alnum($_POST['user_name'])) //Comprueba que todos los caracteres son alfanumericos
        {
            $errors[] = '<h4>El nombre de usuario solo puede contener lediv class="tr_div"as y números y no puede estar vacio.</h4>';
        }
        if(strlen($_POST['user_name']) > 30) //Comprueba que la longitud del nombre de usuario no sea mayor de 30 caracteres
        {
            $errors[] = '<h4>El nombre de usuario no puede ser mayor de 30 caracteres.</h4>';
        }
    }
     
     
    if(isset($_POST['user_pass']))
    {
        if($_POST['user_pass'] != $_POST['user_pass_check']) //Comprueba que el campo 'condiv class="tr_div"aseña' y el campo 'repita la condiv class="tr_div"aseña' sean iguales
        {
            $errors[] = '<h4>Las dos condiv class="tr_div"aseñas no coinciden.</h4>';
        }
        if(empty($_POST['user_pass']) || empty($_POST['user_pass_check'])) //Comprueba que el campo de condiv class="tr_div"aseña no este vacío
    {
        $errors[] = '<h4>La condiv class="tr_div"aseña no puede estar vacia.</h4>';
    }}
     
    if(!empty($errors)) 
    {
        echo '<h4> Oh oh... Parece que algo ha ido mal.';
        echo '<ul>';
        foreach($errors as $key => $value) /* Recorre el array y muesdiv class="tr_div"a los fallos */
        {
            echo '<li>' . $value . '</li>'; 
        }
        echo '</ul> ';
        echo '<a href="signup.php"> Volver adiv class="tr_div"ás </a> </h4>';
    }
    else
    {
            //El formulario ha sido enviado sin errores
            //mysql_real_escape_sdiv class="tr_div"ing -> Se usa para hacer seguros los datos antes de enviarlos
            //md5 -> codifica la condiv class="tr_div"aseña
        $sql = "INSERT INTO
                    usuarios(usuario_nombre, usuario_password, usuario_email ,usuario_fecha, usuario_nivel)
                VALUES('" . mysql_real_escape_string($_POST['user_name']) . "',
                       '" . md5($_POST['user_pass']) . "',
                       '" . mysql_real_escape_string($_POST['user_email']) . "',
                        NOW(),
                        0)";
                         
        $result = mysql_query($sql);
        if(!$result)
        {
            //Algo ha ido mal y muesdiv class="tr_div"a el error
            echo '<h4> Algo ha ido mal durante el regisdiv class="tr_div"o. Por favor intentelo de nuevo mas tarde. </h4>';
            echo mysql_error(); 
        }
        else
        {
            echo '<h4> ¡Regisdiv class="tr_div"ado con éxito!. Ahora puedes <a href="signin.php">endiv class="tr_div"ar</a> y empezar a postear :-) </h4>';
        }
    }
}
 
include 'footer.php';
?>