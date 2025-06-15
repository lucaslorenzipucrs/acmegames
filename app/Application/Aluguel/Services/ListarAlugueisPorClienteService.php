<?php

namespace App\Application\Aluguel\Services;

use App\Domain\Aluguel\Contracts\AluguelRepositoryInterface;
use App\Domain\Aluguel\Entities\Aluguel;

class ListarAlugueisPorClienteService
{
    public function __construct(
        private AluguelRepositoryInterface $aluguelRepository
    ) {}

    /**
     * @return Aluguel[]
     */
    public function executar(int $numeroCliente): array
    {
        return $this->aluguelRepository->listarPorCliente($numeroCliente);
    }
}