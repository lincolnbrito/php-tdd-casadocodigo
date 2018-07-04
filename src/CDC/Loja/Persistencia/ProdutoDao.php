<?php
namespace CDC\Loja\Persistencia;

use PDO;
use CDC\Loja\Produto\Produto;

class ProdutoDao
{
    private $conexao;

    public function __construct(PDO $conexao)
    {
        $this->conexao = $conexao;
    }

    public function adiciona(Produto $produto)
    {
        $sqlString = "INSERT INTO `produto` ";
        $sqlString .= "(descricao, valor_unitario,quantidade) ";
        $sqlString .= "VALUES (?,?,?)";

        $stmt = $this->conexao->prepare($sqlString);

        $stmt->bindValue(1, $produto->getNome());
        $stmt->bindValue(2, $produto->getValorUnitario());
        $stmt->bindValue(3, $produto->getQuantidade());

        $stmt->execute();

        return $this->conexao;
    }

    public function porId($id)
    {
        $sqlString = "SELECT * FROM `produto` WHERE id=".$id;
        $consulta = $this->conexao->query($sqlString);

        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    public function ativos()
    {
        $sqlString = "SELECT * FROM `produto` WHERE status=1";
        $consulta = $this->conexao->query($sqlString);

        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
}