<?php

use PHPUnit\Framework\TestCase;
use App\Application\Aluguel\Services\CadastrarAluguelService;
use App\Domain\Aluguel\Contracts\AluguelRepositoryInterface;
use App\Domain\Cliente\Contracts\ClienteRepositoryInterface;
use App\Domain\Jogo\Contracts\JogoRepositoryInterface;
use App\Domain\Cliente\Subtypes\Individual;
use App\Domain\Jogo\Subtypes\JogoMesa;
use App\Domain\Jogo\Enums\TipoMesa;

class CadastrarAluguelServiceTest extends TestCase
{
    public function testCadastrarAluguelComSucesso()
    {
        $cliente = new Individual(1, 'João', 'Rua A', '12345678900');
        $jogo = new JogoMesa(2, 'Xadrez', 10, TipoMesa::TABULEIRO, 50);

        $repoAluguel = $this->createMock(AluguelRepositoryInterface::class);
        $repoAluguel->expects($this->once())->method('buscarPorIdentificador')->with(1001)->willReturn(null);
        $repoAluguel->expects($this->once())->method('salvar');

        $repoCliente = $this->createMock(ClienteRepositoryInterface::class);
        $repoCliente->expects($this->once())->method('buscarPorNumero')->with(1)->willReturn($cliente);

        $repoJogo = $this->createMock(JogoRepositoryInterface::class);
        $repoJogo->expects($this->once())->method('buscarPorCodigo')->with(2)->willReturn($jogo);

        $service = new CadastrarAluguelService($repoAluguel, $repoCliente, $repoJogo);

        $service->executar([
            'identificador' => 1001,
            'dataInicial' => '2025-06-15',
            'periodo' => 5,
            'numeroCliente' => 1,
            'codigoJogo' => 2
        ]);

        $this->assertTrue(true);
    }

    protected function tearDown(): void
    {
        Mockery::close();
    }
}