<?php

namespace App\Domain\Cliente\Entities;

abstract class Cliente
{
    public function __construct(
        public int $numero,
        public string $nome,
        public string $endereco
    ) {}
}
