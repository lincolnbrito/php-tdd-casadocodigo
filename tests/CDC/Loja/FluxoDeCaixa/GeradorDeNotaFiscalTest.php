<?php
namespace CDC\Loja\FluxoDeCaixa;

use CDC\Loja\Test\TestCase,
    CDC\Loja\DAO\NFDao,
    CDC\Loja\FluxoDeCaixa\Pedido,
    CDC\Loja\FluxoDeCaixa\GeradorDeNotaFical;
use Mockery;

class GeradorDeNotaFicalTest extends TestCase
{
    public function testDeveInvocarAcoesPosteriores()
    {
        $acao1 = Mockery::mock(
            "CDC\Loja\FluxoDeCaixa\AcaoAposGerarNotaInterface"
        );
        $acao1->shouldReceive("executa")->andReturn(true);

        $acao2 = Mockery::mock(
            "CDC\Loja\FluxoDeCaixa\AcaoAposGerarNotaInterface"
        );
        $acao2->shouldReceive("executa")->andReturn(true);

        $gerador = new GeradorDeNotaFiscal([$acao1, $acao2]);

        $pedido = new Pedido("Andre", 1000, 1);
        $nf = $gerador->gera($pedido);

        $this->assertTrue($acao1->executa($nf));
        $this->assertTrue($acao2->executa($nf));
        $this->assertNotNull($nf);
        $this->assertInstanceOf("CDC\Loja\FluxoDeCaixa\NotaFiscal", $nf);
    }
}