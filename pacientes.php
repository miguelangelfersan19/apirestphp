
<?php

require_once 'clases/respuestas.class.php';
require_once 'clases/pacientes.class.php';

$_respuestas = new respuestas;
$_pacientes = new pacientes;

if ($_SERVER['REQUEST_METHOD'] == "GET") {

    if (isset($_GET["page"])){
        $pagina = $_GET["page"];
        header("Content-type: application/json");
        $listaPacientes= $_pacientes->listaPacientes($pagina);
        echo json_encode($listaPacientes);
        http_response_code(200);

    } else if(isset($_GET['id'])){
        $pacienteid = $_GET['id'];
        header("Content-type: application/json");
        $datosPaciente  = $_pacientes->obtenerPaciente($pacienteid);
        echo json_encode($datosPaciente);
        http_response_code(200);
    }
   

     } else if ($_SERVER['REQUEST_METHOD'] == "POST"){
      // se reciben los datos enviados
         $postBody = file_get_contents("php://input"); // se envian los datos al manejador
         $datosArray = $_pacientes->post($postBody);
         

          header('Content-Type: application/json');
         if(isset($datosArray["result"]["error_id"])){
            $responseCode = $datosArray["result"]["error_id"];
            http_response_code($responseCode);
          }else{
           http_response_code(200);
          }
           echo json_encode($datosArray);



     }else if ($_SERVER['REQUEST_METHOD']== "PUT"){
    
        $postBody = file_get_contents("php://input");
        $datosArray = $_pacientes->put($postBody);
        // se devuelve la respuesta
          header('Content-Type: application/json');
         if(isset($datosArray["result"]["error_id"])){
           $responseCode = $datosArray["result"]["error_id"];
           http_response_code($responseCode);
           }else{
            http_response_code(200);
         }
         echo json_encode($datosArray);



     }else if ($_SERVER['REQUEST_METHOD']== "DELETE"){
     

        $postBody = file_get_contents("php://input");// recibimos los datos y la guardamos en la variable postBody
        $datosArray = $_pacientes->delete($postBody);
        // se devuelve la respuesta
        
          header('Content-Type: application/json');
         if(isset($datosArray["result"]["error_id"])){
           $responseCode = $datosArray["result"]["error_id"];
           http_response_code($responseCode);
           }else{
            http_response_code(200);
         }
         echo json_encode($datosArray); 


     }else{
     header('content-Type application/json');
     $datosArray = $_respuestas->error_405;
     echo json_encode($datosArray);
}


?>

