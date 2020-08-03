<?php
include 'mainService.php';

 class LoginService extends MainService {

    function login($username, $password) {
        //$result = $this->conex->query("SELECT * FROM USUARIO WHERE NOMBRE_USUARIO='$username' ");
        $result = $this->conex->query("SELECT * FROM USUARIO USU
                                        INNER JOIN ROL_USUARIO RUS ON USU.COD_USUARIO = RUS.COD_USUARIO
                                        INNER JOIN PERSONA PER ON USU.COD_PERSONA = PER.COD_PERSONA
                                        WHERE USU.NOMBRE_USUARIO = '$username'");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row['CLAVE'] == $password) {
                return $row;
            }
        }
        return null;
    }

 }


?>