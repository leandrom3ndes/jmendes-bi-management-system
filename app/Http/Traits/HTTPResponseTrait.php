<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 03/07/2018
 * Time: 15:42
 */

namespace App\Http\Traits;

use Response;


trait HTTPResponseTrait
{
    private $returnStatusSuccess = 200;
    private $returnStatusError = 400;
    private $returnData = array();

    public function successResponse($outputOption = 1, $message = null) {
        switch ($outputOption) {
            case 1: //mensagem por default
                $returnData = array(
                    'message' => trans('http_messages.success')
                );
                break;
            case 2: //mensagem customizada
                $returnData = array(
                    'message' => $message
                );
                break;
            case 3: //mensagem por default e dados customizados
                $returnData = array(
                    'message' => trans('http_messages.success'),
                    'data' => $message
                );
                break;
        }

        return Response::json($returnData, $this->returnStatusSuccess);
    }

    public function errorResponse($outputOption = 1, $message = null) {
        switch ($outputOption) {
            case 1: //mensagem por default
                $returnData = array(
                    'message' => trans('http_messages.error')
                );
            break;
            case 2: //mensagem customizada
                $returnData = array(
                    'message' => $message
                );
            break;
            case 3: //mensagem por default e erro fornecido pelo laravel - melhor para testes uma vez que retorna informações especificas do erro
                $returnData = array(
                    'message' => trans('http_messages.error'),
                    'error' => $message
                );
            break;
        }

        return Response::json($returnData, $this->returnStatusError);
    }
}