<?php

define('BASE_PATH', __DIR__ . '/');
define('VIEW_PATH', BASE_PATH . 'view/');
define('CONTROLLER_PATH', BASE_PATH . '../controller/');


function includeWithErrorHandling($path)
{
    if (file_exists($path)) {
        include $path;
    } else {

        error_log("File not found: " . $path);
        include(VIEW_PATH . '404.php');

    }
}


includeWithErrorHandling(BASE_PATH . 'suporte/header.php');


$validPages = [
    'home' => VIEW_PATH . 'home/home.php',
    'artista' => VIEW_PATH . 'home/artista.php',
    'musica' => VIEW_PATH . 'home/musica.php',
    'sobre' => VIEW_PATH . 'home/sobre.php',
    'loja' => VIEW_PATH . 'home/loja.php',
    'login' => VIEW_PATH . 'contatos/login.php',
    'usuario' => VIEW_PATH . 'contatos/usuario.php',
    'cadastro' => VIEW_PATH . 'contatos/cadastro.php',
    'usuario_adm' => VIEW_PATH . 'contatos/usuario_adm.php',
    'carrinho' => VIEW_PATH . 'carrinho/carrinho.php',
    'compra' => VIEW_PATH . 'compra/compra.php',
    'produtos' => VIEW_PATH . 'compra/produtos.php',
    'tabela' => VIEW_PATH . 'carrinho/tabelaProdutos.php',
    'usuarioCad' => VIEW_PATH . 'adm/usuariosCadastrados.php',
    'produtosCad' => VIEW_PATH . 'adm/produtosCadastrados.php',
    'dados' => VIEW_PATH . 'controller/dados.php'

];

$menuop = isset($_GET['menuop']) ? basename($_GET['menuop']) : 'home';


if (array_key_exists($menuop, $validPages)) {
    includeWithErrorHandling($validPages[$menuop]);
} elseif ($menuop === 'login_process.php') {
    includeWithErrorHandling(CONTROLLER_PATH . 'login_process.php');
} elseif ($menuop === 'update') {
    includeWithErrorHandling(CONTROLLER_PATH . 'updateCad.php');
} else {

    includeWithErrorHandling(VIEW_PATH . '404.php');
}
includeWithErrorHandling(BASE_PATH . 'suporte/footer.php');
?>