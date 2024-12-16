<?php
session_start(); // Certifique-se de iniciar a sessão

require_once '../model/classeUsuario.php';

// Verifica se o usuário está logado e é um administrador
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Verifica se o ID do usuário foi passado corretamente na URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['message'] = 'ID inválido ou ausente.';
    header('Location: ../index.php?menuop=usuario_adm');
    exit();
}

$id_usuario = $_GET['id']; // Pega o ID passado via URL

try {
    // Instancia a classe de usuário para buscar os dados
    $user = new Usuario("funk_rap", "localhost", "root", ""); // Considere usar variáveis de ambiente
    $dados_usuario = $user->buscarDadosUsuario($id_usuario); // Função 

    if (!$dados_usuario) {
        $_SESSION['message'] = 'Usuário não encontrado.';
        header('Location: ../index.php?menuop=usuario_adm');
        exit();
    }

} catch (Exception $e) {
    $_SESSION['message'] = 'Erro ao buscar dados do usuário: ' . $e->getMessage();
    header('Location: ../index.php?menuop=usuario_adm');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['atualizar'])) {
    $nome = $_POST['nome'];
    $telefone = $_POST['tel'];
    $email = $_POST['email'];
    $bairro = $_POST['bairro'];
    $logradouro = $_POST['logradouro'];
    $numero = $_POST['numero'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $role = $_POST['role'];


    // Validação dos campos
    if (empty($nome) || empty($telefone) || empty($email) || empty($role) || empty($bairro) || empty($logradouro) || empty($numero) || empty($cidade) || empty($estado)) {
        $_SESSION['message'] = 'Todos os campos são obrigatórios.';
    } else {
        try {
            // Atualiza os dados do usuário
            if ($user->atualizarDados($id_usuario, $nome, $telefone, $email, $role, $bairro, $logradouro, $numero, $cidade, $estado)) {
                echo "<script>alert('Atualizado com sucesso!');</script>";
                header("Location: ../index.php?menuop=usuario_adm");
                exit();
            } else {
                $_SESSION['message'] = 'Erro ao atualizar os dados do usuário.';
            }
        } catch (Exception $e) {
            $_SESSION['message'] = 'Erro ao atualizar os dados: ' . $e->getMessage();
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
</head>

<body>

    <h2>Editar Dados do Usuário</h2>

    <!-- Exibir mensagem de erro ou sucesso -->
    <?php
    if (isset($_SESSION['message'])) {
        echo "<p>" . htmlspecialchars($_SESSION['message']) . "</p>";
        unset($_SESSION['message']);
    }
    ?>

    <!-- Formulário de edição -->
    <form action="dados.php?id=<?php echo htmlspecialchars($id_usuario); ?>" method="POST">
        <!-- ID oculto, necessário para atualização -->
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($dados_usuario['id']); ?>">

        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($dados_usuario['nome']); ?>"
            required><br><br>

        <label for="telefone">Telefone:</label>
        <input type="text" id="tel" name="tel" value="<?php echo htmlspecialchars($dados_usuario['tel']); ?>"
            required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($dados_usuario['email']); ?>"
            required><br><br>



        <label for="bairro">Bairro:</label>
        <input type="text" id="bairro" name="bairro" value="<?php echo htmlspecialchars($dados_usuario['bairro']); ?>"
            required><br><br>

        <label for="logradouro">Logradouro:</label>
        <input type="text" id="logradouro" name="logradouro"
            value="<?php echo htmlspecialchars($dados_usuario['logradouro']); ?>" required><br><br>

        <label for="numero">Número:</label>
        <input type="text" id="numero" name="numero" value="<?php echo htmlspecialchars($dados_usuario['numero']); ?>"
            required><br><br>

        <label for="cidade">Cidade:</label>
        <input type="text" id="cidade" name="cidade" value="<?php echo htmlspecialchars($dados_usuario['cidade']); ?>"
            required><br><br>

        <label for="estado">Estado:</label>
        <input type="text" id="estado" name="estado" value="<?php echo htmlspecialchars($dados_usuario['estado']); ?>"
            required><br><br>

        <label for="role">Tornar esse usuário administrador:</label><br>
        <input type="radio" id="sim" name="role" value="admin" <?php echo (isset($dados_usuario['role']) && $dados_usuario['role'] === 'admin') ? 'checked' : ''; ?>>
        <label for="sim">Sim</label><br>
        <input type="radio" id="nao" name="role" value="user_role" <?php echo (isset($dados_usuario['role']) && $dados_usuario['role'] === 'user_role') ? 'checked' : 'checked'; ?>>
        <label for="nao">Não</label><br><br>



        <button type="submit" name="atualizar">Atualizar</button>
    </form>

</body>

</html>