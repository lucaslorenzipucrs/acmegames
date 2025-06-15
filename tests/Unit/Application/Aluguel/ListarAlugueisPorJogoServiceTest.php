<?php

use PHPUnit\Framework\TestCase;
use App\Application\Aluguel\Services\ListarAlugueisPorJogoService;
use App\Domain\Aluguel\Contracts\AluguelRepositoryInterface;
use App\Domain\Aluguel\Entities\Aluguel;
use App\Domain\Cliente\Subtypes\Individual;
use App\Domain\Jogo\Subtypes\JogoMesa;
use App\Domain\Jogo\Enums\TipoMesa;
use Carbon\Carbon;

class ListarAlugueisPorJogoServiceTest extends TestCase
{
    public function testListaAlugueisPorJogoComSucesso()
    {
        $cliente = new Individual(1, 'João', 'Rua A', '12345678900');
        $jogo = new JogoMesa(2, 'Xadrez', 10, TipoMesa::TABULEIRO, 50);
        $aluguel = new Aluguel(1001, Carbon::parse('2025-06-15'), 5, $cliente, $jogo);

        $repo = $this->createMock(AluguelRepositoryInterface::class);
        $repo->expects($this->once())->method('listarPorJogo')->with(2)->willReturn([$aluguel]);

        $service = new ListarAlugueisPorJogoService($repo);

        $resultado = $service->executar(2);

        $this->assertIsArray($resultado);
        $this->assertCount(1, $resultado);
        $this->assertInstanceOf(Aluguel::class, $resultado[0]);
        $this->assertEquals(1001, $resultado[0]->identificador);
    }

    protected function tearDown(): void
    {
        Mockery::close();
    }
}