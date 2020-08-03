<?php
include 'mainService.php';
    class AsignaturaService extends MainService{
        function getSedes(){
            return $this->conex->query("SELECT * FROM EDIFICIO ");
        }
    }

?>