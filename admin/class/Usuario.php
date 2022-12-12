<?php
include "Conexion.php";

class Usuario
{
    // Atributos
    protected $codigo;
    protected $usuario;
    protected $clave;
    protected $rol;
    protected $estado;

    public function __construct($codigo, $usuario, $clave, $rol, $estado)
    {
        $this->codigo = $codigo;
        $this->usuario = $usuario;
        $this->clave = $clave;
        $this->rol = $rol;
        $this->estado = $estado;
    }

    // Metodos
    public static function getByUserName($user_name) // Usuario
    {
        $conexion = new Conexion();
        $conexion->conectar();

        $query = "SELECT * FROM usuarios WHERE usuario = ?";

        $prepare = mysqli_prepare($conexion->link, $query);

        // s => cadenas de texto
        // d => doble
        // i => entero
        // b => binarios

        $prepare->bind_param("s", $user_name);
        $prepare->execute();

        $respuesta = $prepare->get_result();
        $dataArray = $respuesta->fetch_row(); // [1, "usuario", "contra"]

        $conexion->cerrar();

        if (!empty($dataArray)) {
            return new Usuario($dataArray[0], $dataArray[1], $dataArray[2], $dataArray[3], $dataArray[4]);
        }

        return false;
    }

    public static function editarUsuario($user_name, $clave)
    {
        $conexion = new Conexion();
        $conexion->conectar();

        $query = "UPDATE usuarios SET usuario = ? , clave = ? WHERE usuario = '" . $_SESSION["usuario"] . "'";

        $prepare = mysqli_prepare($conexion->link, $query);

        // s => cadenas de texto
        // d => doble
        // i => entero
        // b => binarios

        $prepare->bind_param("ss", $user_name, $clave);
        $prepare->execute();
    }

    public static function cambiarRol($id)
    {
        $conexion = new Conexion();
        $conexion->conectar();

        $query = "UPDATE usuarios SET usuario = ? , clave = ? WHERE usuario = '" . $_SESSION["usuario"] .   "'";

        $prepare = mysqli_prepare($conexion->link, $query);

        // s => cadenas de texto
        // d => doble
        // i => entero
        // b => binarios

        $prepare->bind_param("ss", $user_name, $clave);
        $prepare->execute();
    }


    public static function getAll()
    {
        $conexion = new Conexion();
        $conexion->conectar();

        $query = "SELECT * FROM usuarios WHERE estado = 'ACTIVE'";

        $prepare = mysqli_prepare($conexion->link, $query);
        $prepare->execute();

        $respuesta = $prepare->get_result();
        $dataArray = $respuesta->fetch_all();

        $usuarios = [];

        foreach ($dataArray as $data) {
            $usuario = new Usuario($data[0], $data[1], $data[2], $data[3], $data[4]);
            array_push($usuarios, $usuario);
        }

        return $usuarios;
    }

    public static function DeleteByID($codigo)
    {
        $conexion = new Conexion();
        $conexion->conectar();

        $query = "UPDATE usuarios SET estado = 'SUSPENDED' WHERE codigo = '" . $codigo .   "'";

        $prepare = mysqli_prepare($conexion->link, $query);
        $prepare->execute();
    }

    public function validarClave($clave): bool
    {
        return $this->clave == $clave;
    }

    public function getUsuario(): string
    {
        return $this->usuario;
    }

    public function getCodigo(): int
    {
        return $this->codigo;
    }

    public function getRol(): string
    {
        return $this->rol;
    }

    public function getEstado(): string
    {
        return $this->estado;
    }
}
