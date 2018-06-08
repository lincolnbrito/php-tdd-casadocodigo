<?php
namespace CDC\Exemplos;

use CDC\Loja\Test\TestCase,
    CDC\Exemplos\Calculadora;

class CalculadoraTest extends TestCase
{
    public function testDeveSomarDoisNumerosPositivos()
    {
        $this->assertEquals(4, (new Calculadora())->soma(2,2));
        $this->assertEquals(2, (new Calculadora())->soma(1,1));
    }
}