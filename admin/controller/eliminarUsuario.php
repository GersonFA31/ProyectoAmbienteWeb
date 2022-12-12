<?php

include "../class/Usuario.php";

session_start();

if (!isset($_GET["code"])) {
    header("location: ../pages/usuarios.php");
    exit();
}

// Validar que los datos no esten vacios.


// Eliminar
$usuario = new Usuario(0, $_POST["usuario"], $_POST["contra"], $_POST["rol"], $_POST["estado"]);

$respuesta = $usuario->DeleteByID($_GET["code"]);

if ($respuesta == "OK") {
    header("location: ../pages/usuarios.php?codigo=1");
    exit();
}

header("location: ../pages/usuarios.php?codigo=4&error=" . $respuesta);
exit();
