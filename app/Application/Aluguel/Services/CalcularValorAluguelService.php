<?php

namespace App\Application\Aluguel\Services;

use App\Domain\Jogo\Contracts\JogoRepositoryInterface;
use App\Domain\Jogo\Subtypes\JogoEletronico;
use App\Domain\Jogo\Subtypes\JogoMesa;
use App\Domain\Jogo\Enums\TipoEletronico;
use App\Domain\Jogo\Enums\TipoMesa;
use InvalidArgumentException;

class CalcularValorAluguelService
{
    public function __construct(
        private JogoRepositoryInterface $jogoRepository
    ) {}

    public function executar(int $codigoJogo): float
    {
        $jogo = $this->jogoRepository->buscarPorCodigo($codigoJogo);

        if (!$jogo) {
            throw new InvalidArgumentException("Jogo não encontrado.");
        }

        if ($jogo instanceof JogoEletronico) {
            $percentual = match ($jogo->tipo) {
                TipoEletronico::AVENTURA => 0.05,
                TipoEletronico::ESTRATEGIA => 0.15,
                TipoEletronico::SIMULACAO => 0.25,
            };

            return $jogo->valorBase + ($jogo->valorBase * $percentual);
        }

        if ($jogo instanceof JogoMesa) {
            if ($jogo->tipo === TipoMesa::TABULEIRO) {
                return $jogo->valorBase * $jogo->numeroPecas;
            } elseif ($jogo->tipo === TipoMesa::CARTA) {
                return $jogo->valorBase * 1.2;
            }
        }

        throw new InvalidArgumentException("Tipo de jogo inválido.");
    }
}