<?php
include "Conexion.php";

class Carrito extends Conexion
{
    // Atributos
    protected $id;
    protected $img;
    protected $nombre;
    protected $precio;
    protected $cliente;

    public function __construct($id, $img, $nombre, $precio, $cliente)
    {
        $this->id = $id;
        $this->img = $img;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->cliente = $cliente;
    }

    // Metodos

    public function create($id)
    {
        $this->conectar();

        $query = "INSERT INTO carrito(img, nombre, precio,cliente)
        SELECT productos.img, productos.nombre, productos.precio, usuarios.usuario FROM productos, usuarios
        WHERE productos.id = '" . $id . "' AND usuarios.usuario = '" . $_SESSION["usuario"] . "'";

        $prepare = mysqli_prepare($this->link, $query);

        // s => cadenas de texto
        // d => doble
        // i => entero
        // b => binarios

        if ($prepare->execute()) {
            $this->cerrar();
            return "OK";
        } else {
            $this->cerrar();
            return "Error: " . $prepare->error;
        }
    }

    public static function getAll()
    {
        $conexion = new Conexion();
        $conexion->conectar();

        $query = "SELECT * FROM carrito where cliente = '" . $_SESSION["usuario"] . "'";

        $prepare = mysqli_prepare($conexion->link, $query);
        $prepare->execute();

        $respuesta = $prepare->get_result();
        $dataArray = $respuesta->fetch_all();

        $productos = [];

        foreach ($dataArray as $data) {
            $producto = new Carrito($data[0], $data[1], $data[2], $data[3], $data[4]); // [id,img,nombre,precio,cliente]
            array_push($productos, $producto);
        }

        return $productos;
    }

    public static function DeleteByID($id)
    {
        $conexion = new Conexion();
        $conexion->conectar();

        $query = "DELETE FROM carrito where id = " . $id;

        $prepare = mysqli_prepare($conexion->link, $query);
        $prepare->execute();
    }

    public static function DeleteAll($user_name)
    {
        $conexion = new Conexion();
        $conexion->conectar();

        $query = "DELETE FROM carrito WHERE cliente = '" . $user_name . "'";

        $prepare = mysqli_prepare($conexion->link, $query);
        $prepare->execute();
    }

    public function getID(): int
    {
        return $this->id;
    }

    public function getImg(): string
    {
        return $this->img;
    }

    public function setImg($img)
    {
        $this->img = $img;
    }



    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }



    public function getPrecio(): int
    {
        return $this->precio;
    }

    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }



    public function getCantidad(): int
    {
        return $this->cantidad;
    }

    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }



    public function getCliente(): string
    {
        return $this->cliente;
    }

    public function setCliente($cliente)
    {
        $this->cliente = $cliente;
    }
}
