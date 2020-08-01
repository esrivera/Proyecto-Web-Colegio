<?php
include 'mainService.php';

 class AsignService extends MainService {

    function getNivelEducativo() {
        return $this->conex->query("SELECT * FROM NIVEL_EDUCATIVO ");
    }

    function getAsignaturas($codNivelEducativo) {
        return $this->conex->query("SELECT * FROM ASIGNATURA WHERE COD_NIVEL_EDUCATIVO LIKE '$codNivelEducativo'");
    }

    function insert($codigoNivel,$codigoMateria,$nombre,$creditos,$tipo){
            
        $stmt = $this->conex->prepare("INSERT INTO ASIGNATURA  VALUES (?,?,?,?,?)");
        $stmt->bind_param('sssis', $codigoNivel,$codigoMateria,$nombre,$creditos,$tipo);
        $stmt->execute();
        $stmt->close();
        
    }

    function findByPk($codigoAsignatura){
        $result = $this->conex->query("SELECT * FROM ASIGNATURA  WHERE COD_ASIGNATURA LIKE '$codigoAsignatura'");
            if ($result->num_rows > 0) {
                return $result->fetch_assoc();
                
            }else{
                return null;
            }
    }
    function update($codigoNivel,$codigoMateria,$nombre,$creditos,$tipo){

        $stmt = $this->conex->prepare("UPDATE ASIGNATURA SET COD_NIVEL_EDUCATIVO = ?, NOMBRE= ?, CREDITOS = ?, TIPO = ? WHERE COD_ASIGNATURA = ?");
        $stmt->bind_param('ssiss', $codigoNivel,$nombre,$creditos,$tipo,$codigoMateria);
        $stmt->execute();
        $stmt->close();
    }
    
    function delete($codigoMateria){
        $stmt = $this->conex->prepare("DELETE FROM  ASIGNATURA  WHERE COD_ASIGNATURA = ?");
        $stmt->bind_param('s', $codigoMateria);
        $stmt->execute();
        $stmt->close();
    }

 }


?>