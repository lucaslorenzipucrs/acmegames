<?php

use PHPUnit\Framework\TestCase;
use App\Application\Cliente\Services\ListarClientesService;
use App\Domain\Cliente\Contracts\ClienteRepositoryInterface;
use App\Domain\Cliente\Subtypes\Individual;

class ListarClientesServiceTest extends TestCase
{
    public function testListaClientesComSucesso()
    {
        $cliente = new Individual(1, 'João', 'Rua A', '12345678900');

        $repo = $this->createMock(ClienteRepositoryInterface::class);
        $repo->expects($this->once())->method('listarTodos')->willReturn([$cliente]);

        $service = new ListarClientesService($repo);

        $resultado = $service->executar();

        $this->assertIsArray($resultado);
        $this->assertCount(1, $resultado);
        $this->assertInstanceOf(Individual::class, $resultado[0]);
        $this->assertEquals('João', $resultado[0]->nome);
    }

    protected function tearDown(): void
    {
        Mockery::close();
    }
}