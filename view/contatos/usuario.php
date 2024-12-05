<?php
require_once './model/classeUsuario.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'usuario') {
    header("Location: login.php");
    exit();
}
?>

</div>
<div class="usuario">

    <div class="dadospessoais">
        <h1 id="titulo">DADOS PESSOAIS</h1>
        <input type="text" placeholder="Nome:">
        <input type="text" placeholder="Cpf:">
        <input type="text" placeholder="E-mail:">
        <input type="text" placeholder="Bairro:">
        <input type="text" placeholder="Endereço:">
        <input type="text" placeholder="N°:">
        <input type="text" placeholder="Cidade:">
        <input type="text" placeholder="Estado:">
    </div>
    <div class="interacao">

        <div class="lineuser">
            <a href="http://">Minhas curtidas </a><span class="material-symbols-outlined">
                expand_circle_down
            </span>
        </div>
        <div class="lineuser">
            <a href="http://">Meus comentários </a><span class="material-symbols-outlined">
                expand_circle_down
            </span>
        </div>
        <div class="lineuser">
            <a href="http://">Minhas avaliações </a><span class="material-symbols-outlined">
                expand_circle_down
            </span>
        </div>
        <div class="lineuser">
            <a href="http://">Minhas compras </a><span class="material-symbols-outlined">
                expand_circle_down
            </span>
        </div>


    </div>
</div>