<?php

namespace App\Application\Cliente\Services;

use App\Domain\Cliente\Contracts\ClienteRepositoryInterface;
use App\Domain\Cliente\Entities\Cliente;

class ListarClientesService
{
    public function __construct(
        private ClienteRepositoryInterface $clienteRepository
    ) {}

    /**
     * @return Cliente[]
     */
    public function executar(): array
    {
        return $this->clienteRepository->listarTodos();
    }
}