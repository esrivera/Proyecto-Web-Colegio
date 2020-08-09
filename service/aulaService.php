<?php
include 'mainService.php';
    class AulaService extends MainService{
        function getEdificio(){
            return $this->conex->query("SELECT * FROM EDIFICIO");
        }

        function getAula($codEdificio){
            return $this->conex->query("SELECT * FROM AULA WHERE COD_EDIFICIO LIKE '$codEdificio'");
        
        }
        function insert($codigoAula,$codigoEdificio,$nombre,$capacidad,$tipo,$piso){
            
            $stmt = $this->conex->prepare("INSERT INTO AULA  VALUES (?,?,?,?,?,?)");
            $stmt->bind_param('sssisi', $codigoAula,$codigoEdificio,$nombre,$capacidad,$tipo,$piso);
            $stmt->execute();
            $stmt->close();
            
        }
        function findByPk($codAula){
            $result = $this->conex->query("SELECT * FROM AULA  WHERE COD_AULA LIKE '$codAula'");
                if ($result->num_rows > 0) {
                    return $result->fetch_assoc();
                    
                }else{
                    return null;
                }
        }
        function update($codigoAula,$codigoEdificio,$nombre,$capacidad,$tipo,$piso){

            $stmt = $this->conex->prepare("UPDATE AULA SET COD_EDIFICIO= ?, NOMBRE= ?, CAPACIDAD = ?, TIPO= ?, PISO= ? WHERE COD_AULA= ?");
            $stmt->bind_param('ssisis', $codigoEdificio,$nombre,$capacidad,$tipo,$piso,$codigoAula);
            $stmt->execute();
            $stmt->close();
        }
        function delete($codigoAula){
            $stmt = $this->conex->prepare("DELETE FROM  AULA  WHERE COD_AULA = ?");
            $stmt->bind_param('s', $codigoAula);
            $stmt->execute();
            $stmt->close();
        }

    }

?>