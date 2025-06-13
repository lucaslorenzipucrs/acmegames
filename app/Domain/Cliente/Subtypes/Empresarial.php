<?php

namespace App\Domain\Cliente\Subtypes;

use App\Domain\Cliente\Entities\Cliente;

class Empresarial extends Cliente
{
    public function __construct(
        int $numero,
        string $nome,
        string $endereco,
        public string $nomeFantasia,
        public string $cnpj
    ) {
        parent::__construct($numero, $nome, $endereco);
    }
}
