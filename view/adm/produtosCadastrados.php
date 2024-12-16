<?php
require_once './model/classeProdutos.php';

try {
    // Conexão com o banco de dados
    $produto = new Produto("funk_rap", "localhost", "root", ""); // Considere usar variáveis de ambiente
} catch (Exception $e) {
    // Log the error and redirect to error page
    error_log($e->getMessage());
    header("Location: error.php?message=" . urlencode("Falha na conexão: " . $e->getMessage()));
    exit();
}


// Função para atualizar produto
if (isset($_POST['cadastrarProdutos'])) {
    $idProduto = $_POST['idProduto'];
    $nomeProduto = $_POST['nomeProduto'];
    $quantidadeProduto = $_POST['quantidadeProduto'];
    $valorProduto = $_POST['valorProduto'];
    // Validação dos dados
    if (!empty($idProduto) && !empty($nomeProduto) && !empty($quantidadeProduto) && !empty($valorProduto)) {
        // Verifica se os valores são numéricos onde necessário
        if (is_numeric($quantidadeProduto) && is_numeric($valorProduto)) {
            try {
                // Atualiza o produto no banco de dados
                $produto->atualizarProduto($idProduto, $nomeProduto, $quantidadeProduto, $valorProduto);
                echo "<script>alert('Produto atualizado com sucesso!');</script>";
                // $msgSucesso = 'Produto atualizado com sucesso!';
            } catch (Exception $e) {
                // Mensagem de erro
                $msgErro = 'Erro ao atualizar produto: ' . $e->getMessage();
            }
        } else {
            $msgErro = 'A quantidade e o valor devem ser números válidos!';
        }
    } else {
        // Mensagem de erro de validação
        $msgErro = 'Todos os campos devem ser preenchidos!';
    }
}

// Função para excluir produto
if (isset($_POST['excluirProduto'])) {
    $idProduto = $_POST['excluirProduto'];

    try {
        $produto->excluirProduto($idProduto);
        echo "<script>alert('Produto excluido com sucesso');</script>";
    } catch (Exception $e) {
        $msgErro = 'Erro ao excluir produto: ' . $e->getMessage();
    }
}
?>

<div class="produtoCad">
    <?php if (isset($msgSucesso)) { ?>
        <div class="msg-sucesso"><?php echo htmlspecialchars($msgSucesso); ?></div>
    <?php } ?>
    <?php if (isset($msgErro)) { ?>
        <div class="msg-erro"><?php echo htmlspecialchars($msgErro); ?></div>
    <?php } ?>

    <table border="1">
        <tr>
            <th>Nome</th>
            <th>Quantidade</th>
            <th>Valor por unidade (R$)</th>
            <th>Ações</th>
        </tr>

        <?php
        try {

            $dados = $produto->buscarDadosProdutos();

            if (count($dados) > 0) {
                // Exibe os produtos
                foreach ($dados as $produto) {
                    echo "<tr>";
                    echo "<form action='' method='post'>";
                    echo "<td><input type='text' name='nomeProduto' value='" . htmlspecialchars($produto['nomeProduto']) . "'></td>";
                    echo "<td><input type='text' name='quantidadeProduto' value='" . htmlspecialchars($produto['quantidadeProduto']) . "'></td>";
                    echo "<td><input type='text' name='valorProduto' value='" . htmlspecialchars($produto['valorProduto']) . "'></td>";
                    echo "<td>";
                    echo "<input type='hidden' name='idProduto' value='" . htmlspecialchars($produto['idProduto']) . "'>";
                    echo "<input type='hidden' name='cadastrarProdutos' value='1'>";  // Action flag
                    echo "<input type='submit' value='Salvar Alterações'>";
                    echo "</form>";

                    // Formulário para exclusão com confirmação
                    echo "<form action='' method='post' style='display:inline;' onsubmit='return confirm(\"Tem certeza que deseja excluir este produto?\");'>";
                    echo "<input type='hidden' name='excluirProduto' value='" . htmlspecialchars($produto['idProduto']) . "'>";
                    echo "<input type='submit' value='Excluir'>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>Sem produtos cadastrados</td></tr>";
            }
        } catch (Exception $e) {
            echo "<tr><td colspan='4'>Erro ao buscar os dados: " . htmlspecialchars($e->getMessage()) . "</td></tr>";
        }
        ?>

    </table>
    <div class="btnloja">

        <a href=" ./index.php?menuop=produtos">
            <button>Cadastrar produtos</button>
        </a>
    </div>
    <div class="btnloja">

        <a href="javascript:history.back()">Voltar</a>

        </a>
    </div>
</div>