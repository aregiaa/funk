<?php
// Conecte ao banco de dados
require_once './model/classeUsuario.php'; // Supondo que você tenha uma classe para gerenciamento de usuários


if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'usuario') {
    header("Location: login.php");
    exit();
}

// A função getUserData vai buscar os dados do usuário no banco
$user_id = $_SESSION['user_id'];
$user = getUserData($user_id); // Implementar essa função para buscar dados no banco
?>
<?php
function getUserData($user_id)
{
    // Conectar ao banco de dados
    $conn = new mysqli('localhost', 'root', '', 'funk_rap');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $sql = "SELECT * FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();

    $result = $stmt->get_result();

    // Verifica se encontrou um usuário
    if ($result->num_rows > 0) {
        return $result->fetch_object(); // Retorna os dados do usuário como um objeto
    } else {
        return null; // Retorna null caso o usuário não exista
    }

    $stmt->close();
    $conn->close();
}
?>
<div class="usuario">
    <div class="dadospessoais">
        <h1 id="titulo">DADOS PESSOAIS</h1>

        <!-- Exibindo os dados do usuário -->
        <input type="text" value="<?php echo htmlspecialchars($user->nome); ?>" placeholder="Nome:" readonly>

        <input type="text" value="<?php echo htmlspecialchars($user->email); ?>" placeholder="E-mail:" readonly>
        <input type="text" value="<?php echo htmlspecialchars($user->bairro); ?>" placeholder="Bairro:" readonly>
        <input type="text" value="<?php echo htmlspecialchars($user->logradouro); ?>" placeholder="Endereço:" readonly>
        <input type="text" value="<?php echo htmlspecialchars($user->numero); ?>" placeholder="N°:" readonly>
        <input type="text" value="<?php echo htmlspecialchars($user->cidade); ?>" placeholder="Cidade:" readonly>
        <input type="text" value="<?php echo htmlspecialchars($user->estado); ?>" placeholder="Estado:" readonly>
    </div>
    <div class="interacao">
        <div class="lineuser">
            <a href="javascript:void(0)">Minhas curtidas</a>
            <span class="material-symbols-outlined">expand_circle_down</span>
            <div class="content">Aqui ficam as minhas curtidas.</div>
        </div>
        <div class="lineuser">
            <a href="javascript:void(0)">Meus comentários</a>
            <span class="material-symbols-outlined">expand_circle_down</span>
            <div class="content">Aqui ficam os meus comentários.</div>
        </div>
        <div class="lineuser">
            <a href="javascript:void(0)">Minhas avaliações</a>
            <span class="material-symbols-outlined">expand_circle_down</span>
            <div class="content">Aqui ficam as minhas avaliações.</div>
        </div>
        <div class="lineuser">
            <a href="javascript:void(0)">Minhas compras</a>
            <span class="material-symbols-outlined">expand_circle_down</span>
            <div class="content">Aqui ficam as minhas compras.</div>
        </div>
    </div>


</div>
</div>