<?php

use PHPUnit\Framework\TestCase;
use App\Application\Cliente\Services\ValidarClienteService;
use App\Domain\Cliente\Contracts\ClienteRepositoryInterface;
use App\Domain\Cliente\Subtypes\Individual;

class ValidarClienteServiceTest extends TestCase
{
    public function testClienteExiste()
    {
        $cliente = new Individual(1, 'João', 'Rua A', '12345678900');

        $repo = $this->createMock(ClienteRepositoryInterface::class);
        $repo->expects($this->once())->method('buscarPorNumero')->with(1)->willReturn($cliente);

        $service = new ValidarClienteService($repo);

        $this->assertTrue($service->executar(1));
    }

    public function testClienteNaoExiste()
    {
        $repo = $this->createMock(ClienteRepositoryInterface::class);
        $repo->expects($this->once())->method('buscarPorNumero')->with(2)->willReturn(null);

        $service = new ValidarClienteService($repo);

        $this->assertFalse($service->executar(2));
    }

    protected function tearDown(): void
    {
        Mockery::close();
    }
}