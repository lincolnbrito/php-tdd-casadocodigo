<?php
namespace CDC\Loja\Produto;

use PHPUnit\Framework\TestCase;

use CDC\Loja\Carrinho\CarrinhoDeCompras,
    CDC\Loja\Produto\Produto,
    CDC\Loja\Produto\MaiorEMenor;

class MaiorEMenorTest extends TestCase
{
    public function testOrdemDecrescente()
    {
        $carrinho = new CarrinhoDeCompras();

        $carrinho->adiciona(new Produto("Geladeira",450.00, 1));
        $carrinho->adiciona(new Produto("Liquidificador",250.00, 1));
        $carrinho->adiciona(new Produto("Jogo de pratos",70.00, 1));

        $maiorMenor = new MaiorEMenor();
        $maiorMenor->encontra($carrinho);
        
        $this->assertEquals("Jogo de pratos", $maiorMenor->getMenor()->getNome());
        $this->assertEquals("Geladeira", $maiorMenor->getMaior()->getNome());
    }

    public function testApenasUmProduto()
    {
        $carrinho = new CarrinhoDeCompras();

        $carrinho->adiciona(new Produto("Geladeira", 450.00, 1));

        $maiorMenor = new MaiorEMenor();
        $maiorMenor->encontra($carrinho);

        $this->assertEquals("Geladeira", $maiorMenor->getMenor()->getNome());
        $this->assertEquals("Geladeira", $maiorMenor->getMaior()->getNome());

        //assegurando que o produto retornado é uma instância de Produto
        $this->assertInstanceOf(Produto::class,$maiorMenor->getMaior());
    }
}
