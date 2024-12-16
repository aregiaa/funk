<section class="login">
    <div id="tela-login">
        <h1 id="login">Login</h1>
        <br>
        <form action="./controller/login_process.php" method="post">
            <input class="log" type="email" id="email" name="email" placeholder="Email" required>
            <br><br>
            <div class="btn-eye">
                <input class="log" type="password" id="password" placeholder="Senha" id="senha" name="senha" required>
                <i class="fas fa-eye" id="togglePassword"></i>
            </div>
            <br><br>
            <div id="forgot-password">
                <a href="./controller/esqueci-senha.php">Recuperar senha?</a>
            </div>
            <div>
                <button type="submit">Entrar</button>
            </div>
            <div id="onclick">
                <a href="index.php?menuop=cadastro">Ainda não é inscrito? Cadastre-se!</a>
            </div>
        </form>
    </div>

</section>