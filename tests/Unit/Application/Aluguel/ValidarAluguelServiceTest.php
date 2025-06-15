<?php

use PHPUnit\Framework\TestCase;
use App\Application\Aluguel\Services\ValidarAluguelService;
use App\Domain\Aluguel\Contracts\AluguelRepositoryInterface;
use App\Domain\Aluguel\Entities\Aluguel;
use App\Domain\Cliente\Subtypes\Individual;
use App\Domain\Jogo\Subtypes\JogoMesa;
use App\Domain\Jogo\Enums\TipoMesa;
use Carbon\Carbon;

class ValidarAluguelServiceTest extends TestCase
{
    public function testAluguelExiste()
    {
        $cliente = new Individual(1, 'João', 'Rua A', '12345678900');
        $jogo = new JogoMesa(2, 'Xadrez', 10, TipoMesa::TABULEIRO, 50);
        $aluguel = new Aluguel(1001, Carbon::parse('2025-06-15'), 5, $cliente, $jogo);

        $repo = $this->createMock(AluguelRepositoryInterface::class);
        $repo->expects($this->once())->method('buscarPorIdentificador')->with(1001)->willReturn($aluguel);

        $service = new ValidarAluguelService($repo);

        $this->assertTrue($service->executar(1001));
    }

    public function testAluguelNaoExiste()
    {
        $repo = $this->createMock(AluguelRepositoryInterface::class);
        $repo->expects($this->once())->method('buscarPorIdentificador')->with(1002)->willReturn(null);

        $service = new ValidarAluguelService($repo);

        $this->assertFalse($service->executar(1002));
    }

    protected function tearDown(): void
    {
        Mockery::close();
    }
}