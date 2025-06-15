<?php

namespace App\Application\Jogo\Services;

use App\Domain\Jogo\Contracts\JogoRepositoryInterface;
use App\Domain\Jogo\Entities\Jogo;

class ListarJogosService
{
    public function __construct(
        private JogoRepositoryInterface $jogoRepository
    ) {}

    /**
     * @return Jogo[]
     */
    public function executar(): array
    {
        return $this->jogoRepository->listarTodos();
    }
}