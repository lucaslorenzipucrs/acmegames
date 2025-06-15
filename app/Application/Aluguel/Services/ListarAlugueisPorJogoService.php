<?php

namespace App\Application\Aluguel\Services;

use App\Domain\Aluguel\Contracts\AluguelRepositoryInterface;
use App\Domain\Aluguel\Entities\Aluguel;

class ListarAlugueisPorJogoService
{
    public function __construct(
        private AluguelRepositoryInterface $aluguelRepository
    ) {}

    /**
     * @return Aluguel[]
     */
    public function executar(int $codigoJogo): array
    {
        return $this->aluguelRepository->listarPorJogo($codigoJogo);
    }
}