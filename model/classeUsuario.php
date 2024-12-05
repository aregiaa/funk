<?php

class Usuario
{
    private $pdo;

    public function __construct($dbname, $host, $user, $senha)
    {
        try {
            $this->pdo = new PDO("mysql:dbname=" . $dbname . ";host=" . $host, $user, $senha);
        } catch (Exception $e) {
            echo "Erro de conexão:" . $e->getMessage();
            exit();
        }
    }

    public function buscarDados()
    {
        $res = array();
        $cmd = $this->pdo->query("SELECT * FROM usuarios ORDER BY nome");
        $res = $cmd->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }

    public function cadastrarUsuario($nome, $tel, $email, $senha)
    {
        $cmd = $this->pdo->prepare("SELECT id FROM usuarios WHERE email = :e");
        $cmd->bindValue(":e", $email);
        $cmd->execute();
        if ($cmd->rowCount() > 0) {
            return false;
        } else {
            // Criptografar a senha
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

            $cmd = $this->pdo->prepare("INSERT INTO usuarios(nome,tel,email,senha) VALUES(:n,:m,:e,:s)");
            $cmd->bindValue(":n", $nome);
            $cmd->bindValue(":e", $email);
            $cmd->bindValue(":m", $tel);
            $cmd->bindValue(":s", $senhaHash);
            $cmd->execute();
            return true;
        }
    }

    public function excluirUsuario($id)
    {
        $cmd = $this->pdo->prepare("DELETE FROM usuarios WHERE id = :id");
        $cmd->bindValue(":id", $id);
        $cmd->execute();
    }

    public function buscarDadosUsuario($id)
    {
        $res = array();
        $cmd = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
        $cmd->bindValue(":id", $id);
        $cmd->execute();
        $res = $cmd->fetch(PDO::FETCH_ASSOC);
        return $res;
    }

    public function atualizarDados($id, $nome, $tel, $email, $role, $bairro, $logradouro, $numero, $cidade, $estado)
    {
        // Verificar se a senha foi alterada
        if (!empty($senha)) {
            $senha = password_hash($senha, PASSWORD_DEFAULT);
            $sql = "UPDATE usuarios SET nome = :nome, tel = :tel, email = :email, senha = :senha, bairro = :bairro, logradouro = :logradouro, numero = :numero, cidade = :cidade, estado = :estado WHERE id = :id";
        } else {
            $sql = "UPDATE usuarios SET nome = :nome, tel = :tel, email = :email, role=:role, bairro = :bairro, logradouro = :logradouro, numero = :numero, cidade = :cidade, estado = :estado WHERE id = :id";
        }

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':tel', $tel);
        $stmt->bindParam(':email', $email);
        if (!empty($senha)) {
            $stmt->bindParam(':senha', $senha);
        }
        $stmt->bindParam(':bairro', $bairro);
        $stmt->bindParam(':logradouro', $logradouro);
        $stmt->bindParam(':numero', $numero);
        $stmt->bindParam(':cidade', $cidade);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function logar($tel, $senha)
    {
        $cmd = $this->pdo->prepare("SELECT id, senha FROM usuarios WHERE tel = :m");
        $cmd->bindValue(":m", $tel);
        $cmd->execute();
        if ($cmd->rowCount() > 0) {
            $dado = $cmd->fetch();
            if (password_verify($senha, $dado['senha'])) {
                session_start();
                $_SESSION['id'] = $dado['id'];
                return true;
            }
        }
        return false;
    }
}
