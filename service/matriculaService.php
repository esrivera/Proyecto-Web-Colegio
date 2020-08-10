<?php
include 'mainService.php';
    class MatriculaService extends MainService{
        
        function getPeriodo($codigoPeriodo) {
            return $this->conex->query("SELECT * FROM PERIODO_LECTIVO WHERE  COD_PERIODO_LECTIVO LIKE '$codigoPeriodo'");
        }
        function getNivelEducativo() {
            return $this->conex->query("SELECT * FROM NIVEL_EDUCATIVO ");
        }
        function getAlumnos(){
            return $this->conex->query("SELECT * FROM PERSONA P, TIPO_PERSONA_PERSONA T WHERE P.COD_PERSONA=T.COD_PERSONA AND T.COD_TIPO_PERSONA LIKE 'EST' ");
        }

    }

?>