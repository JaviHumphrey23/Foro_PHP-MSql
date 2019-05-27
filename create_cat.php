<?php
//create_cat.php
include 'connect.php';
include 'header.php';
         

if ($_SESSION['signed_in']== false) {
	echo '<h4> Debes haber iniciado sesión para crear una categoría.</h4>';
}
else{
    if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    //El formulario no ha sido creado todavia, lo hacemos a continuación
    echo '<form method="post" action="">
     	<div class="tabla_index">
     	    <div class="tr_div">
                <div class="td_div">
                    Nombre de la categoría: 
                </div>
                <div class="td_div">
                    <input type="text" style="width:100%" name="cat_name" />
                </div>
            </div>
            <div class="tr_div">
                <div class="td_div">
                    Descripción: 
                </div>
                <div class="td_div">
                    <textarea style="resize:none; width:100%; height:10em;" name="cat_description" /></textarea>
                </div>
            </div>
            <div class="tr_div">
                <div class="td_div">
                    <input type="submit" class="boton" style="width:8em" value="Añadir categoría" />
            </tr>
            </div>
                </div>
        </div>
     </form>';
     
    }else{
        $errors = array(); 
        if (empty($_POST['cat_name'])) {

        $errors[] = '<h4> El nombre de la categoría no puede estar vacio </h4>';

        }
        
        if(empty($_POST['cat_description'])) {

        $errors[] = '<h4> La descripción de la categoría no puede estar vacia </h4>';

        }
        if(!empty($errors)){

        echo '<h4> Oh oh... Parece que algo ha ido mal.';
        echo '<ul>';
        foreach($errors as $key => $value) /* Recorre el array y muestra los fallos */
        {
            echo '<li>' . $value . '</li>'; 
        }
        echo '</ul> ';
        echo '<a href="create_cat.php"> Volver atrás </a> </h4>';
        }

        else
        {
    $sql = "INSERT INTO
                    categorias(cat_nombre, cat_descripcion)
                VALUES('" . mysql_real_escape_string($_POST['cat_name']) . "',
                       '" . mysql_real_escape_string($_POST['cat_description']) ."')";
                         
        $result = mysql_query($sql);
        if(!$result)
        {
            //Algo ha ido mal, mostramos el error
            echo '<h4> Algo ha ido mal durante la creación. Por favor intentelo de nuevo mas tarde. </h4>';
            echo mysql_error(); 
        }
        else
        {
            echo ' <h4> Categoría creada con exito. <a href="index.php">Volver al inicio</a>.</h4>';
        }
    }
}
}


include 'footer.php';
?>
