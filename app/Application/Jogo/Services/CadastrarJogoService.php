<?php

namespace App\Application\Jogo\Services;

use App\Domain\Jogo\Contracts\JogoRepositoryInterface;
use App\Domain\Jogo\Entities\Jogo;
use App\Domain\Jogo\Subtypes\JogoEletronico;
use App\Domain\Jogo\Subtypes\JogoMesa;
use App\Domain\Jogo\Enums\TipoEletronico;
use App\Domain\Jogo\Enums\TipoMesa;
use InvalidArgumentException;

class CadastrarJogoService
{
    public function __construct(
        private JogoRepositoryInterface $jogoRepository
    ) {}

    public function executar(array $dados): void
    {
        // Verificar se o código já existe
        $existe = $this->jogoRepository->buscarPorCodigo($dados['codigo']);
        if ($existe) {
            throw new InvalidArgumentException("Já existe um jogo com este código.");
        }

        // Verificar tipo do jogo e criar a instância correta
        if ($dados['tipo'] === 'eletronico') {
            $jogo = new JogoEletronico(
                codigo: $dados['codigo'],
                nome: $dados['nome'],
                valorBase: $dados['valorBase'],
                tipo: TipoEletronico::from($dados['categoria']),
                plataforma: $dados['plataforma']
            );
        } elseif ($dados['tipo'] === 'mesa') {
            $jogo = new JogoMesa(
                codigo: $dados['codigo'],
                nome: $dados['nome'],
                valorBase: $dados['valorBase'],
                tipo: TipoMesa::from($dados['categoria']),
                numeroPecas: $dados['numeroPecas']
            );
        } else {
            throw new InvalidArgumentException("Tipo de jogo inválido.");
        }

        // Persistir o jogo
        $this->jogoRepository->salvar($jogo);
    }
}