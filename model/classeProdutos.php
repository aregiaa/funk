<?php

class Produto
{
    private $pdo;

    public function __construct($dbname, $host, $user, $senha)
    {
        try {
            $this->pdo = new PDO("mysql:dbname=" . $dbname . ";host=" . $host, $user, $senha);
        } catch (Exception $e) {
            echo "Erro de conexão: " . $e->getMessage();
            exit();
        }
    }

    public function buscarDadosProdutos()
    {
        $res = array();
        $stmt = $this->pdo->query("SELECT * FROM Produtos ORDER BY nomeProduto");
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function cadastrarProdutos($nomeProduto, $quantidadeProduto, $valorProduto)
    {
        $stmt = $this->pdo->prepare("SELECT id FROM produtos WHERE nomeProduto = :p");
        $stmt->bindValue(":p", $nomeProduto);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return false;
        } else {
            $stmt = $this->pdo->prepare("INSERT INTO produtos (nomeProduto, quantidadeProduto, valorProduto) VALUES(:p, :q, :v)");
            $stmt->bindValue(":p", $nomeProduto);
            $stmt->bindValue(":q", $quantidadeProduto);
            $stmt->bindValue(":v", $valorProduto);
            $stmt->execute();
            return true;
        }
    }

    public function excluirProduto($idProduto)
    {
        $sql = "DELETE FROM produtos WHERE idProduto = :idProduto";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':idProduto', $idProduto);

        if ($stmt->execute()) {
            return true;
        } else {
            throw new Exception("Erro ao excluir o produto");
        }
    }

    public function atualizarProduto($idProduto, $nomeProduto, $quantidadeProduto, $valorProduto)
    {
        $sql = "UPDATE produtos SET nomeProduto = :nomeProduto, quantidadeProduto = :quantidadeProduto, valorProduto = :valorProduto WHERE idProduto = :idProduto";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nomeProduto', $nomeProduto);
        $stmt->bindParam(':quantidadeProduto', $quantidadeProduto);
        $stmt->bindParam(':valorProduto', $valorProduto);
        $stmt->bindParam(':idProduto', $idProduto);

        if ($stmt->execute()) {
            return true;
        } else {
            throw new Exception("Erro ao atualizar o produto");
        }
    }
}
