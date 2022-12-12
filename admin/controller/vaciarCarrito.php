<?php

include "../class/Carrito.php";

session_start();

if (!isset($_SESSION["usuario"])) {
    header("location: ../../user/carrito.php");
    exit();
}

// Validar que los datos no esten vacios.


// Eliminar
$producto = Carrito::DeleteAll($_SESSION["usuario"]);

$respuesta = $producto;

if ($respuesta == "OK") {
    header("location: ../../user/compraRealizada.php?codigo=1");
    exit();
}

header("location: ../../user/carrito.php?codigo=4&error=" . $respuesta);
exit();
