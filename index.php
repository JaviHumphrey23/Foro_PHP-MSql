<?php
//index.php
include 'connect.php';
include 'header.php';
         

 
  $sql = "SELECT cat_id, cat_nombre, cat_descripcion 
  			FROM categorias";

 
$result = mysql_query($sql);
 
if(!$result)
{
    echo '<h4> Las categorías no pueden mostrarse, inténtelo de nuevo más tarde. </h4>';
    echo mysql_error();
}
else
{
    if(mysql_num_rows($result) == 0)
    {
        echo '<h4>No existen categorías aún.</h4>';
    }
    else
    {
        //Crear la tabla con las categorías.
        echo //<table  
        	'<div class="tabla_index" >
              	<div class="tr_div">
                	<div class="th_div" align="center">CATEGORÍAS</th>
              		</div>'; 
             
        while($row = mysql_fetch_assoc($result))
        {               
            		echo '<div class="tr_leftpart100">
            		</div>';
                echo '<div class="bordes_tabla">';
                    echo '<h3><a href="category.php?id= ' .$row['cat_id'] .'" >' . $row['cat_nombre'] . '</a></h3> <p>' . $row['cat_descripcion'];
                    echo '</p>';
               	echo '</div>'; 
            	echo '</div>';


        }
    }
}
			echo '</div>';
 
include 'footer.php';

?>
