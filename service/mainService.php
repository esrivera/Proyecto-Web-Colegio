<?php

include 'conexion.php';


class MainService {

    public $conex;

    function __construct() {
        $connection = new Connection();
        $this->conex = $connection->getConnection();
    }
}


?>