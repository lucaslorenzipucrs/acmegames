<?php

namespace App\Application\Cliente\Services;

use App\Domain\Cliente\Contracts\ClienteRepositoryInterface;
use App\Domain\Cliente\Subtypes\Individual;
use App\Domain\Cliente\Subtypes\Empresarial;
use InvalidArgumentException;

class CadastrarClienteService
{
    public function __construct(
        private ClienteRepositoryInterface $clienteRepository
    ) {}

    public function executar(array $dados): void
    {
        // Verificar se o número já existe
        $existe = $this->clienteRepository->buscarPorNumero($dados['numero']);
        if ($existe) {
            throw new InvalidArgumentException("Já existe um cliente com este número.");
        }

        // Criar o tipo de cliente correto
        if ($dados['tipo'] === 'individual') {
            $cliente = new Individual(
                numero: $dados['numero'],
                nome: $dados['nome'],
                endereco: $dados['endereco'],
                cpf: $dados['cpf']
            );
        } elseif ($dados['tipo'] === 'empresarial') {
            $cliente = new Empresarial(
                numero: $dados['numero'],
                nome: $dados['nome'],
                endereco: $dados['endereco'],
                nomeFantasia: $dados['nomeFantasia'],
                cnpj: $dados['cnpj']
            );
        } else {
            throw new InvalidArgumentException("Tipo de cliente inválido.");
        }

        // Persistir
        $this->clienteRepository->salvar($cliente);
    }
}