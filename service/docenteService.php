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

    function findAsignatura($codDocente,$periodo,$nivel){
        $result = $this->conex->query("SELECT * FROM ASIGNATURA A, ASIGNATURA_PERIODO AP WHERE AP.COD_NIVEL_EDUCATIVO='".$nivel."' AND A.COD_NIVEL_EDUCATIVO='".$nivel."' AND AP.COD_DOCENTE=".$codDocente." AND AP.COD_PERIODO_LECTIVO='".$periodo."'");
        if ($result->num_rows != null) {
            return $result;
        } else {
            return null;
        }
    }

    function findNiveldoCod($codNivel){
        $result = $this->conex->query("SELECT * FROM NIVEL_EDUCATIVO WHERE NOMBRE = '".$codNivel."'");
        if ($result->num_rows != null) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
}
