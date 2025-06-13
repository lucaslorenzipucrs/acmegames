<?php

namespace App\Domain\Jogo\Subtypes;

use App\Domain\Jogo\Entities\Jogo;
use App\Domain\Jogo\Enums\TipoMesa;

class JogoMesa extends Jogo
{
    public function __construct(
        int $codigo,
        string $nome,
        float $valorBase,
        public TipoMesa $tipo,
        public int $numeroPecas
    ) {
        parent::__construct($codigo, $nome, $valorBase);
    }
}
