<?php
namespace CDC\Loja\RH;

use CDC\Loja\RH\IRegraDeCalculo,
    CDC\Loja\RH\Funcionario;

class DezOuVintePorCento implements IRegraDeCalculo
{
    public function calcula(Funcionario $funcionario)
    {
        if( $funcionario->getSalario() > 3000 ) {
            return $funcionario->getSalario() * 0.8;
        }
        return $funcionario->getSalario() * 0.9;
    }
}