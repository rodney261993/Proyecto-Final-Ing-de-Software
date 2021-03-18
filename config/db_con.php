<?php 
//LOCAL HOST
// $link = mysqli_connect("127.0.0.1:3306", "root", "", "Portal"); //Conexion a la base de datos

//AWS
function db_connection() {
    try {
        $link = mysqli_connect("ip", "username", "password", "database"); //Conexion a la base de datos
        $link -> set_charset("utf8");
    } catch (\Throwable $th) {
      $link = false;
    }

    return $link;
}


 ?>