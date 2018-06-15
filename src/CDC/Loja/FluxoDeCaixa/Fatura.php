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
        $this->pago = false;
    }

    public function adicionaPagamento(Pagamento $pagamento)
    {
        $this->pagamentos->append($pagamento);

        $valorTotal = 0;

        foreach($this->pagamentos as $p ) {
            $valorTotal += $p->getValor();
        }

        if( $valorTotal >= $this->valor ) {
            $this->pago = true;
        }
    }

    public function adicionaPagamentoLote($pagamentos)
    {
        foreach($pagamentos as $pagamento) {
            $this->adicionaPagamento($pagamento);
        }
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