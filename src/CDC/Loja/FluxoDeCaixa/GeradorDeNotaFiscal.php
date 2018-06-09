<?php
namespace CDC\Loja\FluxoDeCaixa;

use CDC\Loja\FluxoDeCaixa\Pedido,
    CDC\Loja\FluxoDeCaixa\NotaFiscal,
    CDC\Loja\DAO\NFDao,
    CDC\Loja\SAP\SAP;
use \DateTime;

class GeradorDeNotaFiscal
{
    private $acoes;

    public function __construct($acoes)
    {
        $this->acoes = $acoes;
    }

    public function gera(Pedido $pedido)
    {
        $nf =  new NotaFiscal(
            $pedido->getCliente(),
            $pedido->getValorTotal() * 0.94,
            new \DateTime()
        );

        foreach($this->acoes as $acao) {
            $acao->executa($nf);
        }

        return $nf;
    }
}