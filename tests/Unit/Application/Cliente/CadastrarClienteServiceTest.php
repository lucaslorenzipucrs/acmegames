<?php

use PHPUnit\Framework\TestCase;
use App\Application\Cliente\Services\CadastrarClienteService;
use App\Domain\Cliente\Contracts\ClienteRepositoryInterface;

class CadastrarClienteServiceTest extends TestCase
{
    public function testCadastrarClienteIndividualComSucesso()
    {
        $repo = $this->createMock(ClienteRepositoryInterface::class);
        $repo->expects($this->once())->method('buscarPorNumero')->with(1)->willReturn(null);
        $repo->expects($this->once())->method('salvar');

        $service = new CadastrarClienteService($repo);

        $service->executar([
            'numero' => 1,
            'nome' => 'João',
            'endereco' => 'Rua A',
            'tipo' => 'individual',
            'cpf' => '12345678900'
        ]);

        $this->assertTrue(true);
    }

    protected function tearDown(): void
    {
        Mockery::close();
    }
}