<?php
namespace CDC\Loja\FluxoDeCaixa;

use CDC\Loja\Test\TestCase,
    CDC\Loja\DAO\NFDao,
    CDC\Loja\FluxoDeCaixa\Pedido,
    CDC\Loja\FluxoDeCaixa\GeradorDeNotaFical;
use Mockery;

class GeradorDeNotaFicalTest extends TestCase
{
    public function testDeveGerarNFComValorDeImpostoDescontado()
    {
        $dao = Mockery::mock("CDC\Loja\Dao\NFDao");
        $dao->shouldReceive("persiste")->andReturn(true);

        $sap = Mockery::mock("CDC\Loja\SAP\SAP");
        $sap->shouldReceive("envia")->andReturn(true);

        $gerador = new GeradorDeNotaFiscal($dao, $sap);
        $pedido = new Pedido("Andre", 1000, 1);

        $nf = $gerador->gera($pedido);

        $this->assertEquals(1000*0.94, $nf->getValor(), null, 0.00001);
    }

    public function testDevePersistirNFGerada()
    {
        $dao = Mockery::mock("CDC\Loja\Dao\NFDao");
        $dao->shouldReceive("persiste")->andReturn(true);

        $sap = Mockery::mock("CDC\Loja\SAP\SAP");
        $sap->shouldReceive("envia")->andReturn(true);

        $gerador = new GeradorDeNotaFiscal($dao, $sap);
        
        $pedido = new Pedido("Andre", 1000, 1);
        $nf = $gerador->gera($pedido);

        $this->assertTrue($dao->persiste($nf));
        $this->assertEquals(1000 * 0.94, $nf->getValor(), null, 0.00001);
    }

    public function testDeveEnviarNFGeradaParaSAP()
    {
        $dao = Mockery::mock("CDC\Loja\DAO\NFDao");
        $dao->shouldReceive("persiste")->andReturn(true);

        $sap = Mockery::mock("CDC\Loja\SAP\SAP");
        $sap->shouldReceive("envia")->andReturn(true);

        $gerador = new GeradorDeNotaFiscal($dao, $sap);

        $pedido = new Pedido("Andre", 1000, 1);
        $nf = $gerador->gera($pedido);

        $this->assertTrue($sap->envia($nf));
        $this->assertEquals(1000 * 0.94, $nf->getValor(), null, 0.00001);
    }
}