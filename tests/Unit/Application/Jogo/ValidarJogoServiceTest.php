<?php

use PHPUnit\Framework\TestCase;
use App\Application\Jogo\Services\ValidarJogoService;
use App\Domain\Jogo\Contracts\JogoRepositoryInterface;
use App\Domain\Jogo\Subtypes\JogoEletronico;
use App\Domain\Jogo\Enums\TipoEletronico;

class ValidarJogoServiceTest extends TestCase
{
    public function testJogoExiste()
    {
        $jogo = new JogoEletronico(1, 'FIFA', 100, TipoEletronico::AVENTURA, 'PS5');

        $repo = $this->createMock(JogoRepositoryInterface::class);
        $repo->expects($this->once())->method('buscarPorCodigo')->with(1)->willReturn($jogo);

        $service = new ValidarJogoService($repo);

        $this->assertTrue($service->executar(1));
    }

    public function testJogoNaoExiste()
    {
        $repo = $this->createMock(JogoRepositoryInterface::class);
        $repo->expects($this->once())->method('buscarPorCodigo')->with(2)->willReturn(null);

        $service = new ValidarJogoService($repo);

        $this->assertFalse($service->executar(2));
    }

    protected function tearDown(): void
    {
        Mockery::close();
    }
}