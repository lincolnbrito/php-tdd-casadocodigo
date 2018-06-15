<?php
namespace CDC\Loja\FluxoDeCaixa;

use CDC\Loja\Test\TestCase,
    CDC\Loja\FluxoDeCaixa\ProcessadorDeBoletos,
    CDC\Loja\FluxoDeCaixa\Fatura;

use \ArrayObject;

class ProcessadorDeBoletosTest extends TestCase
{
    public function testDeveProcessarPagamentoViaBoletoUnico()
    {
        $processador = new ProcessadorDeBoletos();

        $fatura = new Fatura('Cliente', 150.0);
        $boleto = new Boleto(150.0);

        $boletos = new ArrayObject();
        $boletos->append($boleto);
        
        $processador->processa($boletos, $fatura);
        
        $this->assertEquals(1, count($fatura->getPagamentos()));
        $this->assertEquals(150.0, $fatura->getPagamentos()[0]->getValor(), null, 0.00001);
    }

    public function testDeveProcessarPagamentoViaMuitosBoletos()
    {
        $processador = new ProcessadorDeBoletos();

        $fatura = new Fatura("Cliente", 150);

        $boleto1 = new Boleto(100.0);
        $boleto2 = new Boleto(200.0);

        $boletos = new ArrayObject();
        $boletos->append($boleto1);
        $boletos->append($boleto2);

        $processador->processa($boletos, $fatura);

        $this->assertEquals(2, count($fatura->getPagamentos()));

        $valor1 = $fatura->getPagamentos()[0]->getValor();
        $valor2 = $fatura->getPagamentos()[1]->getValor();

        $this->assertEquals(100.0,$valor1, null, 0.00001);
        $this->assertEquals(200.0,$valor2, null, 0.00001);
        
    }

    public function testDeveMarcarFaturaComoPagoCasoBoletoUnicoPagueTudo()
    {
        $processador = new ProcessadorDeBoletos();
        $fatura = new Fatura("Cliente", 150.0);

        $boletos = new ArrayObject();
        $boletos->append(new Boleto(150.0));

        $processador->processa($boletos, $fatura);

        $this->assertTrue($fatura->isPago());
        
    }

    public function testDeveMarcarFaturaComoNaoPagaCasoBoletoUnicoNaoPagueTudo()
    {
        $processador = new ProcessadorDeBoletos();
        $fatura = new Fatura("Cliente", 150.0);

        $boletos = new ArrayObject();
        $boletos->append(new Boleto(50.0));

        $processador->processa($boletos, $fatura);

        $this->assertFalse($fatura->isPago());
    }

    public function testDeveMarcarFaturaComoPagaCasoMuitosBoletosPaguemTudo()
    {
        $processador = new ProcessadorDeBoletos();
        $fatura = new Fatura("Cliente", 150.0);

        $boletos = new ArrayObject();
        $boletos->append(new Boleto(40.0));
        $boletos->append(new Boleto(10.0));
        $boletos->append(new Boleto(25.0));
        $boletos->append(new Boleto(25.0));
        $boletos->append(new Boleto(100.0));

        $processador->processa($boletos, $fatura);

        $this->assertTrue($fatura->isPago());
    }

    public function testDeveMarcarFaturaComoNaoPagaCasoMuitosBoletosNaoPaguemTudo()
    {
        $processador = new ProcessadorDeBoletos();
        $fatura = new Fatura("Cliente", 150.0);

        $boletos = new ArrayObject();
        $boletos->append(new Boleto(10.0));
        $boletos->append(new Boleto(20.0));
        $boletos->append(new Boleto(15.0));
        $boletos->append(new Boleto(15.0));        

        $processador->processa($boletos, $fatura);

        $this->assertFalse($fatura->isPago());
    }
}