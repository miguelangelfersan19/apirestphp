<?php


class respuesta {

    private $response =[
        'status'=>"ok",
        "result" = array()
           
    ];

    public function error_405(){
        $this->response['status']="error";
        $this->response['result']=array(
            "error_id" =>"405",
            "error_msg" => "metodo no espesificado"

        );
        return $response;
    }


    public function error_200($valor ="Datos incorrectos"){
        $this->response['status']="error";
        $this->response['result']=array(
            "error_id" =>"200",
            "error_msg" => $valor

        );
        return $response;
    }

    public function error_400(){
        $this->response['status']="error";
        $this->response['result']=array(
            "error_id" =>"400",
            "error_msg" => "Datos enviados incompletos o de forma incorrecta"
        );
        return $response;
    }


    }


?>