<?php
include 'mainService.php';

 class AsignService extends MainService {

    function getNivelEducativo() {
        return $this->conex->query("SELECT * FROM NIVEL_EDUCATIVO ");
    }

    function getAsignaturas($codNivelEducativo) {
        return $this->conex->query("SELECT * FROM ASIGNATURA WHERE COD_NIVEL_EDUCATIVO LIKE '$codNivelEducativo'");
    }

 }


?>