<?php
include 'mainService.php';
    class AlumnoService extends MainService{
        function getPeriodos() {
            return $this->conex->query("SELECT * FROM PERIODO_LECTIVO WHERE ESTADO = 'ACT'");
        }
        function getAsignaturasCalificaciones($codPeriodo,$codAlumno) {
            return $this->conex->query("SELECT NOMBRE,COD_QUIMESTRE,NOTA15 FROM ALUMNO_ASIGNATURA_PERIODO ASP 
            INNER JOIN ASIGNATURA ASI ON ASP.COD_ASIGNATURA = ASI.COD_ASIGNATURA
            WHERE ASP.COD_PERIODO_LECTIVO = 'P12020' AND ASP.COD_ALUMNO=6");
        }
        function getCalificaciones($codPeriodo,$codAlumno) {
            
            return $this->conex->query("SELECT NOMBRE,COD_QUIMESTRE,NOTA15 FROM ALUMNO_ASIGNATURA_PERIODO ASP ");
        }

    }




?>