<?php
require_once './model/classeUsuario.php';
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Logar para continuar');</script>";
    header("Refresh: 1;url=./index.php?menuop=login");
    exit();
}

$user_id = $_SESSION['user_id'];

try {
    $user = new Usuario("funk_rap", "localhost", "root", "");
    $dados_usuario = $user->buscarDadosUsuario($user_id);
    if (!$dados_usuario) {
        $_SESSION['message'] = 'Usuário não encontrado.';
        exit();
    }
} catch (Exception $e) {
    $_SESSION['message'] = 'Erro ao buscar dados do usuário: ' . $e->getMessage();
    exit();
}

?>

<section class="carrinho">
    <?php if (isset($_SESSION['message'])): ?>
        <p><?php echo $_SESSION['message'];
        unset($_SESSION['message']); ?></p>
    <?php endif; ?>
    <h1><span class="material-symbols-outlined">shopping_cart</span></h1><br>
    <div class="boxcarrinho">
        <div class="pagamento">

        </div>
    </div>
    <div class="entrega">
        <h1>DADOS PESSOAIS</h1>
        <div class="linecar"></div>
        <form action="./controller/finalizarCompra.php" method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($dados_usuario['id']); ?>">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($dados_usuario['nome']); ?>"
                readonly><br><br>
            <label for="telefone">Telefone:</label>
            <input type="text" id="tel" name="tel" value="<?php echo htmlspecialchars($dados_usuario['tel']); ?>"
                readonly><br>
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($dados_usuario['email']); ?>"
                readonly><br>



            <div class="linecar"></div>
            <h1>ENTREGA <span class="material-symbols-outlined">local_shipping</span></h1>

            <label for="bairro">Bairro:</label>
            <input type="text" id="bairro" name="bairro"
                value="<?php echo htmlspecialchars($dados_usuario['bairro']); ?>" readonly><br><br>

            <label for="logradouro">Logradouro:</label>
            <input type="text" id="logradouro" name="logradouro"
                value="<?php echo htmlspecialchars($dados_usuario['logradouro']); ?>" readonly><br><br>

            <label for="numero">Número:</label>
            <input type="text" id="numero" name="numero"
                value="<?php echo htmlspecialchars($dados_usuario['numero']); ?>" readonly><br><br>

            <label for="cidade">Cidade:</label>
            <input type="text" id="cidade" name="cidade"
                value="<?php echo htmlspecialchars($dados_usuario['cidade']); ?>" readonly><br><br>

            <label for="estado">Estado:</label>
            <input type="text" id="estado" name="estado"
                value="<?php echo htmlspecialchars($dados_usuario['estado']); ?>" readonly><br><br>
            <button>CONFIRMAR</button>
        </form>
        <div class="linecar"></div>
    </div>
</section>