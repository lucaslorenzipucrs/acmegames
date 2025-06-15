<?php

namespace App\Domain\Cliente\Contracts;

use App\Domain\Cliente\Entities\Cliente;

interface ClienteRepositoryInterface
{
    public function salvar(Cliente $cliente): void;
    public function buscarPorNumero(int $numero): ?Cliente;
    public function listarTodos(): array;
}
