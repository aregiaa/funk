

    <section class="cad">
            <div class="boxCad">
                <form action="./controller/cadUsuario.php" method="post">>
                    <fieldset>
                        <legend>Cadastro</legend>
                        <div class="inputBox">
                            <input type="text" name="nomeCad" id="nome" class="inputUser" required>
                            <label for="nome" class="labelInput" >Nome Completo</label>
                        </div>
                        <br>
                        <div class="inputBox">
                            <input type="text" name="emailCad" id="email" class="inputUser" required>
                            <label for="nome" class="labelInput">Email</label>
                        </div>
                        <br>
                        <div class="inputBox">
                            <input type="tel" name="telCad" id="telefone" class="inputUser" required>
                            <label for="nome" class="labelInput">Telefone</label>
                        </div>
<br>
                        <div class="inputBox">
                            <input type="password" name="senhaCad" id="senha" class="inputUser" required>
                            <label for="nome" class="labelInput">Senha</label>
                        </div>
                        <br>                        
                        <br>
                        <input type="submit" name="submit" id="submit">

                    </fieldset>
                </form>
            </div>
     
            </section>