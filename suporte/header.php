<?php
require_once './model/classeUsuario.php';
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Cultura Funk</title>
    <link rel="shortcut icon" type="image/x-icon" href="../img/band.png">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>

<body>

    <!-- Inicio Navegação -->
    <header>
        <div><a class="logo" href="./index.php">Cultura Funk</a></div>
        <div class="hamb">
            <div class="line"></div>
        </div>
        <nav class="nav-bar">
            <ul>
                <li>
                    <a href="index.php?menuop=sobre">Sobre</a>
                </li>
                <li>
                    <a href="index.php?menuop=musica">Musicas</a>
                </li>
                <li>
                    <a href="index.php?menuop=artista">Artista</a>
                </li>
                <li>
                    <a href="index.php?menuop=loja">Loja</a>
                </li>
                <?php if (isset($_SESSION['user_id']) && $_SESSION['user_role'] === 'usuario'): ?>
                    <div class="perfil">
                        <a href="./index.php?menuop=usuario">
                            <p>Olá,<?php echo $_SESSION['user_nome']; ?>!</p>

                        </a>
                        <a href="./controller/sair.php">

                            <span class="material-symbols-outlined">logout</span>
                        </a>
                    </div>

                <?php else: ?>

                    <li>
                        <a href="index.php?menuop=login">LOGIN</a>
                    </li>
                <?php endif; ?>

            </ul>
        </nav>
    </header>

    <section class="inicio">

        <!-- </section>

</body>

</html> -->