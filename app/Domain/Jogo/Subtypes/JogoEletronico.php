<?php

namespace App\Domain\Jogo\Subtypes;

use App\Domain\Jogo\Entities\Jogo;
use App\Domain\Jogo\Enums\TipoEletronico;

class JogoEletronico extends Jogo
{
    public function __construct(
        int $codigo,
        string $nome,
        float $valorBase,
        public TipoEletronico $tipo,
        public string $plataforma
    ) {
        parent::__construct($codigo, $nome, $valorBase);
    }
}
