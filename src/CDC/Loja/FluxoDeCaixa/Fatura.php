<?php
namespace CDC\Loja\FluxoDeCaixa;

use \ArrayObject;

class Fatura
{
    protected $cliente;
    protected $valor;
    protected $pagamentos;

    public function __construct($cliente, $valor)
    {
        $this->cliente = $cliente;
        $this->valor = $valor;
        $this->pagamentos = new ArrayObject();
    }

    public function getPagamentos()
    {
        return $this->pagamentos;
    }
}