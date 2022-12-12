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
    <title>Techno Express CR</title>
    <?php
    session_start();
    if (!isset($_SESSION["login"])) {
        header("location: index.php?error=1");
        exit();
    }
    include "../class/Productos.php";
    ?>
</head>
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

<body>
    <header>
        <h1>Admin</h1>
    </header>

    <section class="contenedor contenido-lista">

        <div class="h_ordenes">
            <h2>Productos</h2>
            <div class="b_ordenes">
                <a class="boton" href="nuevo_producto.php">Nuevo Producto</a>
            </div>
        </div>

        <?php $productos = Productos::getAll(); ?>

        <?php if (empty($productos)) {  ?>
            <div>
                <p class="text-primary">No hay ordenes de servicio en el sistema.</p>
            </div>
        <?php } else { ?>

            <table>
                <thead>
                    <tr>
                        <th>Img</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>

                <tbody>
                    <?php

                    foreach ($productos as $producto) {

                        $img = '"../../img/productos/' . $producto->getImg() . '"';

                        echo "<tr>";
                        echo "<td><img src='../../img/productos/" . $producto->getImg() . "'>" . "</td>";
                        echo "<td>" . $producto->getNombre() . "</td>";
                        echo "<td>" . $producto->getPrecio() . "</td>";
                        echo "<td>" . $producto->getCantidad() . "</td>";
                        echo "</tr>";
                    }

                    ?>
                </tbody>
            </table>

        <?php } ?>

        <?php

        if (isset($_GET["codigo"])) {
            if ($_GET["codigo"] == "1") { // CREADO
                echo "<p class='text-primary'>Producto creado con exito.</p>";
            }
            if ($_GET["codigo"] == "4") { // ERROR
                echo "<p class='text-tertiary'>" . $_GET["error"] . "</p>";
            }
        }

        ?>
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