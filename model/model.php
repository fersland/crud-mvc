<?php
    require_once ("class_cc.php");

    class GeneralModel {
        public static function enlacesPaginasModel($paginas){
            if ($paginas == "fail" ||
                $paginas == "inicio" ||
                $paginas == "edit" ||
                $paginas == "del" ||
                $paginas == "log"){
                
                $modulos = "view/modules/".$paginas.".php";

            }else if ($paginas == "index"){
                $modulos = "view/modules/log.php";
            }elseif($paginas == "ok") {
                $modulos = "view/modules/log.php";
            }else {
				$modulos = "view/modules/log.php";
			}

            return $modulos;
        }

        public static function guardarUsuarioModel($data, $table) {
            $repet = Conexion::conectarDB()->prepare("SELECT * FROM $table WHERE usuario=:uss AND estado = 1");
            $repet->bindParam(':uss', $data['usuario'], PDO::PARAM_STR);
            $repet->execute();
            $count = $repet->rowCount();

            if ($count == 0) {
                $estado = 1;
                $statement = Conexion::conectarDB()->prepare("INSERT INTO $table (usuario, passw, email, estado)
                                                            VALUES (:uss, :pass, :ema, :est)");
                $statement->bindParam(':uss',   $data['usuario'],   PDO::PARAM_STR);
                $statement->bindParam(':pass',  $data['password'],  PDO::PARAM_STR);
                $statement->bindParam(':ema',   $data['email'],     PDO::PARAM_STR);
                $statement->bindParam(':est',   $estado,            PDO::PARAM_INT);

                if($statement->execute()) {
                    return "success";
                }else{
                    return "error";
                }
            }else{
                return "repet";
            }

            $this->Conexion::cerrarDB();
        }

        public static function vistaUsuarioModel($table) {
            $statement = Conexion::conectarDB()->prepare("SELECT * FROM $table WHERE estado = 1");
            $statement->execute();
            return $fetch = $statement->fetchAll(PDO::FETCH_ASSOC);

            $this->Conexion::cerrarDB();
        }

        public static function editUsuariosModel($data, $table) {
            $statement = Conexion::conectarDB()->prepare("SELECT * FROM $table WHERE id=:id AND estado = 1");
            $statement->bindParam('id', $data, PDO::PARAM_INT);

            if ($statement->execute()){
                return $statement->fetch();
            }else{
                return "error";
            }

            $this->Conexion::cerrarDB();
        }

        public static function editarUsuariosModel($data, $table) {
            $password = sha1($data['passw']);

            $statement = Conexion::conectarDB()->prepare("UPDATE $table SET usuario=:uss, email=:ema, passw=:pass 
                                                            WHERE id=:id AND estado = 1");
            $statement->bindParam('uss', $data['usuario'], PDO::PARAM_STR);
            $statement->bindParam('ema', $data['email'], PDO::PARAM_STR);
            $statement->bindParam('pass', $password, PDO::PARAM_STR);
            $statement->bindParam('id', $data['id'], PDO::PARAM_INT);

            if ($statement->execute()){
                return "success";
            }else{
                return "error";
            }

            $this->Conexion::cerrarDB();
        }

        public static function delUsuariosModel($data, $table) {
            $statement = Conexion::conectarDB()->prepare("SELECT * FROM $table WHERE id = :id AND estado = 1");
            $statement->bindParam('id', $data, PDO::PARAM_INT);

            if ($statement->execute()) {
                return $statement->fetch();
            }else{
                return "error";
            }

            //$this->Conexion::cerrarDB();
        }

        public static function eliminarUsuariosModel($data, $table) {
            $statement = Conexion::conectarDB()->prepare("UPDATE $table SET estado = 2 WHERE id=:id");
            $statement->bindParam('id', $data, PDO::PARAM_INT);
            if ($statement->execute()) {
                return "success";
            }else{
                return "error";
            }

            //$this->Conexion::cerrarDB();
        }
    }