<?php
namespace CDC\Loja\Carrinho;

use CDC\Loja\Test\TestCase,
    CDC\Loja\Test\Builder\CarrinhoDeComprasBuilder,
    CDC\Loja\Carrinho\CarrinhoDeCompras,
    CDC\Loja\Produto\Produto;

class CarrinhoDeComprasTest extends TestCase
{
    private $carrinho;

    protected function setUp()
    {
        $this->carrinho = new CarrinhoDeCompras();
        parent::setUp();
    }

    public function test_deve_retornar_zero_se_carrinho_vazio()
    {
        $valor = $this->carrinho->maiorValor();
        $this->assertEquals(0, $valor, null, 0.00001);
    }

    public function testDeveRetornarValorDosItensSeCarrinhoCom1Elemento()
    {
        $this->carrinho->adiciona(new Produto("Geladeira", 900.00, 1));

        $valor = $this->carrinho->maiorValor();

        $this->assertEquals(900.00, $valor, null, 0.00001);
    }

    public function testDeveRetornarMaiorValorSeCarrinhoComMuitosElementos()
    {
        
        $this->carrinho->adiciona(new Produto("Geladeira", 900.00, 1));
        $this->carrinho->adiciona(new Produto("Fogão", 1500.00, 1));
        $this->carrinho->adiciona(new Produto("Máquina de lavar", 750.00, 1));

        $valor = $this->carrinho->maiorValor();

        $this->assertEquals(1500.00, $valor, null, 0.00001);
    }

    public function testDeveRetornarMaiorValorSeCarrinhoComMuitosElementosBuilder()
    {
        $carrinho = (new CarrinhoDeComprasBuilder())
                    ->comItens(900.00, 1500.00, 750.00)
                    ->cria();
        
        $valor = $carrinho->maiorValor();

        $this->assertEquals(1500.00, $valor, null, 0.00001);
    }

    public function testListaDeProdutos()
    {
        $lista = (new CarrinhoDeCompras)
                ->adiciona(new Produto("Jogo de jantar", 200.00, 1))
                ->adiciona(new Produto("Jogo de pratos", 100.00, 1));
        
        $this->assertEquals(2, count($lista->getProdutos()));
        $this->assertEquals(200.00, $lista->getProdutos()[0]->getValorUnitario());
        $this->assertEquals(100.00, $lista->getProdutos()[1]->getValorUnitario());
    }
}