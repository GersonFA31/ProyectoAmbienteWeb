<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
    <link rel="shortcut icon" href="img/icons/settings.png">
    <title>Techno Express CR</title>
    <?php
    session_start();
    if (!isset($_SESSION["login"])) {
        header("location: index.php?error=1");
        exit();
    }
    include "../admin/class/Carrito.php";

    ?>
</head>

<body>

    <header>
        <section class="color-1">
            <nav class="cl-effect-1">
                <h1>Techno Express CR</h1>
                <a href="../index.html">Inicio</a>
                <a href="../productos.php">Productos</a>
                <a href="../perfil.php">Perfil</a>
                <?php
                if ($_SESSION["rol"] == "ADMIN") {
                ?> <a href="admin/pages/admin.php">Modo Admin</a> <!-- Borrar -->
                <?php
                }
                ?>
            </nav>
        </section>
    </header>

    <a href="../productos.php" class="boton">Volver a Productos</a>
    <section class="contenedor contenido">

        <?php $carrito = Carrito::getAll(); ?>

        <?php if (empty($carrito)) {  ?>
            <div>
                <p class="text-primary">No se han agregado productos al carrito :c</p>
            </div>
        <?php } else { ?>

            <table class="tabla">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $total = 0;
                    foreach ($carrito as $producto) {

                        $total += $producto->getPrecio();

                        $img = '"../img/productos/' . $producto->getImg() . '"';

                        $linkE = "../admin/controller/eliminarCarrito.php?ID=" . $producto->getID();
                        $linkA = "ingresoInformacion.php?TOT=" . $total;

                        echo "<tr>";
                        echo "<td><img src='../img/productos/" . $producto->getImg() . "'>" . "</td>";
                        echo "<td>" . $producto->getNombre() . "</td>";
                        echo "<td> ₡ " . $producto->getPrecio() . "</td>";
                        echo "<td>" ?> <a class="boton-delete" href="<?php echo $linkE ?>">Eliminar</a> <?php "</td>";
                                                                                                        echo "<tr>";
                                                                                                    }

                                                                                                        ?>
                </tbody>
            </table>
            <p class="totPag"> Total a pagar: ₡ <?php echo $total ?></p>
            <a class="boton-carrito" href=<?php echo $linkA ?>>Comprar Elementos</a>
        <?php } ?>


    </section>

    <div class="footer-basic">
        <footer>
            <div class="social">
                <a href="#"><img src="../img/icons/redes/facebook.png" alt="facebook"></a>
                <a href="#"><img src="../img/icons/redes/twitter.png" alt="twitter"></a>
                <a href="#"><img src="../img/icons/redes/instagram.png" alt="instagram"></a>
                <a href="#"><img src="../img/icons/redes/youtube.png" alt="youtube"></a>
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