<?php
include 'mainService.php';
    class MatriculaService extends MainService{
        
        function getPeriodos() {
            return $this->conex->query("SELECT * FROM PERIODO_LECTIVO");
        }
        function getPeriodo($codigoPeriodo) {
            return $this->conex->query("SELECT * FROM PERIODO_LECTIVO WHERE  COD_PERIODO_LECTIVO LIKE '$codigoPeriodo'");
        }
        function getNivelEducativo() {
            return $this->conex->query("SELECT * FROM NIVEL_EDUCATIVO ");
        }
        function getAlumnosNuevos(){
            return $this->conex->query("SELECT * FROM PERSONA P, TIPO_PERSONA_PERSONA T WHERE P.COD_PERSONA=T.COD_PERSONA AND T.COD_TIPO_PERSONA LIKE 'EST' AND NOT P.COD_PERSONA IN (SELECT COD_ALUMNO FROM MATRICULA_PERIODO)");
        }
        function getAlumnos(){
            return $this->conex->query("SELECT * FROM PERSONA P, TIPO_PERSONA_PERSONA T WHERE P.COD_PERSONA=T.COD_PERSONA AND T.COD_TIPO_PERSONA LIKE 'EST'");
        }
        function getMatricula($codigoPeriodo,$codigoNivelE){
            return $this->conex->query(" SELECT * FROM MATRICULA_PERIODO MT
            JOIN  PERSONA P  ON MT.COD_ALUMNO=P.COD_PERSONA
            WHERE MT.COD_PERIODO_LECTIVO LIKE '$codigoPeriodo' AND MT.COD_NIVEL_EDUCATIVO LIKE '$codigoNivelE'");
        }

        function insert($codigoPeriodo,$codigoAlumno,$codigoNivelE){
            
            $stmt = $this->conex->prepare("INSERT INTO MATRICULA_PERIODO (COD_PERIODO_LECTIVO,COD_ALUMNO,COD_NIVEL_EDUCATIVO) VALUES (?,?,?)");
            $stmt->bind_param('sis', $codigoPeriodo,$codigoAlumno,$codigoNivelE);
            $stmt->execute();
            $stmt->close();
            
        }

    }

?>