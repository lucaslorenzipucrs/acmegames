<?php

use PHPUnit\Framework\TestCase;
use App\Domain\Jogo\Subtypes\JogoEletronico;
use App\Domain\Jogo\Subtypes\JogoMesa;
use App\Domain\Jogo\Enums\TipoEletronico;
use App\Domain\Jogo\Enums\TipoMesa;

class JogoTest extends TestCase
{
    public function testCriarJogoEletronico()
    {
        $jogo = new JogoEletronico(1, 'FIFA', 100, TipoEletronico::AVENTURA, 'PS5');
        $this->assertEquals(1, $jogo->codigo);
        $this->assertEquals('FIFA', $jogo->nome);
        $this->assertEquals(100, $jogo->valorBase);
        $this->assertEquals(TipoEletronico::AVENTURA, $jogo->tipo);
        $this->assertEquals('PS5', $jogo->plataforma);
    }

    public function testCriarJogoMesa()
    {
        $jogo = new JogoMesa(2, 'Xadrez', 10, TipoMesa::TABULEIRO, 50);
        $this->assertEquals(2, $jogo->codigo);
        $this->assertEquals('Xadrez', $jogo->nome);
        $this->assertEquals(10, $jogo->valorBase);
        $this->assertEquals(TipoMesa::TABULEIRO, $jogo->tipo);
        $this->assertEquals(50, $jogo->numeroPecas);
    }
}
