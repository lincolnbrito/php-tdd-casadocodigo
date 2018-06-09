<?php
namespace CDC\Loja\RH;

use CDC\Loja\RH\Funcionario;

interface IRegraDeCalculo
{
    public function calcula(Funcionario $funcionario);
}