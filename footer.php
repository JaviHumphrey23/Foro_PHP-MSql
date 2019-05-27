</div><!-- contenido -->

<div id="footer" style="clear: both;
    font-family: 'Marvel', sans-serif;
    color: #BF5B45;
    font-weight: bold;
    font-size: 1em;">Web creada por Javier Sánchez Escribano</div>
    <?php
    echo '<div id="userbar_footer">';

    if($_SESSION['signed_in']) //Comprobamos is se ha iniciado una sesión
    {
        echo '<div id="sesion_ini">Hola ' . $_SESSION['user_name'] . '. ¿No eres tú? <a href="signout.php">Salir</a></div>';
    }
    else
    {
        echo '<a href="signin.php">Iniciar sesión</a> o <a href="signup.php">Crear una cuenta</a>';

    }
    ?>
    </div><!-- contenedor -->
</body>
</html>