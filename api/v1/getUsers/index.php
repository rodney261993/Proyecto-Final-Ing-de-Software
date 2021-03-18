<?php

// API que obtiene info de paginas la pagina principal del portal


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Accept");
header("Access-Control-Expose-Headers: *");
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Methods:GET");

// Verificamos que el request se exclusicamente GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $Authorization = null;
    $Authorization_Saved = "3d524a53c110e4c22463b10ed32cef9d";
    //buscamos las variables que pasamos por header en el cliente
    foreach (getallheaders() as $variable => $valor) 
    {

        if($variable == "Authorizationtoken")
        {
            $Authorization = $valor;
        }
    }
    
    if ($Authorization != null && $id_cliente != null)
        {
            if($Authorization === $Authorization_Saved)
            {
                peticion_GET($id_cliente);
            } else {
                http_response_code(401);
                $respuesta = array(
                    "domain" => "https://www.rednbluepty.com/",
                    "status" => "Authorization Error", 
                    "description" => "No tienes autirización para acceder a esta información"
                );
                print(json_encode($respuesta, JSON_PRETTY_PRINT)); 
            }
         
        } else {
            http_response_code(400);
            $respuesta = array(
                "status" => "error",
                "description" => "parametros no encontrados" );
            print(json_encode($respuesta, JSON_PRETTY_PRINT));
        }
       
} else {
    http_response_code(400);
}





function peticion_GET($id_cliente)
{   
    require_once __DIR__ . "/../../../functions/api/infoPaginaPrincipal.php";
    $arrayInfoPaginaPrincipal = infoPaginaPrincipal($id_cliente);

            http_response_code(200);
            $respuesta = array(
                "domain" => "https://www.rednbluepty.com/",
                "status code" => 200,
                "data" => $arrayInfoPaginaPrincipal
            );


print(json_encode($respuesta, JSON_PRETTY_PRINT));
}
