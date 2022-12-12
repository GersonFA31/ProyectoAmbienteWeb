<?php
include "Conexion.php";

class Productos extends Conexion
{
    // Atributos
    protected $id;
    protected $img;
    protected $nombre;
    protected $precio;
    protected $cantidad;

    public function __construct($id, $img, $nombre, $precio, $cantidad)
    {
        $this->id = $id;
        $this->img = $img;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->cantidad = $cantidad;
    }

    // Metodos

    public function create($img)
    {
        $this->conectar();

        $query = "INSERT INTO productos(img, nombre, precio, cantidad)" .
            "VALUES('" . $img . "', ?, ?, ?)";


        $prepare = mysqli_prepare($this->link, $query);

        // s => cadenas de texto
        // d => doble
        // i => entero
        // b => binarios

        $prepare->bind_param(
            "sii",
            $this->nombre,
            $this->precio,
            $this->cantidad
        );

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

        $query = "SELECT * FROM productos";

        $prepare = mysqli_prepare($conexion->link, $query);
        $prepare->execute();

        $respuesta = $prepare->get_result();
        $dataArray = $respuesta->fetch_all();

        $productos = [];

        foreach ($dataArray as $data) {
            $producto = new Productos($data[0], $data[1], $data[2], $data[3], $data[4]);
            array_push($productos, $producto);
        }

        return $productos;
    }


    public function crear()
    {
        $this->conectar();

        $query = "INSERT INTO productos(img,nombre,precio,cantidad)
            VALUES('Mario Rabbids Sparks of HOPE.jpeg','Mario Rabbids',25000,5)";


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

    public static function getByID($id) // Producto
    {
        $conexion = new Conexion();
        $conexion->conectar();

        $query = "SELECT * FROM producto WHERE id = ?";

        $prepare = mysqli_prepare($conexion->link, $query);

        // s => cadenas de texto
        // d => doble
        // i => entero
        // b => binarios

        $prepare->bind_param("i", $id);
        $prepare->execute();

        $respuesta = $prepare->get_result();
        $dataArray = $respuesta->fetch_row(); // [id, "img", "nombre", "precio", "cantidad"]

        $conexion->cerrar();

        if (!empty($dataArray)) {
            return new Productos($dataArray[0], $dataArray[1], $dataArray[2], $dataArray[3], $dataArray[4]);
        }

        return false;
    }



    public function validarID($id): bool
    {
        return $this->id == $id;
    }

    public function getImg(): string
    {
        return $this->img;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getPrecio(): int
    {
        return $this->precio;
    }

    public function getCantidad(): int
    {
        return $this->cantidad;
    }
}
