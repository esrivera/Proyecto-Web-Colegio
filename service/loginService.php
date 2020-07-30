<?php
include 'mainService.php';

 class LoginService extends MainService {

    function login($username, $password) {
        $result = $this->conex->query("SELECT * FROM USUARIO WHERE NOMBRE_USUARIO='$username' ");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row['CLAVE'] == $password) {
                return $row;
            }
        }
        return null;
    }

    function getRol($codUsuario,$codPersona){
        $result = $this->conex->query(
            "SELECT RU.COD_ROL, RU.COD_USUARIO, PER.NOMBRE, PER.APELLIDO FROM ROL_USUARIO AS RU, PERSONA AS PER
            WHERE RU.COD_USUARIO = $codUsuario AND PER.COD_PERSONA = $codPersona;");
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
            
        }
        return null;
    }
 }


?>