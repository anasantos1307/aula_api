<?php
    require_once __DIR__ . '/../../api/config.php';
    require_once __DIR__ . '/../../api/response.php';

//    if(API_IS_ACTIVE){
//        echo Response::resposta(200, 'sucesso', [
//            'versao_api' => API_VERSION,
//            'status' => 'ativa'
//        ]);
//    }else{
//        echo Response::resposta(200, 'sucesso', [
//            'versao_api' => API_VERSION,
//            'status' => 'manutenção'
//        ]);
//    }

//    echo Response::resposta(200, 'sucesso',[
//        'version' => API_VERSION,
//        'status' => 'manutenção'
//    ]);

    echo Response::resposta(200, 'API está funcionando!');
?>