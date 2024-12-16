<?php
include_once "./banco/conexao.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($_POST['acao'] === 'salvar') {

        foreach ($_POST['nomeProduto'] as $id => $nomeProduto) {
            $quantidadeProduto = $_POST['quantidadeProduto'][$id];
            $valorProduto = $_POST['valorProduto'][$id];


            $updateQuery = "UPDATE produtos SET nomeProduto = ?, quantidadeProduto = ?, valorProduto = ? WHERE id = ?";
            $stmt = $conn->prepare($updateQuery);
            $stmt->bind_param("sdii", $nomeProduto, $quantidadeProduto, $valorProduto, $id);
            $stmt->execute();
        }
    } elseif ($_POST['acao'] === 'apagar') {

        foreach ($_POST['nomeProduto'] as $id => $nomeProduto) {
            $deleteQuery = "DELETE FROM produtos WHERE id = ?";
            $stmt = $conn->prepare($deleteQuery);
            $stmt->bind_param("i", $id);
            $stmt->execute();
        }
    }
}


header(header: "index.php?menuop=tabela");
exit;
?>