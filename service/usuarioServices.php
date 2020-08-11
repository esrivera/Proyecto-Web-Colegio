<?php
include 'mainService.php';

    class UsuarioService extends MainService{
         
        //INSERT
        function insertPersona($nombre,$apellido,$cedula,$fecNac,$email,$direccion, $telefono, $genero, $emailUsu){
            $stmt = $this->conex->prepare("INSERT INTO PERSONA (CEDULA,APELLIDO,NOMBRE,DIRECCION,TELEFONO,FECHA_NACIMIENTO,GENERO,CORREO,CORREO_PERSONAL) VALUES (?,?,?,?,?,?,?,?,?)");
            $stmt->bind_param('sssssssss', $cedula,$apellido,$nombre,$direccion,$telefono,$fecNac,$genero,$email,$emailUsu);
            $stmt->execute();
            $stmt->close();      
        }

        function insertUsuario($codPersona,$nombre,$clave,$estado,$ultFecIngreso,$intentos){
            $stmt = $this->conex->prepare("INSERT INTO USUARIO (COD_PERSONA,NOMBRE_USUARIO,CLAVE,ESTADO,ULT_FECHA_INGRESO,INTENTOS_FALLIDOS) VALUES (?,?,?,?,?,?)");
            $stmt->bind_param('issssi', $codPersona,$nombre,$clave,$estado,$ultFecIngreso,$intentos);
            $stmt->execute();
            $stmt->close();
            
        }

        function insertTP($codTP,$codPersona,$estado,$fecIni){
            $stmt = $this->conex->prepare("INSERT INTO TIPO_PERSONA_PERSONA (COD_TIPO_PERSONA,COD_PERSONA,ESTADO,FECHA_INICIO) VALUES (?,?,?,?)");
            $stmt->bind_param('siss', $codTP,$codPersona,$estado,$fecIni);
            $stmt->execute();
            $stmt->close();
            
        }

        function username($nombre,$apellido){
            $letras = "";
            $nombre = explode(" ",$nombre);
            $apellido = explode(" ",$apellido);
            foreach ($nombre as $v){
                $letras .= "$v[0]";
            }
            $letras .= "$apellido[0]";
            return strtolower($letras);
        }
        
        function insertRU($codRol,$codUsu,$estado){
            $stmt = $this->conex->prepare("INSERT INTO ROL_USUARIO (COD_ROL,COD_USUARIO,ESTADO) VALUES (?,?,?)");
            $stmt->bind_param('sis', $codRol,$codUsu,$estado);
            $stmt->execute();
            $stmt->close();
            
        }
        
        //LISTAR
        function findAll($tipo){
            $result = $this->conex->query("SELECT * FROM PERSONA P, TIPO_PERSONA_PERSONA TP WHERE TP.COD_PERSONA = P.COD_PERSONA AND TP.COD_TIPO_PERSONA = '$tipo'");
            if ($result->num_rows > 0) {
                return $result;      
            }else{
                return null;
            }
        }

        function findByPkP($cedula){
            $result = $this->conex->query("SELECT * FROM PERSONA  WHERE CEDULA LIKE '$cedula'");
                if ($result->num_rows > 0) {
                    return $result->fetch_assoc();      
                }else{
                    return null;
                }
        }

        function findUN($username){
            $result = $this->conex->query("SELECT * FROM USUARIO  WHERE NOMBRE_USUARIO LIKE '$username'");
            if ($result->num_rows > 0) {
                return $result->fetch_assoc();      
            }else{
                return null;
            }
        }

        function findUNCod($username,$codPersona){
            $result = $this->conex->query("SELECT * FROM USUARIO WHERE NOMBRE_USUARIO = '$username' AND COD_USUARIO !=".$codPersona);
            if ($result->num_rows > 0) {
                return $result->fetch_assoc();      
            }else{
                return null;
            }
        }

        function findByCodP($codPersona){
            $result = $this->conex->query("SELECT * FROM USUARIO WHERE COD_PERSONA=" .$codPersona);
            if ($result->num_rows != null) {
                return $result->fetch_assoc();      
            }else{
                return null;
            }
        }

        function findByCI($ci){
            $result = $this->conex->query("SELECT * FROM PERSONA WHERE CEDULA LIKE '$ci'");
            if ($result->num_rows > 0) {
                return $result;      
            }else{
                return null;
            }
        }
        
        function findPersona($codPersona){
            $result = $this->conex->query("SELECT * FROM PERSONA WHERE COD_PERSONA=" .$codPersona);
            if ($result->num_rows != null) {
                return $result->fetch_assoc();      
            }else{
                return null;
            }
        }
        
        //UPDATE
        function updatePersona($codPersona,$nombre,$apellido,$cedula,$fecNac,$email,$direccion, $telefono, $genero, $emailUsu){
            $stmt = $this->conex->prepare("UPDATE PERSONA SET CEDULA= ?, APELLIDO = ?, NOMBRE = ?, DIRECCION= ?, TELEFONO= ?, FECHA_NACIMIENTO = ?, GENERO = ?, CORREO = ?, CORREO_PERSONAL = ? WHERE COD_PERSONA = ?");
            $stmt->bind_param('sssssssssi', $cedula,$apellido,$nombre,$direccion,$telefono,$fecNac,$genero,$email,$emailUsu,$codPersona);
            $stmt->execute();
            $stmt->close();
        }

        function updateUsuario($codPersona,$nombre,$clave,$estado,$ultFecIngreso,$intentos){
            $stmt = $this->conex->prepare("UPDATE USUARIO SET NOMBRE_USUARIO= ?, CLAVE = ?, ESTADO = ?, ULT_FECHA_INGRESO= ?, INTENTOS_FALLIDOS= ? WHERE COD_PERSONA = ?");
            $stmt->bind_param('ssssii', $nombre,$clave,$estado,$ultFecIngreso,$intentos,$codPersona);
            $stmt->execute();
            $stmt->close();
        }

        //DELETE
        function deleteP($codPersona){
            $stmt = $this->conex->prepare("DELETE FROM PERSONA WHERE COD_PERSONA = ?");
            $stmt->bind_param('i', $codPersona);
            $stmt->execute();
            $stmt->close();
        }

        function deleteU($codPersona){
            $stmt = $this->conex->prepare("DELETE FROM USUARIO WHERE COD_PERSONA = ?");
            $stmt->bind_param('i', $codPersona);
            $stmt->execute();
            $stmt->close();
        }

        function deleteUR($codPersona){
            $stmt = $this->conex->prepare("DELETE FROM ROL_USUARIO WHERE COD_USUARIO = ?");
            $stmt->bind_param('i', $codPersona);
            $stmt->execute();
            $stmt->close();
        }

        function deleteTP($codPersona){
            $stmt = $this->conex->prepare("DELETE FROM TIPO_PERSONA_PERSONA WHERE COD_PERSONA = ?");
            $stmt->bind_param('i', $codPersona);
            $stmt->execute();
            $stmt->close();
        }

    }

?>