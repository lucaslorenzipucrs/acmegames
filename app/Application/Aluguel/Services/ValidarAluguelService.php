<?php

namespace App\Application\Aluguel\Services;

use App\Domain\Aluguel\Contracts\AluguelRepositoryInterface;

class ValidarAluguelService
{
    public function __construct(
        private AluguelRepositoryInterface $aluguelRepository
    ) {}

    public function executar(int $identificador): bool
    {
        $aluguel = $this->aluguelRepository->buscarPorIdentificador($identificador);
        return $aluguel !== null;
    }
}