<?php
include 'mainService.php';
class DocenteService extends MainService
{

    function getEdificios($codEdificio)
    {
        return $this->conex->query("SELECT * FROM EDIFICIO WHERE COD_SEDE LIKE '$codEdificio'");
    }

    function update($codigoEdificio, $codigoSede, $nombre, $pisos)
    {

        $stmt = $this->conex->prepare("UPDATE EDIFICIO SET COD_SEDE = ?, NOMBRE= ?, CANTIDAD_PISOS = ? WHERE COD_EDIFICIO = ?");
        $stmt->bind_param('ssis', $codigoSede, $nombre, $pisos, $codigoEdificio);
        $stmt->execute();
        $stmt->close();
    }

    function findPersona($codPersona)
    {
        $result = $this->conex->query("SELECT * FROM PERSONA WHERE COD_PERSONA=" . $codPersona);
        if ($result->num_rows != null) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    function findPeriodo(){
        $result = $this->conex->query("SELECT * FROM PERIODO_LECTIVO WHERE ESTADO = 'ACT'");
        if ($result->num_rows != null) {
            return $result;
        } else {
            return null;
        }
    }

    function findNivel(){
        $result = $this->conex->query("SELECT * FROM NIVEL_EDUCATIVO");
        if ($result->num_rows != null) {
            return $result;
        } else {
            return null;
        }
    }

    function findAsignatura($nivel,$periodo){
        $result = $this->conex->query("SELECT * FROM ASIGNATURA WHERE COD_NIVEL_EDUCATIVO = '".$nivel."'");
        if ($result->num_rows != null) {
            return $result;
        } else {
            return null;
        }
    }

    function findNiveldoCod($nombre){
        $result = $this->conex->query("SELECT DISTINCT * FROM NIVEL_EDUCATIVO WHERE NOMBRE = '".$nombre."'");
        if ($result->num_rows != null) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    function findTarea($asignatura){
        $result = $this->conex->query("SELECT * FROM TAREA_ASIGNATURA WHERE COD_ASIGNATURA = '".$asignatura."'");
        if ($result->num_rows != null) {
            return $result;
        } else {
            return null;
        }
    }
}
