<?php
require_once '../model/classeUsuario.php';
require_once '../model/classeProdutos.php';
session_start();


if (isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'usuario'): ?>
    <div class="perfil">
        <a href="./index.php?menuop=usuario">
            <p>Olá, <?php echo $_SESSION['user_nome']; ?> Compra realizada com sucesso</p>
        </a>
        <a href="sair.php">
            <span class="material-symbols-outlined">logout</span></a>
    </div>

<?php else: ?>

    <li>
        <a href="index.php?menuop=login">LOGIN</a>
    </li>
<?php endif; ?>