<?php
include 'connect.php';
include 'header.php';
$sql = "SELECT
    tema_id,
    tema_nombre
    FROM
    temas
WHERE
 temas.tema_id = '" . mysql_real_escape_string($_GET['id'])."'";
$result = mysql_query($sql);
    while($row = mysql_fetch_assoc($result))
                { 
    echo '<div class="tabla_index">
                      <div class="tr_div">
                        <div class="th_div" colspan="3" align="center">'. $row['tema_nombre'] . '
                        </div>
                        
                      </div>'; }
 
     
        //Consultamos los temas
        $sql = "SELECT  
                    posts.posts_tema,
                    posts.posts_contenido,
                    posts.posts_fecha,
                    posts.posts_autor,
                    usuarios.usuario_id,
                    usuarios.usuario_nombre
                FROM
                    posts
                LEFT JOIN
                    usuarios
                ON
                    posts.posts_autor = usuarios.usuario_id    
                WHERE
                    posts.posts_tema =  '" . mysql_real_escape_string($_GET['id'])."'";
         
        $result = mysql_query($sql);

         
        if(!$result)
        {
            echo '<h4>Los temas no pueden mostrarse, intentelo mas tarde compae.</h4>' .mysql_error();
        }
        else
        {
            if(mysql_num_rows($result) == 0)
            {
                echo '<h4>No hay temas en esta categoría aún.</h4>';
            }
            else
            {
                //Creamos la tabla
                while($row = mysql_fetch_assoc($result))
                { 
              
                     
                              
                    echo '<div class="tr_leftpart100">';
                        echo '<div class="td_div_leftpart_tema">';
                            echo '<h4>' . $row['posts_fecha']  . '</h4>';
                        echo '</div>';
                        echo '<div class="td_div_leftpart_tema1">';
                            echo '<h4>'. $row['posts_contenido'] . '</h4>';
                        echo '</div>';
                        echo '<div class="td_div_rightpart_tema">';
                            echo '<h4> Escrito por: ' . $row['usuario_nombre'] . '</h4>';
                        echo '</div>';
                    echo '</div>';
                    echo '<div id="respuesta">';
    echo '<br> <br> <br> <br> <br> <br>';
    echo '<h3> Respuesta: </h3>';
    echo '<form method="post" action="reply.php?id=' . $row['posts_tema'] . '">';
    echo '</div>';

    echo '<div id="tr_leftpart100_resp">';
                        echo '<div id="td_div_leftpart_tema_resp">';
                            echo '<h4> Fecha del mensaje: ' . $row['posts_fecha']  . '</h4>';
                        echo '</div>';
                        echo '<div id="td_div_leftpart_tema1_resp">';
                            echo '<h4>'. $row['posts_contenido'] . '</h4>';
                        echo '</div>';
                        echo '<div id="td_div_rightpart_tema_resp">';
                            echo '<h4> Escrito por: ' . $row['usuario_nombre'] . '</h4>';
                        echo '</div> <br><br>';
                    echo '</div>';
  
    echo '<div id="respuesta_resp">';
      echo '<br> <br> <br> <br> <br> <br>';
    echo '<h3> Respuesta: </h3>';
    echo '<form method="post" action="reply.php?id=' . $row['posts_tema'] . '">';
    echo '</div>';
    
    


                }


            }
        echo '<textarea style="resize:none; width:100%; height: 10em;" name="reply-content"></textarea><br>';
    echo '<input class="boton" type="submit" value="Responder" />';
    echo '</form> </div>';
     
    
    }

    


 
include 'footer.php';

?>
