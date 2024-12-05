<section class="cadastro">


    <div class="tela-login2">
        <h1 id="login">Dados pessoais</h1>

        <form action="./controller/cadUsuario.php" method="post" id="userForm" onsubmit="return validateForm()">

            <input class="log" type="text" name="nome" placeholder="Nome" id="nome" required>
            <div class="error-message" id="nome-error"></div>

            <input class="log" type="text" name="tel" placeholder="Telefone" id="tel" required>
            <div class="error-message" id="tel-error"></div>

            <input class="log" type="text" name="email" placeholder="Email" id="email" required>
            <div class="error-message" id="email-error"></div>

            <input class="senha" type="password" name="senha" placeholder="Senha" id="senha" required>


            <div class="error-message" id="senha-error"></div>
            <input class="senha" type="password" name="confirmSenha" placeholder="Repetir Senha" id="confirmSenha"
                required>
            <div class="error-message" id="confirmSenha-error"></div>
    </div>



    <div class="endereco">

        <h1 id="login">Endereço</h1>

        <input class="log" type="text" name="bairro" placeholder="Bairro" id="bairro" required>
        <div class="error-message" id="bairro-error"></div>
        <input class="log" type="text" name="logradouro" placeholder="Logradouro" id="logradouro" required>
        <div class="error-message" id="logradouro-error"></div>
        <input class="log" type="text" name="numero" placeholder="N°" id="numero" required>
        <div class="error-message" id="numero-error"></div>
        <input class="log" type="text" name="cidade" placeholder="Cidade" id="cidade" required>
        <div class="error-message" id="cidade-error"></div>
        <input class="log" type="text" name="estado" placeholder="Estado" id="estado" required>
        <div class="error-message" id="estado-error"></div>

        <div id="btncad">
            <button type="submit">Cadastrar</button>
        </div>
    </div>

    </form>
</section>