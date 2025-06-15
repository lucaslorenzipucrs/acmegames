<?php

namespace App\Application\Aluguel\Services;

use App\Domain\Aluguel\Contracts\AluguelRepositoryInterface;
use App\Domain\Cliente\Subtypes\Individual;
use App\Domain\Cliente\Subtypes\Empresarial;
use App\Domain\Jogo\Subtypes\JogoEletronico;
use App\Domain\Jogo\Subtypes\JogoMesa;
use InvalidArgumentException;

class CalcularValorFinalAluguelService
{
    public function __construct(
        private AluguelRepositoryInterface $aluguelRepository,
        private CalcularValorAluguelService $calcularValorAluguelService
    ) {}

    public function executar(int $identificador): float
    {
        $aluguel = $this->aluguelRepository->buscarPorIdentificador($identificador);

        if (!$aluguel) {
            throw new InvalidArgumentException("Aluguel não encontrado.");
        }

        //Calcula o valor base do jogo
        $valorJogo = $this->calcularValorAluguelService->executar($aluguel->jogo->codigo);

        //Aplica o período
        $valor = $valorJogo * $aluguel->periodo;

        //Aplica desconto conforme tipo de cliente
        $cliente = $aluguel->cliente;
        $jogo = $aluguel->jogo;

        if ($cliente instanceof Individual) {
            if ($aluguel->periodo < 7) {
                $valor *= 0.9;
            } elseif ($aluguel->periodo >=7 && $aluguel->periodo <= 14) {
                $valor *= 0.8;
            } else {
                $valor *= 0.75;
            }
        } elseif ($cliente instanceof Empresarial) {
            if ($jogo instanceof JogoEletronico) {
                $valor == $valor; // Sem desconto
            } elseif ($jogo instanceof JogoMesa) {
                $valor *= 0.85;
            } else {
                throw new InvalidArgumentException("Tipo de jogo inválido.");
            }
        } else {
            throw new InvalidArgumentException("Tipo de cliente inválido.");
        }

        return $valor;
    }
}