<?php
include 'mainService.php';

 class AsignacionService extends MainService {

    function getNivelEducativo() {
        return $this->conex->query("SELECT * FROM NIVEL_EDUCATIVO ");
    }

    function getPeriodo() {
        return $this->conex->query("SELECT * FROM PERIODO_LECTIVO");
    }

    function getAsignaturas($codNivelEducativo) {
        return $this->conex->query("SELECT * FROM ASIGNATURA WHERE COD_NIVEL_EDUCATIVO LIKE '$codNivelEducativo'");
    }

   function getParalelo(){
         return $this->conex->query("SELECT * FROM PARALELO");
   }
   
   function getDocente(){
        return $this->conex->query("SELECT P.COD_PERSONA, APELLIDO, NOMBRE FROM PERSONA AS P ,TIPO_PERSONA_PERSONA AS TPP 
        WHERE P.COD_PERSONA = TPP.COD_PERSONA AND TPP.COD_TIPO_PERSONA LIKE 'DOC'");
    }

    function getAula(){
        return $this->conex->query("SELECT * FROM AULA");
    }
    function insert($codNivelEducativo,$codAsignatura,$codPeriodo,$codParalelo,$codDocente,$codAula){
            
        $stmt = $this->conex->prepare("INSERT INTO ASIGNATURA_PERIODO  
                                        (COD_NIVEL_EDUCATIVO, COD_ASIGNATURA, COD_PERIODO_LECTIVO, COD_PARALELO, COD_DOCENTE, COD_AULA)  
                                        VALUES (?,?,?,?,?,?)");
        $stmt->bind_param('ssssis', $codNivelEducativo,$codAsignatura,$codPeriodo,$codParalelo,$codDocente,$codAula);
        $stmt->execute();
        $stmt->close();

        $stmt1 = $this->conex->prepare("INSERT INTO ASIGNATURA_PERIODO  
                                        (COD_NIVEL_EDUCATIVO, COD_ASIGNATURA, COD_PERIODO_LECTIVO, COD_PARALELO, COD_DOCENTE, COD_QUIMESTRE, COD_AULA)  
                                        VALUES (?,?,?,?,?,?,?)");
        $stmt1->bind_param('ssssiss', $codNivelEducativo,$codAsignatura,$codPeriodo,$codParalelo,$codDocente,'2',$codAula);
        $stmt1->execute();
        $stmt1->close();
        
    }

    function getAsignaturaCurso($periodo, $codNivelEducativo){
        return $this->conex->query("SELECT * FROM ASIGNATURA_PERIODO WHERE COD_PERIODO_LECTIVO LIKE '$periodo' 
                                            AND COD_NIVEL_EDUCATIVO LIKE '$codNivelEducativo' AND COD_QUIMESTRE = '1'");
    }


 }


?>