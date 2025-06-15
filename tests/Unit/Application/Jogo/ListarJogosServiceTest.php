<?php

use PHPUnit\Framework\TestCase;
use App\Application\Jogo\Services\ListarJogosService;
use App\Domain\Jogo\Contracts\JogoRepositoryInterface;
use App\Domain\Jogo\Subtypes\JogoEletronico;
use App\Domain\Jogo\Enums\TipoEletronico;

class ListarJogosServiceTest extends TestCase
{
    public function testListaJogosComSucesso()
    {
        $jogo = new JogoEletronico(1, 'FIFA', 100, TipoEletronico::AVENTURA, 'PS5');

        $repo = $this->createMock(JogoRepositoryInterface::class);
        $repo->expects($this->once())->method('listarTodos')->willReturn([$jogo]);
        
        $service = new ListarJogosService($repo);

        $resultado = $service->executar();

        $this->assertIsArray($resultado);
        $this->assertCount(1, $resultado);
        $this->assertInstanceOf(JogoEletronico::class, $resultado[0]);
        $this->assertEquals('FIFA', $resultado[0]->nome);
    }

    protected function tearDown(): void
    {
        Mockery::close();
    }
}