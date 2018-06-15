<?php
namespace CDC\Loja\FluxoDeCaixa;

use CDC\Loja\Test\TestCase,
    CDC\Loja\FluxoDeCaixa\Fatura;

class FaturaTest extends TestCase
{
    public function testDeveMarcarFaturaComoPagoCasoBoletoUnicoPagueTudo()
    {
        $fatura = new Fatura("Cliente", 150.0);
        
        $boleto = new Boleto(150.0);
        $pagamento = new Pagamento($boleto->getValor(), MeioPagamento::BOLETO);

        $fatura->adicionaPagamento($pagamento);

        $this->assertTrue($fatura->isPago());
        
    }

    public function testDeveMarcarFaturaComoNaoPagaCasoBoletoUnicoNaoPagueTudo()
    {
        $fatura = new Fatura("Cliente", 150.0);    
        
        $pagamento = new Pagamento((new Boleto(50.0))->getValor(), MeioPagamento::BOLETO);
        $fatura->adicionaPagamento($pagamento);        

        $this->assertFalse($fatura->isPago());
    }
    

    public function testDeveMarcarFaturaComoPagaCasoMuitosBoletosPaguemTudo()
    {
        
        $fatura = new Fatura("Cliente", 150.0);

        $pagamentos = [
            new Pagamento((new Boleto(40.0))->getValor(), MeioPagamento::BOLETO),
            new Pagamento((new Boleto(10.0))->getValor(), MeioPagamento::BOLETO),
            new Pagamento((new Boleto(25.0))->getValor(), MeioPagamento::BOLETO),
            new Pagamento((new Boleto(25.0))->getValor(), MeioPagamento::BOLETO),
        ];
        
        $fatura->adicionaPagamentoLote($pagamentos);
        
        $this->assertFalse($fatura->isPago());
    }
/*
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
    }*/

}
