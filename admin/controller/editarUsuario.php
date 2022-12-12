<?php
include "../class/Usuario.php";

session_start();

if (!isset($_SESSION["codigo"])) {
    header("location: ../../confPerfil.php");
    exit();
}

// Validar que los datos no esten vacios.


// Editar
$usuario = new Usuario(0, $_POST["usuario"], $_POST["contra"], $_POST["rol"], $_POST["estado"]);

$respuesta = $usuario->editarUsuario($_POST["usuario"], $_POST["contra"]);

if ($respuesta == "OK") {
    header("location: ../../confPerfil.php?codigo=1");
    exit();
}

session_unset();

session_destroy();

header("location: ../pages/index.php");
exit();
