<?php
include "../class/Usuario.php";

if (!isset($_POST["usuario"])) {
    header("location: ../pages/index.php?error=1");
    exit();
}

if ($_POST["usuario"] == "") {
    header("location: ../pages/index.php?error=2");
    exit();
}

if ($_POST["contra"] == "") {
    header("location: ../pages/index.php?error=2");
    exit();
}

$usuario = Usuario::getByUserName($_POST["usuario"]);

if (!$usuario) {
    header("location: ../pages/index.php?error=3");
    exit();
}

if ($usuario->validarClave($_POST["contra"])) {
    session_start();
    $_SESSION["estado"] = $usuario->getEstado();
    if ($_SESSION["estado"] != "SUSPENDED") {
        $_SESSION["login"] = true;
        $_SESSION["usuario"] = $usuario->getUsuario();
        $_SESSION["codigo"] = $usuario->getCodigo();
        $_SESSION["rol"] = $usuario->getRol();

        header("location: ../../index.html");
        exit();
    } else {
        session_unset();

        session_destroy();
        header("location: ../pages/index.php?error=3");
        exit();
    }
} else {
    session_unset();

    session_destroy();
    header("location: ../pages/index.php?error=3");
    exit();
}
