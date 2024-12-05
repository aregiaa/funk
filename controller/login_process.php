<?php
session_start();
include '../banco/conexao.php';


$email = $_POST['email'];
$senha = $_POST['senha'];

// Prepara e executa a consulta
$sql = "SELECT id, nome, senha, role FROM usuarios WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();

    // Verifica a senha
    if (password_verify($senha, $usuario['senha'])) {
        // Inicia a sessão e armazena informações do usuário
        $_SESSION['user_id'] = $usuario['id'];
        $_SESSION['user_nome'] = $usuario['nome'];
        $_SESSION['user_role'] = $usuario['role'];

        // Redireciona baseado no papel do usuário
        if ($usuario['role'] === 'admin') {
            header("Refresh: 1;url=../index.php?menuop=usuario_adm");

        } else {
            header("Refresh: 1;url=../index.php?menuop=home");
        }
        exit();
    } else {
        echo "<script>alert('Usuario ou senha incorretos');</script>";
        // echo "Usuario ou senha incorretos";
        header("Refresh: 1;url=../index.php?menuop=login");
    }

} else {
    // echo "Usuário não encontrado!";
    header("Refresh: 1;url=../index.php?menuop=login");

}

// Fecha a conexão
$stmt->close();
$conn->close();
?>