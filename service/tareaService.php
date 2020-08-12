<?php
include 'mainService.php';
    class TareaService extends MainService{
        
        function getNivelEducativo() {
            return $this->conex->query("SELECT * FROM NIVEL_EDUCATIVO ");
        }
    
        function getPeriodo($codigoPeriodo) {
            return $this->conex->query("SELECT * FROM PERIODO_LECTIVO WHERE COD_PERIODO_LECTIVO LIKE '$codigoPeriodo' ");
        }
    
        function getAsignaturas($codNivelEducativo,$codDocente,$codigoPeriodo) {
            return $this->conex->query("SELECT AP.COD_ASIGNATURA,A.NOMBRE,AP.COD_AULA FROM ASIGNATURA_PERIODO AP, ASIGNATURA A WHERE AP.COD_NIVEL_EDUCATIVO LIKE '$codNivelEducativo' AND AP.COD_DOCENTE LIKE '$codDocente'
            AND AP.COD_PERIODO_LECTIVO LIKE '$codigoPeriodo' AND AP.COD_QUIMESTRE LIKE '1' AND AP.COD_ASIGNATURA=A.COD_ASIGNATURA");
        }
    
       function getParalelo($codNivelEducativo,$codDocente,$codigoPeriodo){
            return $this->conex->query("SELECT COD_PARALELO,NOMBRE FROM PARALELO WHERE COD_PARALELO IN (SELECT AP.COD_PARALELO FROM ASIGNATURA_PERIODO AP, ASIGNATURA A WHERE AP.COD_NIVEL_EDUCATIVO LIKE '$codNivelEducativo' AND AP.COD_DOCENTE LIKE '$codDocente'
            AND AP.COD_PERIODO_LECTIVO LIKE '$codigoPeriodo' AND AP.COD_QUIMESTRE LIKE '1' AND AP.COD_ASIGNATURA=A.COD_ASIGNATURA)");
       }
       
       function getDocente($apellidoDocente){
            return $this->conex->query("SELECT P.COD_PERSONA, APELLIDO, NOMBRE FROM PERSONA AS P ,TIPO_PERSONA_PERSONA AS TPP 
            WHERE P.COD_PERSONA = TPP.COD_PERSONA AND TPP.COD_TIPO_PERSONA LIKE 'DOC' AND P.APELLIDO LIKE '$apellidoDocente'");
        }
    
        function getAula($codNivelEducativo,$codDocente,$codigoPeriodo){
            return $this->conex->query("SELECT COD_AULA, NOMBRE FROM AULA WHERE COD_AULA IN (SELECT AP.COD_AULA FROM ASIGNATURA_PERIODO AP, ASIGNATURA A WHERE AP.COD_NIVEL_EDUCATIVO LIKE '$codNivelEducativo' AND AP.COD_DOCENTE LIKE '$codDocente'
            AND AP.COD_PERIODO_LECTIVO LIKE '$codigoPeriodo' AND AP.COD_QUIMESTRE LIKE '1' AND AP.COD_ASIGNATURA=A.COD_ASIGNATURA)");
        }
        
        function insert($codNivelEducativo,$codAsignatura,$codPeriodo,$codParalelo,$codDocente,$codigoQuimestre,$detalleTarea){
                
            $stmt = $this->conex->prepare("INSERT INTO TAREA_ASIGNATURA 
                                            (COD_NIVEL_EDUCATIVO, COD_ASIGNATURA, COD_PERIODO_LECTIVO, COD_PARALELO, COD_DOCENTE, COD_QUIMESTRE, DETALLE_TAREA)  
                                            VALUES (?,?,?,?,?,?,?)");
            $stmt->bind_param('ssssiss', $codNivelEducativo,$codAsignatura,$codPeriodo,$codParalelo,$codDocente,$codigoQuimestre,$detalleTarea);
            $stmt->execute();
            $stmt->close();
            
        }
    }



?>