<?php

namespace App\Application\Aluguel\Services;

use App\Domain\Aluguel\Contracts\AluguelRepositoryInterface;
use App\Domain\Aluguel\Entities\Aluguel;

class ListarAlugueisService
{
    public function __construct(
        private AluguelRepositoryInterface $aluguelRepository
    ) {}

    /**
     * @return Aluguel[]
     */
    public function executar(): array
    {
        return $this->aluguelRepository->listarTodos();
    }
}