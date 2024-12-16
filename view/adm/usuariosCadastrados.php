<?php


require_once './model/classeUsuario.php';
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
try {
    $user = new Usuario("funk_rap", "localhost", "root", "");
} catch (Exception $e) {
    header("Location: error.php?message=" . urlencode("Falha na conexão: " . $e->getMessage()));
    exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    if ($user->excluirUsuario($delete_id)) {
        echo "<script>alert('usuario excluido com sucesso);</script>";
    } else {
        $_SESSION['message'] = "Erro ao excluir o usuário";
    }
    header("Location: ./index.php?menuop=usuario_adm");
    exit();
}

// Verifica se a ação de edição foi solicitada
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editar_id'])) {
    $editar_id = $_POST['editar_id'];
    echo "<script>alert('Atualizado com sucesso!');</script>";
    header("Location: ./controller/dados.php?id=$editar_id");
    exit();
}
?>

<div class="perfil">

    <p> <?php echo $_SESSION['user_nome']; ?>! ADIMISTRADOR</p> <a href="./controller/sair.php">
        <span class="material-symbols-outlined">logout</span>
    </a>

</div>


<div class="dados">
    <h2>Dados dos usuários</h2>
    <table>
        <tr id="titulo">
            <td>Nome</td>
            <td>Telefone</td>
            <td>Email</td>
            <td>Bairro</td>
            <td>Logradouro</td>
            <td>Numero</td>
            <td>Cidade</td>
            <td>Estado</td>
            <td>Ações</td>
        </tr>

        <?php
        // Busca todos os usuários
        try {
            $dados = $user->buscarDados();
            if (count($dados) > 0) {
                foreach ($dados as $usuario) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($usuario['nome']) . "</td>";
                    echo "<td>" . htmlspecialchars($usuario['tel']) . "</td>";
                    echo "<td>" . htmlspecialchars($usuario['email']) . "</td>";
                    echo "<td>" . htmlspecialchars($usuario['bairro']) . "</td>";
                    echo "<td>" . htmlspecialchars($usuario['logradouro']) . "</td>";
                    echo "<td>" . htmlspecialchars($usuario['numero']) . "</td>";
                    echo "<td>" . htmlspecialchars($usuario['cidade']) . "</td>";
                    echo "<td>" . htmlspecialchars($usuario['estado']) . "</td>";
                    echo "<td> 
                            <form action='' method='post' style='display:inline;'>
                                <input type='hidden' name='editar_id' value='" . htmlspecialchars($usuario['id']) . "'>
                                <input type='submit' value='Editar'>
                            </form>
                            <form action='' method='post' style='display:inline;'>
                                <input type='hidden' name='delete_id' value='" . htmlspecialchars($usuario['id']) . "'>
                                <input type='submit' value='Excluir' onclick='return confirm(\"Tem certeza que deseja excluir este usuário?\");'>
                            </form>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>Não há pessoas cadastradas</td></tr>";
            }
        } catch (Exception $e) {
            echo "<tr><td colspan='9'>Erro ao carregar os dados: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
        }
        ?>
    </table>
    <?php

    if (isset($_SESSION['message'])) {
        echo "<p>" . htmlspecialchars($_SESSION['message']) . "</p>";
        unset($_SESSION['message']);
    }
    ?>
</div>
<div class="btnloja">

    <a href="javascript:history.back()">Voltar</a>

    </a>
</div>