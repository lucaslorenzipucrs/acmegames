<?php

namespace App\Domain\Jogo\Enums;

enum TipoEletronico: string
{
    case AVENTURA = 'AVENTURA';
    case ESTRATEGIA = 'ESTRATEGIA';
    case SIMULACAO = 'SIMULACAO';
}
