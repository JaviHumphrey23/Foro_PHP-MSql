<?php
//create_cat.php
include 'connect.php';
include 'header.php';
 
if($_SESSION['signed_in'] == false)
{
    //Si el usuario no ha iniciado sesión
    echo '<h4> Debes haber iniciado sesión para crear un tema. </h4>';
}
else
{
    //Si el usuario ha iniciado sesión
    if($_SERVER['REQUEST_METHOD'] != 'POST')
    {   
        $sql = "SELECT
                    cat_id,
                    cat_nombre,
                    cat_descripcion
                FROM
                    categorias";
         
        $result = mysql_query($sql);
         
        if(!$result)
        {
            //Si la consulta falla
            echo '<h4>Error en la base de datos.</h4>';
        }
        else
        {
            if(mysql_num_rows($result) == 0)
            {
                //Si no existen categorías
                if($_SESSION['nivel'] == 1)
                {
                    echo '<h4>No hay categorias creadas aun.</h4>';
                }
                else
                {
                    echo '<h4>Solo los administradores pueden crear temas.</h4>';
                }
            }
            else
            {
         
            echo '<form method="post" action="">
                <div class="tabla_index">
                    <div class="tr_div">
                        <div class="td_div">
                            Tema:
                        </div>
                        <div class="td_div">
                            <input type="text" style="width:100%" name="name_tema" />
                        </div>
                    </div>
                    <div class="tr_div">
                        <div class="td_div">
                            Categoría:
                        </div>'; 
                    
                        echo '<div class="td_div">
                            <select name="topic_cat">';
                    while($row = mysql_fetch_assoc($result))
                    {
                        echo '<option value="' . $row['cat_id'] . '">' . $row['cat_nombre'] . '</option>';
                    }
                            echo '</select>
                        </div>
                    </div>'; 
                     
                    echo '<div class="tr_div">
                        <div class="td_div">
                            Mensaje:
                        </div>
                        <div class="td_div">
                            <textarea style="resize:none; width:100%; height: 10em;" name="post_content" /></textarea>
                        </div>
                    </div>
                    <div class="tr_div">
                        <div class="td_div">
                            <input type="submit" class="boton" value="Crear tema" />
                    </div>
                        </div>
                    </div>
                 </form>';
            }
        }
    }
    else{
         $errors = array();
            if (empty($_POST['name_tema'])) {

                $errors[] = '<h4> El nombre del tema no puede estar vacio </h4>';
            }

            if(empty($_POST['post_content'])){

                $errors[] = '<h4> La descripción del tema no puede estar vacia </h4>';
            }
            if(!empty($errors)){

            echo '<h4> Oh oh... Parece que algo ha ido mal.';
            echo '<ul>';
            foreach($errors as $key => $value) /* Recorre el array y muestra los fallos */
            {
                echo '<li>' . $value . '</li>'; 
            }
                echo '</ul> ';
                echo '<a href="create_topic.php"> Volver atrás </a> </h4>';
            }
            else{
    
        //Empezamos la transacción
        $query  = "BEGIN WORK;";
        $result = mysql_query($query);
         
        if(!$result)
        {
            //Si la consulta falla
            echo '<h4>Ha ocurrido un error al crear el tema.</h4>';
        }
        else
        {
           
     
            
            $sql = "INSERT INTO 
                        temas (tema_nombre,
                               tema_fecha,
                               tema_categoria,
                               tema_autor)
                   VALUES('" . mysql_real_escape_string($_POST['name_tema']) . "',
                               NOW(),
                               " . mysql_real_escape_string($_POST['topic_cat']) . ",
                               " . $_SESSION['user_id'] . "
                               )";
                      
            $result = mysql_query($sql);
            if(!$result)
            {
                echo '<h4> Ha ocurrido un error al insertar los datos.</h4>' . mysql_error();
                $sql = "ROLLBACK;";
                $result = mysql_query($sql);
            }
            else
            {
                $topicid = mysql_insert_id();
                 
                $sql = "INSERT INTO
                            posts(posts_contenido,
                                  posts_fecha,
                                  posts_tema,
                                  posts_autor)
                        VALUES
                            ('" . mysql_real_escape_string($_POST['post_content']) . "',
                                  NOW(),
                                  " . $topicid . ",
                                  " . $_SESSION['user_id'] . "
                            )";
                $result = mysql_query($sql);
                 
                if(!$result)
                {
                    echo '<h4>Ha ocurrido un error al insertar los datos.</h4>' . mysql_error();
                    $sql = "ROLLBACK;";
                    $result = mysql_query($sql);
                }
                else
                {
                    $sql = "COMMIT;";
                    $result = mysql_query($sql);
                     
                    echo '<h4>Has creado correctamente <a href="topic.php?id='. $topicid . '"> el nuevo tema</a>.</h4>';
                }
            }
        }
    }
    }
}
 
include 'footer.php';
?>