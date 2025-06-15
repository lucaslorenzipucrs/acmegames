<?php

use PHPUnit\Framework\TestCase;
use App\Application\Aluguel\Services\CalcularValorFinalAluguelService;
use App\Application\Aluguel\Services\CalcularValorAluguelService;
use App\Domain\Aluguel\Contracts\AluguelRepositoryInterface;
use App\Domain\Aluguel\Entities\Aluguel;
use App\Domain\Cliente\Subtypes\Individual;
use App\Domain\Cliente\Subtypes\Empresarial;
use App\Domain\Jogo\Subtypes\JogoEletronico;
use App\Domain\Jogo\Subtypes\JogoMesa;
use App\Domain\Jogo\Enums\TipoEletronico;
use App\Domain\Jogo\Enums\TipoMesa;
use Carbon\Carbon;

class CalcularValorFinalAluguelServiceTest extends TestCase
{
    public function testCalculaValorFinalParaIndividualMenosDe7Dias()
    {
        $cliente = new Individual(1, 'João', 'Rua A', '12345678900');
        $jogo = new JogoEletronico(2, 'FIFA', 100, TipoEletronico::AVENTURA, 'PS5');
        $aluguel = new Aluguel(1001, Carbon::parse('2025-06-15'), 5, $cliente, $jogo);

        $repo = $this->createMock(AluguelRepositoryInterface::class);
        $repo->expects($this->once())->method('buscarPorIdentificador')->with(1001)->willReturn($aluguel);

        $calcValorJogo = $this->createMock(CalcularValorAluguelService::class);
        $calcValorJogo->expects($this->once())->method('executar')->with(2)->willReturn(105.0);

        $service = new CalcularValorFinalAluguelService($repo, $calcValorJogo);

        $resultado = $service->executar(1001);

        $this->assertEquals(105.0 * 5 * 0.9, $resultado);
    }

    protected function tearDown(): void
    {
        Mockery::close();
    }
}