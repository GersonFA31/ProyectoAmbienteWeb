<?php

class Conexion
{
    public $link;

    public function conectar() {
        $this->link = mysqli_connect("127.0.0.1", "root", "", "TechnoExpress",3308); //IP o Localhost, roor, contrasenha del root, nombreBD, puerto en el que lo tenga. Si es 3306 no necesita escribirlo :)
    }

    public function cerrar() {
        $this->link->close();
    }
}