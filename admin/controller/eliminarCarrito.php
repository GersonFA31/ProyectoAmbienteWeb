<?php

include "../class/Carrito.php";

session_start();

if (!isset($_GET["ID"])) {
    header("location: ../../user/carrito.php");
    exit();
}

// Validar que los datos no esten vacios.


// Eliminar
$producto = new Carrito(0, $_POST["img"], $_POST["nombre"], $_POST["precio"], $_POST[$_SESSION["usuario"]]);

$respuesta = $producto->DeleteByID($_GET["ID"]);

if ($respuesta == "OK") {
    header("location: ../../user/carrito.php?codigo=1");
    exit();
}

header("location: ../../user/carrito.php?codigo=4&error=" . $respuesta);
exit();
