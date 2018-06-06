<?php
namespace CDC\Exemplos;

use PHPUnit\Framework\TestCase;
use CDC\Exemplos\ConversorDeNumeroRomano;

class ConversorDeNumeroRomanoTest extends TestCase
{
    public function testDeveEntenderOSimboloI()
    {
        $romano = new ConversorDeNumeroRomano();
        $numero = $romano->converte("I");

        $this->assertEquals(1, $numero);
    }
}
