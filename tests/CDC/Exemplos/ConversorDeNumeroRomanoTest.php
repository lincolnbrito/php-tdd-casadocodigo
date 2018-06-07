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

    public function testDeveEntenderOSimboloV()
    {
        $romano = new ConversorDeNumeroRomano();
        $numero = $romano->converte("V");

        $this->assertEquals(5, $numero);
    }

    public function testDeveEntenderOSimboloII()
    {
        $romano = new ConversorDeNumeroRomano();
        $numero = $romano->converte("II");

        $this->assertEquals(2, $numero);
    }

    public function testDeveEntenderOSimboloIII()
    {
        $romano = new ConversorDeNumeroRomano();
        $numero = $romano->converte("III");

        $this->assertEquals(3, $numero);
    }

    public function testDeveEntenderOSimboloXXII()
    {
        $romano = new ConversorDeNumeroRomano();
        $numero = $romano->converte("XXII");

        $this->assertEquals(22, $numero);
    }

    public function testDeveEntenderOSimboloIX()
    {
        $romano = new ConversorDeNumeroRomano();
        $numero = $romano->converte("IX");

        $this->assertEquals(9, $numero);
    }
    

    public function testDeveEntenderOSimboloXXIV()
    {
        $romano = new ConversorDeNumeroRomano();
        $numero = $romano->converte("XXIV");

        $this->assertEquals(24, $numero);
    }
}
