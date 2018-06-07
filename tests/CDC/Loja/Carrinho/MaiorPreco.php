<?php
namespace CDC\Loja\Carrinho;

use PHPUnit\Framework\TestCase;

use CDC\Loja\Carrinho\CarrinhoDeCompras,
    CDC\Loja\Carrinho\MaiorPreco;

class MaiorPrecoTest extends TestCase
{
    public function testDeveRetornarZeroSeCarrinhoVazio()
    {
        $carrinho = new CarrinhoDeCompras();

        $algoritmo = new MaiorPreco();
        $valor = $algoritmo->encontra($carrinho);

        $this->assertEquals(0, $valor, null, 0.00001);
    }
}