<?php
namespace CDC\Loja\FluxoDeCaixa;

use \ArrayObject;

class Fatura
{
    protected $cliente;
    protected $valor;
    protected $pagamentos;
    protected $pago;

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

    public function getValor()
    {
        return $this->valor;
    }

    public function setPago($pago)
    {
        $this->pago = $pago;
    }

    public function isPago()
    {
        return $this->pago;
    }
}