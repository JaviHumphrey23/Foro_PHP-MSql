<?php
include 'connect.php';
include 'header.php';
$sql = "SELECT cat_id, 
               cat_nombre,
               cat_descripcion 
            FROM categorias
        WHERE
            cat_id = '" . mysql_real_escape_string($_GET['id'])."'";
 echo $_POST['id'];
$result = mysql_query($sql);
 
if(!$result)
{
    echo '<h4>La categoría no puede mostrarse. </h4>' . mysql_error();
}
else
{
    if(mysql_num_rows($result) == 0)
    {
        echo '<h4> Esta categoría no existe. </h4>';

    }
    else
    {
        //Exponemos la categoría
        while($row = mysql_fetch_assoc($result))
        {
            echo '<h2>Temas de la categoría: ' . $row['cat_nombre'] . '</h2><br>';
        }
     
        //Seleccionamos los temas
        $sql = "SELECT  
                    tema_id,
                    tema_nombre,
                    tema_fecha,
                    tema_categoria
                FROM
                    temas
                WHERE
                    tema_categoria =  '" . mysql_real_escape_string($_GET['id'])."'";
         
        $result = mysql_query($sql);
         
        if(!$result)
        {
            echo '<h4> Los temas no pueden mostrarse, inténtelo más tarde.</h4>' .mysql_error();
        }
        else
        {
            if(mysql_num_rows($result) == 0)
            {
                echo '<h4> No hay temas en esta categoría aun. </h4>';
            }
            else
            {
                //Creamos la tabla
                echo '<div class="tabla_index">
                    <div class="tr_leftpart100">
                        <div class="th_div_left" align="center">TÍTULO DEL TEMA</div>
                        <div class="th_div_right" align="center">CREADO EL DÍA</div>
                    </div>'; 
                     
                while($row = mysql_fetch_assoc($result))
                {               
                    echo '<div class="tr_leftpart100">';
                        echo '<div class="td_div_leftpart">';
                            echo '<h3><a href="topic.php?id=' . $row['tema_id'] . '">' . $row['tema_nombre'] . '</a><h3>';
                        echo '</div>';
                        echo '<div class="td_div_rightpart" align="right">';
                        echo '<h3>';
                            echo date('d-m-Y', strtotime($row['tema_fecha']));
                            echo '</h3>';
                        echo '</div>';
                    echo '</div>';
                }
            }
        }
    }
}
 echo '</div>';
include 'footer.php';
?>
