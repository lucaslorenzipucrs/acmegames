<?php

namespace App\Domain\Aluguel\Contracts;

use App\Domain\Aluguel\Entities\Aluguel;

interface AluguelRepositoryInterface
{
    public function salvar(Aluguel $aluguel): void;
    public function buscarPorIdentificador(int $identificador): ?Aluguel;
    public function listarTodos(): array;
    public function listarPorCliente(int $numeroCliente): array;
    public function listarPorJogo(int $codigoJogo): array;
}
