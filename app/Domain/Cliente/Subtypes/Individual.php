<?php

namespace App\Domain\Cliente\Subtypes;

use App\Domain\Cliente\Entities\Cliente;

class Individual extends Cliente
{
    public function __construct(
        int $numero,
        string $nome,
        string $endereco,
        public string $cpf
    ) {
        parent::__construct($numero, $nome, $endereco);
    }
}
