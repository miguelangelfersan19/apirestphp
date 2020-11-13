<?php 

class conexion{

       private $server;
       private $user;
       private $password;
       private $database;
       private $port;
       private $conexion;


   function __construct(){
      $listadatos = $this->datosConexion();
      foreach ($listadatos as $key =>$value){
    
      $this->server= $value ['server'];
      $this->user = $value ['user'];
      $this->password = $value ['password'];
      $this->database = $value ['database'];
      $this->port = $value ['port'];

       }
      $this->conexion = new mysqli($this->server, $this->user, $this->password, $this->database, $this->port);
      if($this->conexion->connect_errno){
          echo "Error en la conexion";
          die();
      }

   }

   private function datosConexion(){
    $direccion = dirname(__FILE__);
    $jsondata = file_get_contents($direccion. "/". "config");
    return json_decode($jsondata, true);
      }
 


     // convertir los datos del array en formato utf-8

     private  function convertirUTF8($array){
       array_walk_recursive($array, function($item,$key){
        if(!mb_detect_encoding($item,`utf-8`,true)){
            $item=utf8_decode($item);
        }
    });
       return $array;
}


//obtener registros de la base de datos

public function obtenerDatos($sqlstr){
    $results = $this->conexion->query($sqlstr);
    $resultArray = array();
    foreach ($result as $key){
        $resultArray[]=$key;
    }
   return $this->convertirUTF8($resultArray);
}

//nos devuelve las filas afectadas por el insert
public function nomQuery($sqlstr){
    $results = $this->conexion->query($sqlstr);
    return $this->conexion->affected_rows;
  
}

//insertar nos devulve el ultimo id
public function nomQueryId($sqlstr){
    $results = $this->conexion->query($sqlstr);
    $filas = $this->conexion->affected_rows;
    if ($filas>=1) {
        return $this->conexion->insert_id;
    }else{
        return 0;
    }
}




}


?>