<?php

use PHPUnit\Framework\TestCase;
use App\Domain\Cliente\Subtypes\Individual;
use App\Domain\Jogo\Subtypes\JogoMesa;
use App\Domain\Jogo\Enums\TipoMesa;
use App\Domain\Aluguel\Entities\Aluguel;
use Carbon\Carbon;

class AluguelTest extends TestCase
{
    public function testCriarAluguel()
    {
        $cliente = new Individual(1, 'João', 'Rua A', '12345678900');
        $jogo = new JogoMesa(2, 'Xadrez', 10, TipoMesa::TABULEIRO, 50);
        $dataInicial = Carbon::create(2025, 6, 13);

        $aluguel = new Aluguel(1001, $dataInicial, 5, $cliente, $jogo);

        $this->assertEquals(1001, $aluguel->identificador);
        $this->assertEquals($dataInicial, $aluguel->dataInicial);
        $this->assertEquals(5, $aluguel->periodo);
        $this->assertEquals($cliente, $aluguel->cliente);
        $this->assertEquals($jogo, $aluguel->jogo);
    }
}
