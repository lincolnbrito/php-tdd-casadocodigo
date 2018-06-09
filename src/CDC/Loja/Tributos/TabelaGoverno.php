<?php
namespace CDC\Loja\Tributos;

class TabelaGoverno implements TabelaInterface
{
    public function paraValor( $valor )
    {
        if($valor >= 1000.0) {
            return 0.2;
        }
    }
}