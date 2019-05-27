<?php
//create_cat.php
include 'connect.php';
include 'header.php';
 
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    //Alguien está llamando al archivo directamente y no queremos eso
    echo '<h4> Esta web no puede mostrarse directamente.</h4>';
}
else
{
    //Comprobamos que se ha iniciado sesión
    if(!$_SESSION['signed_in'])
    {
        echo '<h4>Debes estar registrado para responder.</h4>';
    }
    else
    {
        if (empty($_POST['reply-content'])) {
            echo '<h4> La respuesta no puede estar vacia. ';
            echo ' <a href="topic.php?id=' . mysql_real_escape_string($_GET['id']) . ' "> Volver atrás </h4>';
        }
        else{
        //Un usuario real añade una respuesta
        $sql = "INSERT INTO 
                    posts(posts_contenido,
                          posts_fecha,
                          posts_tema,
                          posts_autor) 
                VALUES ('" . $_POST['reply-content'] . "',
                        NOW(),
                        '" . mysql_real_escape_string($_GET['id']) . "',
                        '" . $_SESSION[user_id] . "')";
                         
        $result = mysql_query($sql);
                         
        if(!$result)
        {
            echo '<h4>Tu respuesta no ha sido guardada. Inténtelo de nuevo mas tarde.</h4>' .mysql_error();
        }
        else
        {
            echo '<h4>Su respuesta ha sido guardada, vuelva al  <a href="topic.php?id=' . htmlentities($_GET['id']) . '">tema</a>.</h4>';
        }
    }
}
}
 
include 'footer.php';
?>