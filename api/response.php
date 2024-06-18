<?php
class Response{
    public static function resposta($status=200, $message='sucesso', $data=null){
        header('Content-Type: application/json');

        if(!API_IS_ACTIVE){
            return json_encode([
                'status' => 400,
                'mensagem' => 'API não está funcionando',
                'api_version' => API_VERSION,
                'time_response' => time(),
                'datetime_response' => date('Y-m-d H:i:s'),
                'dados' => null
            ], JSON_PRETTY_PRINT);
        }

        return json_encode([
            'status' => $status,
            'mensagem' => $message,
            'api_version' => API_VERSION,
            'time_response' => time(),
            'datetime_response' => date('Y-m-d H:i:s'),
            'dados' => $data
        ], JSON_PRETTY_PRINT);
    }
}

?>