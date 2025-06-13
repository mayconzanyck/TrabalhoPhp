<?php
require 'includes/conexao.php';
require 'includes/funcoes.php';
verificaLogin();

$msg = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $descricao = $_POST['descricao'];
    $usuario_id = $_SESSION['usuario_id'];

    if (empty($titulo) || empty($descricao)) {
        $msg = "Preencha todos os campos.";
    } else {
        $sql = "INSERT INTO itens (usuario_id, titulo, descricao) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $usuario_id, $titulo, $descricao);
        $stmt->execute();
        header("Location: dashboard.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Novo Filme</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <div class="container">
        <h2>Cadastrar Novo Filme</h2>

        <form method="POST" class="form">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" id="titulo" required>

            <label for="descricao">Descrição:</label>
            <textarea name="descricao" id="descricao" rows="4" required></textarea>

            <button type="submit">Cadastrar</button>
        </form>

        <?php if (!empty($msg)): ?>
            <p class="msg"><?php echo htmlspecialchars($msg); ?></p>
        <?php endif; ?>

        <a href="dashboard.php" class="link-voltar">← Voltar</a>
    </div>
</body>
</html>
