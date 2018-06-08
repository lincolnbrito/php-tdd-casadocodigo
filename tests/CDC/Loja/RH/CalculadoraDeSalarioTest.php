<?php
namespace CDC\Loja\RH;

use PHPUnit\Framework\TestCase;

use CDC\Loja\RH\CalculadoraDeSalario,
    CDC\Loja\RH\Funcionario,
    CDC\Loja\RH\TabelaCargos;

class CalculadoraDeSalarioTest extends TestCase
{
    public function testCalculoSalarioDesenvolvedoresComSalarioAbaixoDoLimite()
    {
        $calculadora = new CalculadoraDeSalario();
        $desenvolvedor = new Funcionario(
            "Andre", 1500.0, TabelaCargos::DESENVOLVEDOR
        );

        $salario = $calculadora->calculaSalario($desenvolvedor);

        $this->assertEquals(1500.0 * 0.9, $salario, null, 0.00001);
    }

   public function testCalculoSalarioDesenvolvedoresComSalarioAcimaDoLimite()
    {
        $calculadora = new CalculadoraDeSalario();
        $desenvolvedor = new Funcionario(
            "Andre", 4000.0, TabelaCargos::DESENVOLVEDOR
        );

        $salario = $calculadora->calculaSalario($desenvolvedor);

        $this->assertEquals(4000.0 * 0.8, $salario, null, 0.00001);
    }

    public function testCalculoSalarioDBAsComSalarioAbaixoDoLimite()
    {
        $calculadora = new CalculadoraDeSalario();
        $dba = new Funcionario(
            "Mauricio", 1500.0, TabelaCargos::DBA
        );

        $salario = $calculadora->calculaSalario($dba);

        $this->assertEquals(1500.0 * 0.85, $salario, null, 0.00001);
    }

    public function testCalculoSalarioDBAsComSalarioAcimaDoLimite()
    {
        $calculadora = new CalculadoraDeSalario();
        $dba = new Funcionario(
            "Mauricio", 4500.0, TabelaCargos::DBA
        );

        $salario = $calculadora->calculaSalario($dba);

        $this->assertEquals(4500.0 * 0.75, $salario, null, 0.00001);
    }
}