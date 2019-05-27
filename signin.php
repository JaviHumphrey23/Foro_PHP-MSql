<?php
//signin.php
include 'connect.php';
include 'header.php';
 
echo '<h3>Iniciar sesión</h3>';
 
//Primero comprobamos si el usuario ha iniciado sesión.
if(isset($_SESSION['signed_in']) && $_SESSION['signed_in'] == true)
{
    echo '<h4>Ya has iniciado sesión, puedes <a href="signout.php">cerrar sesión</a> si quieres. </h4>';
}
else
{
    if($_SERVER['REQUEST_METHOD'] != 'POST')
    {
        // Si no ha iniciado sesión, se muestra el formulario para que la inicie.
        echo '<br>
            <form method="post" action="">
                <div class="tabla_index">
                    <div class="tr_div">
                        <div class="td_div">
                            Nombre de usuario:
                            <div class="td_div"> 
                                <input type="text" name="user_name" />
                            </div>
                        </div>
                    </div>
                    <div class="tr_div">
                        <div class="td_div">
                            Contraseña:
                            <div class="td_div"> 
                                <input type="password" name="user_pass">
                            </div
                        </div>
                    </div>
                    <div class="tr_div>
                        <div class="td_div>

                            <div class="td_div">
                                <input class="boton" type="submit" value="Entrar" />
                            </div>    
                        </div>
                    </div>
                </div>
         </form>';
    }
    else
    {
        /* El formulario ha sido entregado, ahora se comprueban tres cosas:
            1.  Los datos
            2.  Permitir al usuario que vuelva a intentarlo si son incorrectos
            3.  Verificar que los datos son correctos
        */
        $errors = array(); /* Declaramos un array para usarlo despues */
         
        if(empty($_POST['user_name']))
        {
            $errors[] = ' <h4> El campo "nombre de usuario" no puede estar vacío. </h4>';

        }
         
        if(empty($_POST['user_pass']))
        {
            $errors[] = '<h4> El campo "contraseña" no puede estar vacío.</h4>';

        }
         
        if(!empty($errors)) /*Comprobamos si el array de errors está vacio, si no lo está mostramos los errores*/
        {
            echo '<h4> Oh oh... Parece que algo ha ido mal.';
            echo '<ul>';
            foreach($errors as $key => $value) /* Recorremos el array para mostrar los errores */
            {
                echo '<li>' . $value . '</li>'; 
                
            }
            echo '</ul>';
            echo '<a href="signin.php"> Volver atrás </a> </h4>';
        }
        else
        {
            //El formulario ha sido enviado sin errores
            //mysql_real_escape_string -> Se usa para hacer seguros los datos antes de enviarlos
            //md5 -> codifica la contraseña
            $sql = "SELECT 
                        usuario_id,
                        usuario_nombre,
                        usuario_nivel
                    FROM
                        usuarios
                    WHERE
                        usuario_nombre = '" . mysql_real_escape_string($_POST['user_name']) . "' 
                    AND
                        usuario_password = '" . md5($_POST['user_pass']) . "'";
                         
            $result = mysql_query($sql);
            if(!$result)
            {
                //Si algo ha ido mal, mostramos el error.
                echo '<h4> Algo ha ido mal durante el inicio de sesión. Por favor intentelo de nuevo mas tarde.</h4>';
                //echo mysql_error(); //Muestra el error de mysql
            }
            else
            {
                //La consulta se ha realizado con éxito, hay dos opciones:
                //1. La consulta devuelve datos, iniciamos sesión
                //2. La consulta devuelve datos vacio, no se inicia sesion
                if(mysql_num_rows($result) == 0)
                {
                    echo '<h4> Usuario y/o contraseña incorrectos. Por favor, pruebe otra vez. <a href="'. $_SERVER['HTTP_REFERER'] .' ">Volver</a></h4>';
                }
                else
                {
                    //cambiamos la variable $_SESSION['signed_in'] a verdadero
                    $_SESSION['signed_in'] = true;
                    $entrar = true;
                     
                    //Ponemos el user_id y user_name values en la $_SESSION, asi podremos usarlos en las distintas páginas.
                    while($row = mysql_fetch_assoc($result)) //Recupera una fila de resultados como un array asociativo
                    {
                        
                        $_SESSION['user_id']  = $row['usuario_id'];
                        $_SESSION['user_name']  = $row['usuario_nombre'];
                        
                    }
                     
                    echo '<h4> Bienvenid@, ' . $_SESSION['user_name'] . '. <a href="index.php">Volver al inicio</a>. </h4>';
                }
            }
        }
    }
}
 
include 'footer.php';
?>