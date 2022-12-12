<?php
include "../class/Productos.php";

if (!isset($_POST["nombre"])) {
    header("location: ../pages/productos.php");
    exit();
}

// Validar que los datos no esten vacios.


// Crear
$producto = new Productos(0, $_POST["nombre"], $_POST["precio"], $_POST["cantidad"], $_FILES['img']['name']);

if ($_FILES['img']['size'] <=  20000) {
    $ruta = "../../img/productos/" . $_FILES['img']['name'];
    move_uploaded_file($_FILES["img"]["tmp_name"], $ruta);
}

$respuesta = $producto->crear();


// $respuesta = $producto->create($_FILES['img']['name']);

if ($respuesta == "OK") {
    header("location: ../pages/productos.php?codigo=1");
    exit();
}

header("location: ../pages/productos.php?codigo=4&error=" . $respuesta);
exit();
