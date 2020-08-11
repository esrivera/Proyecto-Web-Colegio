<?php
include 'mainService.php';
    class AlumnoService extends MainService{
        function getPeriodos() {
            return $this->conex->query("SELECT * FROM PERIODO_LECTIVO WHERE ESTADO = 'ACT'");
        }
        function getAsignaturasCalificaciones($codPeriodo,$codAlumno) {
            return $this->conex->query("SELECT NOMBRE,COD_QUIMESTRE,NOTA15,ASP.COD_ASIGNATURA,NOTA11,NOTA12,NOTA13,NOTA14 FROM ALUMNO_ASIGNATURA_PERIODO ASP 
            INNER JOIN ASIGNATURA ASI ON ASP.COD_ASIGNATURA = ASI.COD_ASIGNATURA
            WHERE ASP.COD_PERIODO_LECTIVO = '$codPeriodo' AND ASP.COD_ALUMNO=$codAlumno");
        }
        function getCalificaciones($codPeriodo,$codAlumno,$codAsignatura,$codQuimestre) {
            return $this->conex->query("SELECT AAP.COD_QUIMESTRE, TA.DETALLE_TAREA,
            AAP.NOTA1, AAP.NOTA2,AAP.NOTA3,AAP.NOTA4,AAP.NOTA5,AAP.NOTA6,AAP.NOTA7,AAP.NOTA8,AAP.NOTA9,AAP.NOTA10,
            AAP.NOTA11,AAP.NOTA12,AAP.NOTA13,AAP.NOTA14
            FROM ALUMNO_ASIGNATURA_PERIODO AAP
            INNER JOIN TAREA_ASIGNATURA TA ON AAP.COD_QUIMESTRE = TA.COD_QUIMESTRE AND AAP.COD_ASIGNATURA = TA.COD_ASIGNATURA
            WHERE AAP.COD_ASIGNATURA = '$codAsignatura' AND AAP.COD_PERIODO_LECTIVO = '$codPeriodo' 
                  AND AAP.COD_QUIMESTRE = '$codQuimestre' AND AAP.COD_ALUMNO=$codAlumno");
        }
        function getAsignaturas($codPeriodo,$codAlumno){
            return $this->conex->query("SELECT ASP.COD_ASIGNATURA, COD_PERIODO_LECTIVO, ASI.NOMBRE FROM ALUMNO_ASIGNATURA_PERIODO ASP
            INNER JOIN ASIGNATURA ASI ON ASP.COD_ASIGNATURA = ASI.COD_ASIGNATURA
            WHERE ASP.COD_PERIODO_LECTIVO = '$codPeriodo' AND ASP.COD_ALUMNO=$codAlumno
            GROUP BY ASP.COD_ASIGNATURA");
        }
        function getNotas($codPeriodo,$codAlumno,$codAsignatura,$codQuimestre){
            return $this->conex->query("SELECT * FROM ALUMNO_ASIGNATURA_PERIODO WHERE COD_PERIODO_LECTIVO = '$codPeriodo' 
                                        AND COD_ASIGNATURA = '$codAsignatura' AND COD_ALUMNO = $codAlumno AND COD_QUIMESTRE = '$codQuimestre'");
        }

    }




?>