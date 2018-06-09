<?php
namespace CDC\Loja\RH;

use CDC\Loja\RH\IRegraDeCalculo,
    CDC\Loja\RH\Funcionario;

class QuinzeOuVinteECincoPorCento implements IRegraDeCalculo
{
    public function calcula( Funcionario $funcionario )
    {
        if( $funcionario->getSalario() < 2500 ){
            return $funcionario->getSalario() * 0.85;
        }
        return $funcionario->getSalario() * 0.75;
    }
}