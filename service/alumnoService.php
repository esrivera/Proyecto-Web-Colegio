<?php
include 'mainService.php';
    class AlumnoService extends MainService{
        function getPeriodos() {
            return $this->conex->query("SELECT * FROM PERIODO_LECTIVO WHERE ESTADO = 'ACT'");
        }
        function getAsignaturasCalificaciones($codPeriodo,$codAlumno) {
            return $this->conex->query("SELECT NOMBRE,COD_QUIMESTRE,NOTA15,ASP.COD_ASIGNATURA FROM ALUMNO_ASIGNATURA_PERIODO ASP 
            INNER JOIN ASIGNATURA ASI ON ASP.COD_ASIGNATURA = ASI.COD_ASIGNATURA
            WHERE ASP.COD_PERIODO_LECTIVO = '$codPeriodo' AND ASP.COD_ALUMNO=$codAlumno");
        }
        function getCalificaciones($codPeriodo,$codAlumno) {
            return $this->conex->query("SELECT NOMBRE,COD_QUIMESTRE,NOTA15 FROM ALUMNO_ASIGNATURA_PERIODO ASP ");
        }
        function getAsignaturas($codPeriodo,$codAlumno){
            return $this->conex->query("SELECT ASP.COD_ASIGNATURA, COD_PERIODO_LECTIVO, ASI.NOMBRE FROM ALUMNO_ASIGNATURA_PERIODO ASP
            INNER JOIN ASIGNATURA ASI ON ASP.COD_ASIGNATURA = ASI.COD_ASIGNATURA
            WHERE ASP.COD_PERIODO_LECTIVO = '$codPeriodo' AND ASP.COD_ALUMNO=$codAlumno
            GROUP BY ASP.COD_ASIGNATURA");
        }

    }




?>