<?php
include_once("../banco/conexao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome = isset($_POST['nome']) ? trim($_POST['nome']) : '';
    $tel = isset($_POST['tel']) ? trim($_POST['tel']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $senha = isset($_POST['senha']) ? trim($_POST['senha']) : '';
    $bairro = isset($_POST['bairro']) ? trim($_POST['bairro']) : '';
    $logradouro = isset($_POST['logradouro']) ? trim($_POST['logradouro']) : '';
    $numero = isset($_POST['numero']) ? trim($_POST['numero']) : '';
    $cidade = isset($_POST['cidade']) ? trim($_POST['cidade']) : '';
    $estado = isset($_POST['estado']) ? trim($_POST['estado']) : '';

    if (empty($nome)) {
        die("Preencha seu nome");
    }
    if (empty($tel)) {
        die("Preencha seu telefone");
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Preencha um email válido");
    }
    if (empty($senha)) {
        die("Crie uma senha");
    }
    if (empty($bairro)) {
        die("Preencha o bairro");
    }
    if (empty($logradouro)) {
        die("Preencha o logradouro");
    }
    if (empty($numero)) {
        die("Preencha o numero");
    }
    if (empty($cidade)) {
        die("Preencha a cidade");
    }
    if (empty($estado)) {
        die("Preencha o estado");
    }
    $stmt_check_email = $conn->prepare("SELECT email FROM usuarios WHERE email = ?");
    $stmt_check_email->bind_param("s", $email);
    $stmt_check_email->execute();
    $stmt_check_email->store_result();

    if ($stmt_check_email->num_rows > 0) {
        die("Este email já está cadastrado. Por favor, utilize outro.");
    }

    $senhaHashed = password_hash($senha, PASSWORD_DEFAULT);


    $stmt = $conn->prepare("INSERT INTO usuarios (nome, tel, email, senha, bairro, logradouro, numero, cidade, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Erro na preparação da query: " . $conn->error);
    }

    // Bind dos parâmetros
    $stmt->bind_param("sssssssss", $nome, $tel, $email, $senhaHashed, $bairro, $logradouro, $numero, $cidade, $estado);

    // Executando a query
    if ($stmt->execute()) {
        header("Location: ../index.php?menuop=login");
        exit;
    } else {
        die("Erro ao tentar realizar o cadastro: " . $stmt->error);
    }

    $stmt->close();
    $stmt_check_email->close();
} else {
    die("Método inválido.");
}

$conn->close();
?>