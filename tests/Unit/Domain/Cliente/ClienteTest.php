<?php

use PHPUnit\Framework\TestCase;
use App\Domain\Cliente\Subtypes\Individual;
use App\Domain\Cliente\Subtypes\Empresarial;

class ClienteTest extends TestCase
{
    public function testCriarClienteIndividual()
    {
        $cliente = new Individual(1, 'João', 'Rua A', '12345678900');
        $this->assertEquals(1, $cliente->numero);
        $this->assertEquals('João', $cliente->nome);
        $this->assertEquals('Rua A', $cliente->endereco);
        $this->assertEquals('12345678900', $cliente->cpf);
    }

    public function testCriarClienteEmpresarial()
    {
        $cliente = new Empresarial(2, 'Empresa XYZ', 'Rua B', 'XYZ LTDA', '11222333444455');
        $this->assertEquals(2, $cliente->numero);
        $this->assertEquals('Empresa XYZ', $cliente->nome);
        $this->assertEquals('Rua B', $cliente->endereco);
        $this->assertEquals('XYZ LTDA', $cliente->nomeFantasia);
        $this->assertEquals('11222333444455', $cliente->cnpj);
    }
}
