<?php
namespace CDC\Loja\FluxoDeCaixa;

class Boleto
{
    protected $sacado;
    protected $valor;
    
    public function __construct($valor)
    {
        $this->valor = $valor;
    }

    public function getValor()
    {
        return $this->valor;
    }
}