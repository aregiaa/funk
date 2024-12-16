<?php

include_once("../banco/conexao.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $nomeProduto = isset($_POST['nomeProduto']) ? trim($_POST['nomeProduto']) : '';
    $quantidadeProduto = isset($_POST['quantidadeProduto']) ? trim($_POST['quantidadeProduto']) : '';
    $valorProduto = isset($_POST['valorProduto']) ? trim($_POST['valorProduto']) : '';




    // Validações
    if (empty($nomeProduto)) {
        die("Produto");
    }
    if (empty($quantidadeProduto)) {
        die("Preencha a quantidade de Produto");
    }
    if (empty($valorProduto)) {
        die("Preencha um valor produto  válido");
    }



    // Preparando a query para inserir os dados do usuário no banco
    $stmt = $conn->prepare("INSERT INTO produtos (nomeProduto, quantidadeProduto, valorProduto) VALUES ( ?, ?, ?)");
    if (!$stmt) {
        die("Erro na preparação da query: " . $conn->error);
    }

    // Bind dos parâmetros
    $stmt->bind_param("sss", $nomeProduto, $quantidadeProduto, $valorProduto);

    // Executando a query
    if ($stmt->execute()) {
        header("Location: ../index.php?menuop=produtosCad");
        exit;
    } else {
        die("Erro ao tentar realizar o cadastro: " . $stmt->error);
    }

    $stmt->close();
} else {
    die("Método inválido.");
}

$conn->close();
?>