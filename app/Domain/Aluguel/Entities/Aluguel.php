<?php

namespace App\Domain\Aluguel\Entities;

use App\Domain\Cliente\Entities\Cliente;
use App\Domain\Jogo\Entities\Jogo;
use Carbon\Carbon;

class Aluguel
{
    public function __construct(
        public string $identificador,
        public Carbon $dataInicial,
        public int $periodo,
        public Cliente $cliente,
        public Jogo $jogo
    ) {}
}
