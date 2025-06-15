<?php

use PHPUnit\Framework\TestCase;
use App\Application\Jogo\Services\CadastrarJogoService;
use App\Domain\Jogo\Contracts\JogoRepositoryInterface;
use App\Domain\Jogo\Subtypes\JogoEletronico;
use App\Domain\Jogo\Enums\TipoEletronico;


class CadastrarJogoServiceTest extends TestCase
{
    public function testCadastraJogoEletronicoComSucesso()
    {
        $repo = $this->createMock(JogoRepositoryInterface::class);
        $repo->expects($this->once())->method('buscarPorCodigo')->with(1)->willReturn(null);
        $repo->expects($this->once())->method('salvar');

        $service = new CadastrarJogoService($repo);

        $service->executar([
            'codigo' => 1,
            'nome' => 'FIFA',
            'valorBase' => 100,
            'tipo' => 'eletronico',
            'categoria' => 'AVENTURA',
            'plataforma' => 'PS5'
        ]);

        $this->assertTrue(true);
    }

    protected function tearDown(): void
    {
        Mockery::close();
    }
}