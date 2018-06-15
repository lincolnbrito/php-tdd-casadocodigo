<?php
namespace CDC\Loja\FluxoDeCaixa;

use CDC\Loja\FluxoDeCaixa\MeioPagamento;

class Pagamento
{
    protected $valor;
    protected $meioPagamento;

    public function __construct($valor, $meioPagamento)
    {
        $this->valor = $valor;
        $this->meioPagamento = $meioPagamento;
    }

    public function getValor()
    {
        return $this->valor;
    }

    public function getMeioPagamento()
    {
        return $this->meioPagamento;
    }
}