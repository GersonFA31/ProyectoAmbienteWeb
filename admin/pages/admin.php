<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../style.css">
    <link rel="shortcut icon" href="../../img/icons/admin.png">
    <title>Techno Express Admin</title>
    <?php
    session_start();
    if (!isset($_SESSION["login"])) {
        header("location: index.php?error=1");
        exit();
    }
    ?>
</head>

<body>
    <header>
        <section class="color-1">
            <nav class="cl-effect-1">
                <h1>Techno Express CR</h1>
                <a href="productos.php">Productos</a>
                <a href="usuarios.php">Usuarios</a>
                <a href="../../index.html">Vista Usuario</a>
                <a href="../../perfil.php">Perfil</a>
            </nav>
        </section>
    </header>

    <section class="contenedor contenido">
        <h2>ACCESO RESTRINGIDO</h2>
        <p>Esta seccion es UNICAMENTE para personal autorizado.
            Si NO cuentas con un permiso para esta seccion de la pagina, se tomarán ACCIONES LEGALES
        </p>

    </section>


    <div class="footer-basic">
        <footer>
            <div class="social">
                <a href="#"><img src="./../../img/icons/redes/facebook.png" alt="facebook"></a>
                <a href="#"><img src="./../../img/icons/redes/twitter.png" alt="twitter"></a>
                <a href="#"><img src="./../../img/icons/redes/instagram.png" alt="instagram"></a>
                <a href="#"><img src="./../../img/icons/redes/youtube.png" alt="youtube"></a>
            </div>
            <p class="usuario-footer">Usuario: <span class="usuario-footer">
                    <?php
                    echo $_SESSION["usuario"];
                    ?>
            </p>
            <p class="copyright">Techno Express CR © 2022</p>
        </footer>
    </div>
</body>

</html>