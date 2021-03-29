<?php 
//Azure
function db_connection() {
    try {
        $link = mysqli_connect("ingsoftware.mysql.database.azure.com", "ingsoftware@ingsoftware", "Q!1234567", "utp"); //Conexion a la base de datos
        $link -> set_charset("utf8");
    } catch (\Throwable $th) {
      $link = false;
    }

    return $link;
}

// pruebaa


 ?>