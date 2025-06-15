<?php

use PHPUnit\Framework\TestCase;
use App\Application\Aluguel\Services\CalcularValorAluguelService;
use App\Domain\Jogo\Contracts\JogoRepositoryInterface;
use App\Domain\Jogo\Subtypes\JogoEletronico;
use App\Domain\Jogo\Subtypes\JogoMesa;
use App\Domain\Jogo\Enums\TipoEletronico;
use App\Domain\Jogo\Enums\TipoMesa;

class CalcularValorAluguelServiceTest extends TestCase
{
    public function testCalcularValorJogoEletronicoAventura()
    {
        $jogo = new JogoEletronico(1, 'FIFA', 100, TipoEletronico::AVENTURA, 'PS5');

        $repo = $this->createMock(JogoRepositoryInterface::class);
        $repo->expects($this->once())->method('buscarPorCodigo')->with(1)->willReturn($jogo);

        $service = new CalcularValorAluguelService($repo);

        $this->assertEquals(105.0, $service->executar(1));
    }

    public function testCalcularValorJogoMesaTabuleiro()
    {
        $jogo = new JogoMesa(2, 'Xadrez', 10, TipoMesa::TABULEIRO, 50);

        $repo = $this->createMock(JogoRepositoryInterface::class);
        $repo->expects($this->once())->method('buscarPorCodigo')->with(2)->willReturn($jogo);

        $service = new CalcularValorAluguelService($repo);

        $this->assertEquals(500.0, $service->executar(2));
    }

    protected function tearDown(): void
    {
        Mockery::close();
    }
}