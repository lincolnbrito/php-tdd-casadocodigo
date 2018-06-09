<?php
namespace CDC\Loja\RH;

use CDC\Loja\RH\Funcionario,
    CDC\Loja\RH\TabelaCargos;

class CalculadoraDeSalario
{
    public function calculaSalario(Funcionario $funcionario)
    {
        if( $funcionario->getCargo() == TabelaCargos::DESENVOLVEDOR ) {
            
            return $this->dezOuVintePorCentoDeDesconto($funcionario);          
           
        } else if( $funcionario->getCargo() == TabelaCargos::DBA || 
                   $funcionario->getCargo() == TabelaCargos::TESTADOR ) {
            return $this->quinzeOuVinteECincoPorCentoDeDesconto($funcionario);
        }

        throw new RunTimeException("Tipo de funcionário inválido");
    }

    private function dezOuVintePorCentoDeDesconto(Funcionario $funcionario) 
    {
        if( $funcionario->getSalario() > 3000 ) {
            return $funcionario->getSalario() * 0.8;
        }
        return $funcionario->getSalario() * 0.9;
    }

    private function quinzeOuVinteECincoPorCentoDeDesconto(Funcionario $funcionario)
    {
        if( $funcionario->getSalario() < 2500 ) {
            return $funcionario->getSalario() * 0.85;
        }
        return $funcionario->getSalario() * 0.75;
    }
}