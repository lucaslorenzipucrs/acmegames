<?php

namespace App\Application\Cliente\Services;

use App\Domain\Cliente\Contracts\ClienteRepositoryInterface;

class ValidarClienteService
{
    public function __construct(
        private ClienteRepositoryInterface $clienteRepository
    ) {}

    public function executar(int $numero): bool
    {
        $cliente = $this->clienteRepository->buscarPorNumero($numero);
        return $cliente !== null;
    }
}