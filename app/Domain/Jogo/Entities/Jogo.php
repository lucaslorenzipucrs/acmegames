<?php

namespace App\Domain\Jogo\Entities;

abstract class Jogo
{
    public function __construct(
        public int $codigo,
        public string $nome,
        public float $valorBase
    ) {}
}
