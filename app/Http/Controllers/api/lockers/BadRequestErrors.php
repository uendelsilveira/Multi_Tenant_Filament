<?php

namespace App\Http\Controllers\api\lockers;

class BadRequestErrors
{
    const INVALID_LOCKER = 'ARMARIO_INVALIDO'; // Armário não localizado
    const NOT_CONFIGURED_LOCKER = 'ARMARIO_NAO_CONFIGURADO'; // Aguardando o armário enviar suas configurações
    const UNAUTHORIZED_DELIVERY = 'ERRO_ENTREGA_NAO_AUTORIZADA'; // Entrega não autorizada, chave inválida
    const INVALID_DOOR = 'PORTA_INVALIDA';
    const INVALID_REQUEST = 'REQUISICAO_INVALIDA';
}
