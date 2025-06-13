<?php

namespace App\Domain\Aluguel\Contracts;

use App\Domain\Aluguel\Entities\Aluguel;

interface AluguelRepositoryInterface
{
    public function salvar(Aluguel $aluguel): void;
}
