<?php
include 'mainService.php';
    class EdificioService extends MainService{
        function getSedes(){
            return $this->conex->query("SELECT * FROM SEDE");
        }

        function getEdificios($codEdificio){
            return $this->conex->query("SELECT * FROM EDIFICIO WHERE COD_SEDE LIKE '$codEdificio'");
        }
        function insert($codigoEdificio,$codigoSede,$nombre,$pisos){
            
            $stmt = $this->conex->prepare("INSERT INTO EDIFICIO  VALUES (?,?,?,?)");
            $stmt->bind_param('sssi', $codigoEdificio,$codigoSede,$nombre,$pisos);
            $stmt->execute();
            $stmt->close();
            
        }
        function findByPk($codEdificio){
            $result = $this->conex->query("SELECT * FROM EDIFICIO  WHERE COD_EDIFICIO LIKE '$codEdificio'");
                if ($result->num_rows > 0) {
                    return $result->fetch_assoc();
                    
                }else{
                    return null;
                }
        }
        function update($codigoEdificio,$codigoSede,$nombre,$pisos){

            $stmt = $this->conex->prepare("UPDATE EDIFICIO SET COD_SEDE = ?, NOMBRE= ?, CANTIDAD_PISOS = ? WHERE COD_EDIFICIO = ?");
            $stmt->bind_param('ssis', $codigoSede,$nombre,$pisos,$codigoEdificio);
            $stmt->execute();
            $stmt->close();
        }
        function delete($codigoEdificio){
            $stmt = $this->conex->prepare("DELETE FROM  EDIFICIO  WHERE COD_EDIFICIO = ?");
            $stmt->bind_param('s', $codigoEdificio);
            $stmt->execute();
            $stmt->close();
        }

    }

?>