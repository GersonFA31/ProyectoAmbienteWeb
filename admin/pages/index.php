<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../style.css">
    <link rel="shortcut icon" href="img/icons/settings.png">
    <title>Techno Express CR</title>

    <?php
    session_start();
    if (isset($_SESSION["login"])) {
        header("location: admin.php");
        exit();
    }
    ?>
</head>

<br>
<br>
<br>
<br>
<br>

<body>


    <form class="perfil" action="../controller/login.php" method="post" autocomplete="off">
        <h3>Inicar Sesion</h3>
        <div>
            <label for="usuario">Nombre de Usuario</label>
            <input id="usuario" name="usuario" type="text" placeholder="Ingrese nombre usuario">
        </div>
        <div>
            <label for="contra">Contraseña</label>
            <input id="contra" name="contra" type="password" placeholder="Ingrese su contraseña">
        </div>
        <div>
            <button class="boton-enviar" type="submit">Iniciar Sesion</button>
        </div>
    </form>

    <?php
    if (isset($_GET["error"])) {
        switch ($_GET["error"]) {
            case '1':
                echo "<p class='text-tertiary'>* No autorizado</p>";
                break;
            case '2':
                echo "<p class='text-tertiary'>* Se requiere usuario y contraseña</p>";
                break;
            case '3':
                echo "<p class='text-tertiary'>* Credenciales invalidos</p>";
                break;
        }
    }
    ?>

    <div class="footer-basic">
        <footer>
            <div class="social">
                <a href="#"><img src="./../../img/icons/redes/facebook.png" alt="facebook"></a>
                <a href="#"><img src="./../../img/icons/redes/twitter.png" alt="twitter"></a>
                <a href="#"><img src="./../../img/icons/redes/instagram.png" alt="instagram"></a>
                <a href="#"><img src="./../../img/icons/redes/youtube.png" alt="youtube"></a>
            </div>
            <p class="copyright">Techno Express CR © 2022</p>
        </footer>
    </div>
</body>

</html>