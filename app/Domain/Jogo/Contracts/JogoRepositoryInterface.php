<?php

namespace App\Domain\Jogo\Contracts;

use App\Domain\Jogo\Entities\Jogo;

interface JogoRepositoryInterface
{
    public function salvar(Jogo $jogo): void;
}
