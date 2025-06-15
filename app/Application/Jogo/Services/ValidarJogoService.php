<?php

namespace App\Application\Jogo\Services;

use App\Domain\Jogo\Contracts\JogoRepositoryInterface;

class ValidarJogoService
{
    public function __construct(
        private JogoRepositoryInterface $jogoRepository
    ) {}

    public function executar(int $codigo): bool
    {
        $jogo = $this->jogoRepository->buscarPorCodigo($codigo);
        return $jogo !== null;
    }
}
