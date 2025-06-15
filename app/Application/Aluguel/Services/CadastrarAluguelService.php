<?php

namespace App\Application\Aluguel\Services;

use App\Domain\Aluguel\Contracts\AluguelRepositoryInterface;
use App\Domain\Cliente\Contracts\ClienteRepositoryInterface;
use App\Domain\Jogo\Contracts\JogoRepositoryInterface;
use App\Domain\Aluguel\Entities\Aluguel;
use Carbon\Carbon;
use InvalidArgumentException;

class CadastrarAluguelService
{
    public function __construct(
        private AluguelRepositoryInterface $aluguelRepository,
        private ClienteRepositoryInterface $clienteRepository,
        private JogoRepositoryInterface $jogoRepository
    ) {}

    public function executar(array $dados): void
    {
        // Verificar se identificador já existe
        $existe = $this->aluguelRepository->buscarPorIdentificador($dados['identificador']);
        if ($existe) {
            throw new InvalidArgumentException("Já existe um aluguel com este identificador.");
        }

        // Validar cliente
        $cliente = $this->clienteRepository->buscarPorNumero($dados['numeroCliente']);
        if (!$cliente) {
            throw new InvalidArgumentException("Cliente não encontrado.");
        }

        // Validar jogo
        $jogo = $this->jogoRepository->buscarPorCodigo($dados['codigoJogo']);
        if (!$jogo) {
            throw new InvalidArgumentException("Jogo não encontrado.");
        }

        // Criar aluguel
        $aluguel = new Aluguel(
            identificador: $dados['identificador'],
            dataInicial: Carbon::parse($dados['dataInicial']),
            periodo: $dados['periodo'],
            cliente: $cliente,
            jogo: $jogo
        );

        // Persistir
        $this->aluguelRepository->salvar($aluguel);
    }
}