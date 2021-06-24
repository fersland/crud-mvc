<?php

    class Conexion {
        public static function conectarDB(){
            try{
                $db = new PDO('mysql:host=localhost;dbname=prueba','root','',            
                                array(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION));
            }catch(Exception $e) {
                echo 'Hubo un problema al conectar'. $e->getMessage();
            }

            return $db;
        } 

        public static function cerrarDB() {
            return $db->close();
        }
    }